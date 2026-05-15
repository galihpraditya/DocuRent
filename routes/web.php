<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\AdminPageController;

Route::get('/', [UserPageController::class, 'home']);
Route::get('/admin', [AdminPageController::class, 'dashboard']);

// Auth Route
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Route
Route::get('/admin', [AdminPageController::class, 'dashboard'])->name('dashboard');
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminPageController::class, 'dashboard'])->name('dashboard');
    Route::resource('products', ProductController::class);
});

// Guest & User Route
Route::get('/login', [AuthController::class, 'showLogin']);
