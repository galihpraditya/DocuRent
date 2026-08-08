<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Rental;
use App\Models\RentalItem;
use App\Models\Payment;
use Carbon\Carbon;

class RentalController extends Controller
{
    // ADMIN - halaman manajemen rental
    public function index()
    {
        $rentals = Rental::with(['user', 'rentalItems.product'])
            ->latest()
            ->get();

        return view('admin-pages.manage-rentals', compact('rentals'));
    }

    // USER - checkout rental
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'metode_pembayaran' => 'required'
        ]);

        $cart = Cart::with('cartItems.product')
            ->where('user_id', auth()->id())
            ->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        // Cek stok sebelum proses
        foreach ($cart->cartItems as $item) {
            if ($item->jumlah > $item->product->stok) {
                return redirect()->route('cart.index')
                    ->with('error', "Stok untuk produk {$item->product->nama_produk} tidak mencukupi. Tersedia: {$item->product->stok}");
            }
        }

        $hari = Carbon::parse($request->tanggal_sewa)
            ->diffInDays($request->tanggal_kembali);
        $hari = max(1, $hari);

        $totalHarga = $cart->calculateTotal($hari);

        $rental = Rental::create([
            'user_id' => auth()->id(),
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'pending',
            'total_harga' => $totalHarga
        ]);

        foreach ($cart->cartItems as $item) {

            RentalItem::create([
                'rental_id' => $rental->id,
                'product_id' => $item->product_id,
                'jumlah' => $item->jumlah,
                'harga_saat_sewa' => $item->product->harga_sewa
            ]);

            $item->product->decrement('stok', $item->jumlah);
        }

        $payment = Payment::create([
            'rental_id' => $rental->id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_bayar' => $totalHarga,
            'status_pembayaran' => 'pending'
        ]);

        CartItem::where('cart_id', $cart->id)->delete();

        return redirect()->route('payments.paymentPage', $payment->id);
    }

    // USER - detail rental
    public function show(Rental $rental)
    {
        if (auth()->user()->role == 'admin') {
            return view('admin-pages.rental-detail', compact('rental'));
        }

        if ($rental->user_id != auth()->id()) {
            abort(403);
        }

        $hari = $this->hitungHari(
            $rental->tanggal_sewa,
            $rental->tanggal_kembali
        );

        return view('rentals.rental-detail', compact('rental', 'hari'));
    }

    // ADMIN - update status rental
    public function updateStatus(Request $request, Rental $rental)
    {
        $request->validate([
            'status' => 'required'
        ]);

        if ($request->status == 'cancelled' && $rental->status != 'cancelled') {
            foreach ($rental->rentalItems as $item) {
                $item->product->increment('stok', $item->jumlah);
            }
        } elseif ($rental->status == 'cancelled' && $request->status != 'cancelled') {
            foreach ($rental->rentalItems as $item) {
                $item->product->decrement('stok', $item->jumlah);
            }
        }

        $rental->update([
            'status' => $request->status
        ]);

        return back();
    }

    // USER - halaman rental
    public function rentalsList()
    {
        $rentals = Rental::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('rentals.rentals-list', compact('rentals'));
    }

    // USER - filter halaman
    public function filterByStatus($status)
    {
        $rentals = Rental::where('user_id', auth()->id())
            ->where('status', $status)
            ->latest()
            ->get();

        return view('rentals.rentals-list', compact('rentals'));
    }

    public function hitungHari($tanggalSewa, $tanggalKembali)
    {
        $hari = Carbon::parse($tanggalSewa)
            ->diffInDays(Carbon::parse($tanggalKembali));
            
        return max(1, $hari);
    }
}
