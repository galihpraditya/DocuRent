<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\RentalController;

Route::get('/', [UserPageController::class, 'home']);
Route::get('/admin', [AdminPageController::class, 'dashboard']);

// Auth Route
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// Admin Route
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::resource('products', AdminProductController::class);
    Route::get('/rentals', [RentalController::class, 'index'])
        ->name('rentals.index');
    Route::put('/rentals/{rental}', [RentalController::class, 'update'])
        ->name('rentals.update');
});

// Guest & User Route
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::middleware('auth')->group(function () {
    // checkout rental
    Route::post('/rentals', [RentalController::class, 'store'])
        ->name('rentals.store');
    // detail rental
    Route::get('/rentals/{rental}', [RentalController::class, 'show'])
        ->name('rentals.show');
    // rental aktif
    Route::get('/active-rentals', [RentalController::class, 'activeRentals'])
        ->name('rentals.active');
    // riwayat rental
    Route::get('/rental-history', [RentalController::class, 'rentalHistory'])
        ->name('rentals.history');
});
