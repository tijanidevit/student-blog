<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('dashboard', DashboardController::class)->name('dashboard');


    Route::as('category')->prefix('categories')->group(function () {
        Route::get('', [CategoryController::class, 'index']);
        Route::get('{slug}', [CategoryController::class, 'show']);
    });
});
