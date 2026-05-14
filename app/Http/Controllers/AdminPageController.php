<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rental;
use App\Models\RentalItem;

class AdminPageController extends Controller
{   
    public function __construct() {
        $this->middleware('isAdmin');
    }

    public function dashboard()
    {
        $totalProducts = Product::count();

        $activeRentals = Rental::where('status', 'ongoing')->count();

        return view('admin-pages.dashboard', compact(
            'totalProducts',
            'activeRentals'
        ));
    }
}
