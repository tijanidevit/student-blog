<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/../routes/admin.php';

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('loginx', function () {
    return to_route('home');
})->name('login');


Route::as('auth.')->middleware(['web', 'guest'])->group(function () {
    Route::view('login', 'auth.login')->name('login_view');
    Route::post('login', [AuthController::class, 'login'])->name('login_action');

    Route::view('register', 'auth.register')->name('register_view');
    Route::post('register', [AuthController::class, 'register'])->name('register_action');
});


Route::as('category.')->prefix('categories')->group(function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::get('{slug}', [CategoryController::class, 'show'])->name('show');
});




Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
