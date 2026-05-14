<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\RentalController;

Route::get('/', [UserPageController::class, 'home']);
Route::get('/admin', [AdminPageController::class, 'dashboard']);

// Auth Route
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');
Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

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
    // halaman cart
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    // tambah product ke cart
    Route::post('/cart/items', [CartItemController::class, 'store'])
        ->name('cart-items.store');

    // update jumlah item
    Route::put('/cart/items/{cartItem}', [CartItemController::class, 'update'])
        ->name('cart-items.update');

    // hapus item dari cart
    Route::delete('/cart/items/{cartItem}', [CartItemController::class, 'destroy'])
        ->name('cart-items.destroy');

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
