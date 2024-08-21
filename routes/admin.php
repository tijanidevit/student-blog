<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NavBarCategoryController;
use App\Http\Controllers\TopCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('dashboard', DashboardController::class)->name('dashboard');


    Route::as('student.')->prefix('students')->group(function () {
        Route::get('', [StudentController::class, 'index'])->name('index');
        Route::get('{id}', [StudentController::class, 'show'])->name('show');
    });

    Route::as('category.')->prefix('categories')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::view('new', 'admin.category.create')->name('create');
        Route::get('{slug}', [CategoryController::class, 'show'])->name('show');
        Route::post('', [CategoryController::class, 'store'])->name('store');
        Route::get('{slug}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::patch('{slug}', [CategoryController::class, 'update'])->name('update');
        Route::delete('{slug}', [CategoryController::class, 'delete'])->name('delete');
    });

    Route::as('top-category.')->prefix('top-categories')->group(function () {
        Route::get('', [TopCategoryController::class, 'index'])->name('index');
        Route::post('', [TopCategoryController::class, 'store'])->name('store');
    });

    Route::as('navbar-category.')->prefix('navbar-categories')->group(function () {
        Route::get('', [NavBarCategoryController::class, 'index'])->name('index');
        Route::post('', [NavBarCategoryController::class, 'store'])->name('store');
    });
});
