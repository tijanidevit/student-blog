<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\NewCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::oldest('name')->withCount('posts')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function show($slug) {
        $category = Category::with([
            'posts' => function ($query) {
                $query->paginate();
            }
        ])->withCount('posts')->whereSlug($slug)->firstOrFail();

        return view('admin.category.show', compact('category'));
    }

    public function store(NewCategoryRequest $request) {
        $category = Category::create($request->validated());
        return to_route('admin.category.show', $category->slug);
    }

    public function edit($slug) {
        $category = Category::whereSlug($slug)->firstOrFail();
        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request) {
        Category::whereSlug($request->slug)->update(['name' => $request->name]);
        return back()->with('success', 'Category updated successfully.');
    }

    public function delete($slug) {
        Category::whereSlug($slug)->delete();
        return to_route('admin.category.index')->with('success', 'Category deleted successfully.');
    }
}
