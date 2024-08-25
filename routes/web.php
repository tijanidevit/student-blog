<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/../routes/admin.php';

Route::get('/', HomeController::class)->name('home');

Route::get('loginx', function () {
    return to_route('home');
})->name('login');


Route::as('auth.')->middleware(['web', 'guest'])->group(function () {
    Route::view('login', 'auth.login')->name('login_view');
    Route::post('login', [AuthController::class, 'login'])->name('login_action');

    Route::view('register', 'auth.register')->name('register_view');
    Route::post('register', [AuthController::class, 'register'])->name('register_action');
});


Route::middleware('auth')->group(function () {

    Route::as('category.')->prefix('categories')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::get('{slug}', [CategoryController::class, 'show'])->name('show');
    });

    Route::as('post.')->prefix('posts')->group(function () {
        Route::get('', [PostController::class, 'index'])->name('index');
        Route::get('new', [PostController::class, 'create'])->name('create');
        Route::get('{slug}', [PostController::class, 'show'])->name('show');
        Route::post('', [PostController::class, 'store'])->name('store');
        Route::get('{slug}/edit', [PostController::class, 'edit'])->name('edit');
        Route::post('{slug}/like', [PostController::class, 'like'])->name('like');
        Route::patch('{slug}', [PostController::class, 'update'])->name('update');
        Route::delete('{slug}', [PostController::class, 'delete'])->name('delete');


        Route::post('{slug}/comments', [PostController::class, 'addComment'])->name('comment.store');
    });

    Route::as('category.')->prefix('categories')->group(function () {
        Route::get('{slug}', [CategoryController::class, 'show'])->name('show');
    });

    Route::as('profile.')->prefix('profile')->group(function () {
        Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
        Route::get('{id?}', [ProfileController::class, 'index'])->name('index');
        Route::patch('', [ProfileController::class, 'update'])->name('update');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});
