<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\EditProfileRequest;
use App\Models\Post;
use App\Models\User;
use App\Traits\FileTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use FileTrait;

    public function index($userId = null) : View {
        $userId = $userId ?? auth()->id();

        $user = User::withCount('posts')->where('id',$userId)->firstOrFail();

        $posts = Post::with('category', 'user')->where('user_id', $userId)->latest()->paginate(16);
        return view('profile.index', compact('posts', 'user'));
    }

    public function edit() : View {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }


    public function update(EditProfileRequest $request): RedirectResponse
    {
        // Validate the request data
        $data = $request->validated();

        // Handle image upload if a new image is provided
        if (isset($data['image'])) {
            $data['image'] = $this->uploadFile('users/images', $data['image']);
        }

        // auth()->user()->update($data);

        User::where('id', auth()->id())->update($data);

        // Redirect the user back to the profile index page
        return to_route('profile.index');
    }

}
