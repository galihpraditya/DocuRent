@extends('layouts.app')

@section('content')
<style>
    .confirm-wrapper {
        background-color: #f2f4f6;
        min-height: calc(100vh - 70px);
        padding: 40px 0;
    }

    .card-confirm {
        background-color: #ffffff;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    /* Styling Opsi Pembayaran */
    .payment-option {
        border: 1px solid #eaeaea;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 15px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .payment-option:hover { border-color: #000; background-color: #fcfcfc; }

    /* Saat radio button dipilih (logic simple CSS) */
    .form-check-input:checked + .payment-content {
        font-weight: bold;
    }

    .btn-bayar {
        background-color: #727a82; /* Abu-abu slate sesuai desain */
        color: #ffffff;
        border-radius: 8px;
        font-weight: 600;
        padding: 15px 0;
        border: none;
        transition: background-color 0.2s;
    }
    .btn-bayar:hover { background-color: #5c636a; color: #fff; }

    @media (min-width: 992px) {
        .divider-left { border-left: 2px solid #ddd; padding-left: 40px; }
    }
</style>

<div class="confirm-wrapper">
    <div class="container">

        <form action="{{ route('payments.upload-proof', $payment->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row">

                <!-- LEFT -->
                <div class="col-lg-7">

                    <div class="card card-confirm p-4 p-lg-5">

                        <h4 class="fw-bold mb-4">Metode Pembayaran</h4>

                        <!-- PAYMENT DESTINATION -->
                        <div class="mb-4">

                            <h6 class="fw-bold mb-3">Tujuan Pembayaran</h6>

                            @if($payment->metode_pembayaran == 'Transfer')

                                <p class="mb-1">BCA: 123456789</p>

                            @elseif($payment->metode_pembayaran == 'E-Wallet')

                                <p class="mb-1">E-Wallet: 08123456789</p>

                            @elseif($payment->metode_pembayaran == 'QRIS')

                                <p class="mb-2">Scan QRIS:</p>

                                <img src="{{ asset('images/qris.jpg') }}"
                                     alt="QRIS"
                                     style="max-width: 200px;">

                            @endif

                        </div>

                        <hr>

                        <!-- UPLOAD PROOF -->
                        <label class="fw-semibold mb-2">
                            Upload Payment Proof
                        </label>

                        <input type="file"
                               name="bukti_pembayaran"
                               class="form-control"
                               required>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-lg-5 divider-left">

                    <div class="card card-confirm p-4 p-lg-5">

                        <h5 class="fw-bold mb-4">Ringkasan transaksi</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total Sewa</span>
                            <span class="text-muted">
                                Rp {{ number_format($payment->jumlah_bayar) }}
                            </span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center my-4">

                            <h5 class="fw-bold mb-0">Total Tagihan</h5>

                            <h4 class="fw-bold mb-0">
                                Rp {{ number_format($payment->jumlah_bayar) }}
                            </h4>

                        </div>

                        <button type="submit" class="btn btn-bayar w-100">
                            Konfirmasi Pembayaran
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>
</div>
@endsection
