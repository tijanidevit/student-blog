<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::oldest('name')->get();
    }

    public function show($slug) {
        // $category = Category::with('name')->get();
    }
}
