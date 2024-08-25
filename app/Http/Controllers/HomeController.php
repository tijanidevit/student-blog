<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\TopCategory;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke() : View {
        $sliderPosts = Post::with('category', 'user')->onlyApproved()->latest()->limit(3)->get();

        $topCategories = TopCategory::with([
            'category.posts' => function ($query) {
                $query->onlyApproved()    // Apply the scope to filter approved posts
                      ->latest()         // Order posts by latest first
                      ->take(5)          // Limit to 5 posts per category
                      ->with('category', 'user'); // Eager load related category and user
            }
        ])->get();


        $latestPosts = Post::with('category', 'user')->onlyApproved()->latest()->skip(3)->limit(5)->get();
        $categories = Category::all();

        return view('welcome', compact('sliderPosts', 'topCategories', 'latestPosts', 'categories'));
    }
}
