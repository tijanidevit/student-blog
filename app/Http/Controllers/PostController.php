<?php

namespace App\Http\Controllers;

use App\Enums\PostStatusEnum;
use App\Http\Requests\Post\AddCommentRequest;
use App\Http\Requests\Post\NewPostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostComment;
use App\Traits\FileTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PostController extends Controller
{
    use FileTrait;
    public function index() : View {
        $posts = Post::with('category', 'user')->onlyApproved()->latest()->paginate(16);
        return view('posts.index', compact('posts'));
    }

    public function create() : View {
        $categories = Category::oldest('name')->get();
        return view('posts.create', compact('categories'));
    }

    public function store(NewPostRequest $request) : RedirectResponse {
        $data = $request->validated();

        if (auth()->user()->isAdmin()) {
            $data['status'] = PostStatusEnum::APPROVED->value;
        }

        $data['image'] = $this->uploadFile('posts/images', $data['image']); //$request->file('image')->store('public/posts/images');
        $post = Post::create($data);

        return to_route('post.show', $post->slug);
    }

    public function show($slug) : View {
        $post = Post::whereSlug($slug)->with('category', 'user')->firstOrFail();
        $comments = PostComment::where('post_id', $post->id)
        ->with('creator')
        ->simplePaginate();

        $post->comments = $comments;
        Gate::authorize('view', $post);
        $post->increment('views');

        $relatedPosts = Post::whereNot('id', $post->id)->onlyApproved()
        ->where('category_id', $post->category_id)
        ->with('category', 'user')
        ->limit(5)
        ->latest()->get();
        return view('posts.show', compact('post', 'relatedPosts'));
    }

    public function addComment(AddCommentRequest $request, $postId) : RedirectResponse {
        $data = $request->validated();
        $post = Post::findOrFail($postId);
        $post->comments()->create($data);
        return back()->with(['success' => 'Comment added successfully']);
    }



    public function delete($slug) : RedirectResponse {
        $post = Post::whereSlug($slug)->with('category', 'user')->firstOrFail();
        Gate::authorize('delete', $post);
        $post->comments()->delete();
        $post->delete();

        return to_route('profile.index')->with('success', 'Post deleted successfully');
    }
}
