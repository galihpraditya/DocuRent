<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function paymentPage(Payment $payment)
    {
        if ($payment->rental && $payment->rental->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Akses tidak diizinkan.');
        }

        return view('payments.payment-page', compact('payment'));
    }

    public function uploadProof(Request $request, Payment $payment)
    {
        if ($payment->rental && $payment->rental->user_id !== auth()->id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($payment->bukti_pembayaran) {
            Storage::disk('public')
                ->delete($payment->bukti_pembayaran);
        }

        $path = $request->file('bukti_pembayaran')
            ->store('payment-proofs', 'public');

        $payment->update([
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'waiting for verification',
            'tanggal_bayar' => now()
        ]);

        return redirect()->route('payments.status', $payment->id);
    }

    public function status(Payment $payment)
    {
        if ($payment->rental && $payment->rental->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Akses tidak diizinkan.');
        }

        return view('payments.payment-status', compact('payment'));
    }

    // Verifikasi dari admin
    public function verify(Payment $payment)
    {
        $payment->update([
            'status_pembayaran' => 'paid'
        ]);

        if ($payment->rental) {
            $payment->rental->update([
                'status' => 'ongoing'
            ]);
        }

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi valid.');
    }

    // Penolakan dari admin
    public function reject(Payment $payment)
    {
        $payment->update([
            'status_pembayaran' => 'failed'
        ]);

        if ($payment->rental) {
            if ($payment->rental->status !== 'cancelled') {
                foreach ($payment->rental->rentalItems as $item) {
                    $item->product->increment('stok', $item->jumlah);
                }
            }
            $payment->rental->update([
                'status' => 'cancelled'
            ]);
        }

        return back()->with('success', 'Bukti pembayaran ditolak dan stok pesanan telah dikembalikan.');
    }
}
