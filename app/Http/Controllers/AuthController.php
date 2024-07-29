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

        return redirect()->intended('/');
    }

    public function register(RegisterRequest $request) : RedirectResponse {
        $data = $request->validated();

        DB::transaction(function () use($data) {
            $user = User::create(Arr::only($data, ['email', 'password', 'name']));
            $user->student()->create(Arr::only($data, ['matric_no']));

            Auth::login($user);
        });
        return redirect()->intended('/');
    }

    public function logout() : RedirectResponse {
        Auth::logout();
        return redirect()->intended('/');
    }
}
