<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/admin', [AdminDashboardController::class, 'index']);
