<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\TopCategory\AddTopCategoryRequest;
use App\Models\Category;
use App\Models\TopCategory;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TopCategoryController extends Controller
{
    public function index() : View {
        $categories = Category::with('topCategory')->oldest('name')->get();

        return view('admin.top-category.index', compact('categories'));
    }


    public function store(AddTopCategoryRequest $request) {
        TopCategory::truncate();
        $categories = explode(',', $request->categories);

        $categoriesArray = array_map(function ($category, $index) {
            return [
                'category_id' => $category,
                'id' => Str::orderedUuid(),
                'order' => $index + 1, // Set the order based on the index (1-based index)
            ];
        }, $categories, array_keys($categories));

        TopCategory::insert($categoriesArray);
        return back()->with('success', 'Top Categories Updated Successfully');
    }
}
