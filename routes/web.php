<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\AdminPageDashboardController;

Route::get('/', [UserPageController::class, 'home']);
Route::get('/admin', [AdminPageController::class, 'dashboard']);

// Auth Route
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// Admin Route
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class);
});

// Guest & User Route
Route::resource('products', ProductController::class)->only(['show']);
