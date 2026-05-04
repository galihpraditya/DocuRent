<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminDashboardController extends Controller
{   
    public function __construct() {
        $this->middleware('IsAdmin');
    }

    public function index()
    {
        $products = Product::orderBy('nama_produk', 'asc')->get();
        return view('adminpages.dashboard', compact('products'));
    }
}
