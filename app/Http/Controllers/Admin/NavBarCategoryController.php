<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NavBarCategory\AddNavBarCategoryRequest;
use App\Models\Category;
use App\Models\NavBarCategory;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NavBarCategoryController extends Controller
{
    public function index() : View {
        $categories = Category::with('NavBarCategory')->oldest('name')->get();
        return view('admin.navbar-category.index', compact('categories'));
    }


    public function store(AddNavBarCategoryRequest $request) {
        NavBarCategory::truncate();
        $categories = explode(',', $request->categories);

        if (count($categories) > 5) {
            return back()->withErrors(['categories' => 'Navbar categories cannot be more than five']);
        }

        $categoriesArray = array_map(function ($category, $index) {
            return [
                'category_id' => $category,
                'id' => Str::orderedUuid(),
                'order' => $index + 1, // Set the order based on the index (1-based index)
            ];
        }, $categories, array_keys($categories));

        NavBarCategory::insert($categoriesArray);
        return back()->with('success', 'Nav bar Categories Updated Successfully');
    }
}
