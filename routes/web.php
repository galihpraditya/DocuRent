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
use App\Http\Controllers\PaymentController;

Route::get('/', [UserPageController::class, 'home'])
    ->name('home');
Route::get('/admin', [AdminPageController::class, 'dashboard'])
    ->name('dashboard');

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
    Route::get('/rentals/{rental}', [RentalController::class, 'show'])
        ->name('rentals.show');
    Route::put('/rentals/{rental}/status', [RentalController::class, 'updateStatus'])
        ->name('rentals.update-status');
    Route::put('/payments/{payment}/verify', [PaymentController::class, 'verify'])
        ->name('payments.verify');    
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
    // hitung total harga di cart
    Route::post('/cart/calculate', [CartController::class, 'calculate'])
        ->name('cart.calculate');

    // masuk ke halaman pembayaran
    Route::post('/checkout-page', [CartController::class, 'checkoutPage'])
        ->name('cart.checkout-page');

    // checkout rental
    Route::post('/rentals', [RentalController::class, 'store'])
        ->name('rentals.store');

     // halaman pembayaran
    Route::get('/payments/{payment}/pay', [PaymentController::class, 'paymentPage'])
        ->name('payments.paymentPage');
    // upload bukti pembayaran
    Route::post('/payments/{payment}/upload-proof', [PaymentController::class, 'uploadProof'])
        ->name('payments.upload-proof');
    // status pembayaran
    Route::get('/payments/{payment}/status', [PaymentController::class, 'status'])
        ->name('payments.status');

    // profil user
    Route::get('/profile', [UserPageController::class, 'profile'])
        ->name('profile');

    // semua transaksi user
    Route::get('/rentals-list', [RentalController::class, 'rentalsList'])
        ->name('rentals.list');
    // filter status
    Route::get('/my-rentals/status/{status}', [RentalController::class, 'filterByStatus'])
        ->name('rentals.filter');
    // detail rental
    Route::get('/rentals/{rental}', [RentalController::class, 'show'])
        ->name('rentals.show');
});
