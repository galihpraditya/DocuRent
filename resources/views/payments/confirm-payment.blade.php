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
        <form action="{{ route('payment.status', ['id' => 1]) }}" method="GET">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-confirm p-4 p-lg-5">
                        <h4 class="fw-bold mb-4">Metode Pembayaran</h4>
                        
                        <label class="payment-option w-100">
                            <input class="form-check-input" type="radio" name="method" value="bca" required>
                            <img src="{{ asset('images/logo-bca.png') }}" alt="BCA" style="height: 25px; width: 70px; object-fit: contain;">
                            <span class="fs-5 text-dark">BCA Virtual Account</span>
                        </label>

                        <label class="payment-option w-100">
                            <input class="form-check-input" type="radio" name="method" value="qris">
                            <img src="{{ asset('images/logo-qris.png') }}" alt="QRIS" style="height: 25px; width: 70px; object-fit: contain;">
                            <span class="fs-5 text-dark">QRIS</span>
                        </label>

                        <label class="payment-option w-100">
                            <input class="form-check-input" type="radio" name="method" value="bni">
                            <img src="{{ asset('images/logo-bni.png') }}" alt="BNI" style="height: 25px; width: 70px; object-fit: contain;">
                            <span class="fs-5 text-dark">BNI Virtual Account</span>
                        </label>

                        <label class="payment-option w-100">
                            <input class="form-check-input" type="radio" name="method" value="mandiri">
                            <img src="{{ asset('images/logo-mandiri.png') }}" alt="Mandiri" style="height: 25px; width: 70px; object-fit: contain;">
                            <span class="fs-5 text-dark">Mandiri Virtual Account</span>
                        </label>
                    </div>
                </div>

                <div class="col-lg-5 divider-left">
                    <div class="card card-confirm p-4 p-lg-5">
                        <h5 class="fw-bold mb-4">Ringkasan transaksi</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total Sewa (2 Barang)</span>
                            <span class="text-muted">Rp480.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Biaya Layanan</span>
                            <span class="text-muted">Rp5.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-muted">Kode Promo</span>
                            <span class="text-dark fw-medium">-Rp20.000</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center my-4">
                            <h5 class="fw-bold mb-0">Total Tagihan</h5>
                            <h4 class="fw-bold mb-0">Rp465.000</h4>
                        </div>
                        <button type="submit" class="btn btn-bayar w-100">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection