<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request) {
        $posts = Post::with('user', 'category')
                    ->search('title',$request->search)
                    ->orSearch('content',$request->search)
                    ->filterByDate($request->from_date, $request->to_date)
                    ->latest()
                    ->paginate();


        return view('admin.post.index', compact('posts'));
    }

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
