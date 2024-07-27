<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(LoginRequest $request) : RedirectResponse {
        if (!Auth::attempt($request->validated())) {
            return back()->withErrors(['password' => 'Invalid password'])->withInput(['email' => $request->email]);
        }

        if (auth()->user()->role == UserRoleEnum::ADMIN->value) {
            return to_route('admin.dashboard');
        }


        return redirect()->intended('home');
    }

    public function register(RegisterRequest $request) : RedirectResponse {
        $data = $request->validated();

        return DB::transaction(function () use($data) {
            $user = User::create(Arr::only($data, ['email', 'password']));

            $user->student()->create(Arr::except($data, ['email', 'password']));
        });


        return redirect()->intended('home');
    }

}
