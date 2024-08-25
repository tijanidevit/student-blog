<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::oldest('name')->withCount('posts')->get();
        return view('category.index', compact('categories'));
    }

    public function show($slug) {
        $category = Category::withCount('posts')->whereSlug($slug)->firstOrFail();

        $posts = Post::with('user')->where('category_id', $category->id)->paginate();
        return view('category.show', compact('category', 'posts'));
    }
}
