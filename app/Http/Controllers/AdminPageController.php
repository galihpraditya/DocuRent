<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminPageController extends Controller
{   
    // public function __construct() {
    //     $this->middleware('isAdmin');
    // }

    public function dashboard()
    {
        $totalProduk = Product::count();
        $totalDisewa = 0; 
        $totalPelanggan = 0;
        $products = Product::orderBy('nama_produk', 'asc')->get();
        return view('admin-pages.dashboard', compact(
            'products', 
            'totalProduk', 
            'totalDisewa', 
            'totalPelanggan'
        ));
    }
}
