<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function approve(string $id)
    {
        $post = Post::find($id);
        if ($post->status == PostStatusEnum::APPROVED->value) {
            $post->status = PostStatusEnum::BLOCKED->value;
        }
        else{
            $post->status = PostStatusEnum::APPROVED->value;
        }

        $post->save();

        return back()->with('success', "Post $post->status successfully");
    }
}
