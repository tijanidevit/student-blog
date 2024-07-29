<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::oldest('name')->get();
        dd($categories);
    }

    public function show($slug) {
        $category = Category::with('posts')->whereSlug($slug);
    }
}
