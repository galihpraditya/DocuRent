<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminProductController;
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
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class);
});

// Guest & User Route
Route::resource('products', ProductController::class)->only(['show']);

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home.home-page');
})->name('home');

Route::get('/product/{id}', function ($id) {
    // Nantinya {id} digunakan untuk mengambil data spesifik dari database
    return view('product.product-detail');
})->name('product.detail');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

/*
|--------------------------------------------------------------------------
| User & Transaction Routes
|--------------------------------------------------------------------------
*/

// Halaman Keranjang
Route::get('/cart', function () {
    return view('cart.cart-page');
})->name('cart');

// Alur Pembayaran (Folder: views/payments/)
Route::prefix('payment')->group(function () {
    // 1. Overview barang, harga akhir, dan tombol checkout
    Route::get('/checkout', function () {
        return view('payments.checkout-page');
    })->name('payment.checkout');

    // 2. Memilih opsi pembayaran & tombol bayar
    Route::get('/confirm', function () {
        return view('payments.confirm-payment');
    })->name('payment.confirm');

    // 3. Status pembayaran (menunggu verifikasi / paid)
    // Parameter {id} disiapkan untuk mengecek transaksi spesifik nantinya
    Route::get('/status/{id}', function ($id) {
        return view('payments.transaction-status');
    })->name('payment.status');
});

// Manajemen Sewa Pengguna (Folder: views/rentals/)
Route::prefix('my-rentals')->group(function () {
    // 1. Daftar rental dengan filter (pending, ongoing, completed)
    Route::get('/', function () {
        return view('rentals.rental-list');
    })->name('rentals.list');

    // 2. Halaman detail status penyewaan, alat, dan tanggal
    Route::get('/detail/{id}', function ($id) {
        return view('rentals.rental-detail');
    })->name('rentals.detail');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin-pages.dashboard');
    })->name('admin.dashboard');

    // Manajemen Produk Admin
    Route::get('/products', function () {
        return view('admin-pages.manage-products');
    })->name('admin.products');

    Route::get('/products/create', function () {
        return view('admin-pages.create-product');
    })->name('admin.product.create');

    Route::get('/products/edit/{id}', function ($id) {
        return view('admin-pages.edit-product');
    })->name('admin.product.edit');

    // Manajemen Transaksi Admin
    Route::get('/rentals', function () {
        return view('admin-pages.manage-rentals');
    })->name('admin.manage.rentals');

    Route::get('/payments', function () {
        return view('admin-pages.manage-payments');
    })->name('admin.manage.payments');
});