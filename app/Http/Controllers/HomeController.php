<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('nama_produk', 'asc')->get();
        return view('pages.home', compact('products'));
    }
}
