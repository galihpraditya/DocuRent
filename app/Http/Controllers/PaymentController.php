<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function confirm(Payment $payment)
    {
        return view('payments.confirm-payment', compact('payment'));
    }

    public function uploadProof(Request $request, Payment $payment)
    {
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
            'status_pembayaran' => 'waiting for verification'
        ]);

        return redirect()->route('payments.status', $payment->id
            )->with('success', 'Payment proof uploaded');
    }

    public function status(Payment $payment)
    {
        return view('payments.payment-status', compact('payment'));
    }

    // Verifikasi dari admin
    public function verify(Payment $payment)
    {
        $payment->update([
            'status_pembayaran' => 'paid'
        ]);

        return back()->with('success', 'Payment verified');
    }
}
