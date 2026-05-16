@extends('layouts.app')

@section('content')
<style>
    .checkout-wrapper {
        background-color: #f2f4f6;
        min-height: calc(100vh - 70px);
        padding: 40px 0;
    }

    .card-checkout {
        background-color: #ffffff;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    /* Solusi agar tidak menutupi Navbar saat di-scroll */
    .sticky-summary {
        position: sticky;
        top: 100px; /* Jarak dari atas layar agar tidak menabrak navbar */
        z-index: 10; /* Di bawah z-index navbar (biasanya 1020) */
    }

    .input-catatan {
        border: none;
        border-bottom: 1px solid #dcdcdc;
        border-radius: 0;
        padding: 5px 0;
        box-shadow: none !important;
        background: transparent;
        font-size: 0.9rem;
    }
    .input-catatan:focus { border-bottom: 1px solid #000; }

    .btn-checkout {
        background-color: #1c2024;
        color: #ffffff;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 12px 0;
        transition: all 0.3s ease;
    }
    .btn-checkout:hover { background-color: #000; color: #fff; }
</style>

<div class="checkout-wrapper">
    <div class="container">
        <h3 class="fw-bold mb-4">Ringkasan Pesanan</h3>
        
        <div class="row">
            <div class="col-lg-7">
                <div class="card card-checkout p-4 mb-4">
                    <h6 class="fw-bold text-muted mb-3" style="font-size: 0.8rem; letter-spacing: 1px;">ALAMAT PENGAMBILAN</h6>
                    <div class="d-flex align-items-start gap-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="bi bi-geo-alt-fill text-dark fs-5"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-bold text-dark">DocuRent Malang Pusat</p>
                            <p class="mb-0 text-muted small">Lowokwaru, kota Malang, Jawa Timur (Tepat di depan Kampus)</p>
                        </div>
                    </div>
                </div>

                <div class="card card-checkout p-4 mb-3">
                    <h4 class="fw-bold mb-4 text-dark">KAMERA XXX</h4>
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <img src="{{ asset('images/product.jpg') }}" alt="Kamera" class="rounded-3 shadow-sm" style="width: 120px; height: 120px; object-fit: cover; background-color: #ddd;">
                        <div>
                            <p class="mb-1 text-dark">Masa Sewa : <strong>2 Hari</strong></p>
                            <h4 class="fw-bold mb-1 text-dark">Rp240.000</h4>
                            <p class="mb-0 text-muted">Jumlah : 2 buah</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <input type="text" class="input-catatan w-100" placeholder="Beri Catatan (Opsional)" maxlength="200">
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card card-checkout p-4 p-lg-5 sticky-summary">
                    <h5 class="fw-bold mb-4 text-dark">Detail Biaya</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Total Sewa</span>
                        <span class="text-dark fw-semibold">Rp480.000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Biaya Layanan</span>
                        <span class="text-dark fw-semibold">Rp5.000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-muted">Potongan Promo</span>
                        <span class="text-success fw-semibold">-Rp20.000</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center my-4">
                        <h5 class="fw-bold mb-0">Total Tagihan</h5>
                        <h4 class="fw-bold mb-0 text-dark">Rp465.000</h4>
                    </div>
                    <a href="{{ route('payment.confirm') }}" class="btn btn-checkout w-100 text-decoration-none text-center">
                        Lanjut ke Pembayaran <i class="bi bi-chevron-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection