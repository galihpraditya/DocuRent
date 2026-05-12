<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminPageController extends Controller
{   
    public function __construct() {
        $this->middleware('isAdmin');
    }

    public function dashboard()
    {
        $products = Product::orderBy('nama_produk', 'asc')->get();
        return view('admin-pages.dashboard', compact('products'));
    }
}
