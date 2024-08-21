<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class TopCategoryController extends Controller
{
    public function index() : View {
        $categories = Category::with('topCategory')->oldest('name')->get();

        return view('admin.top-category.index', compact('categories'));
    }
}
