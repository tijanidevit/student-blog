<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::oldest('name')->withCount('posts')->get();
        return view('category.index', compact('categories'));
    }

    public function show($slug) {
        $category = Category::with([
            'posts' => function ($query) {
                $query->paginate();
            }
        ])->withCount('posts')->whereSlug($slug)->firstOrFail();

        return view('category.show', compact('category'));
    }
}
