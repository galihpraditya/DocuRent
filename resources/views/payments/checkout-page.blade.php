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

    .sticky-summary {
        position: sticky;
        top: 100px;
        z-index: 10;
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

            <!-- LEFT -->
            <div class="col-lg-7">

                <div class="card card-checkout p-4 mb-4">
                    <h6 class="fw-bold text-muted mb-3" style="font-size: 0.8rem; letter-spacing: 1px;">
                        ALAMAT PENGAMBILAN
                    </h6>

                    <div class="d-flex align-items-start gap-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                             style="width: 40px; height: 40px;">
                            <i class="bi bi-geo-alt-fill text-dark fs-5"></i>
                        </div>

                        <div>
                            <p class="mb-0 fw-bold text-dark">DocuRent Malang Pusat</p>
                            <p class="mb-0 text-muted small">
                                Jl. Veteran, Kota Malang, Jawa Timur
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card card-checkout p-4 mb-3">

                    <h4 class="fw-bold mb-4 text-dark">
                        RENTAL ITEMS
                    </h4>

                    @foreach($cart->cartItems as $item)

                        <div class="d-flex align-items-center gap-4 mb-4">

                            <img src="{{ asset('storage/' . $item->product->gambar) }}"
                                 class="rounded-3 shadow-sm"
                                 style="width: 100px; height: 100px; object-fit: cover;">

                            <div>

                                <p class="mb-1 text-dark fw-semibold">
                                    {{ $item->product->nama_produk }}
                                </p>

                                <p class="mb-1 text-muted">
                                    Rp {{ number_format($item->product->harga_sewa) }} / hari
                                </p>

                                <p class="mb-0 text-muted">
                                    Jumlah: {{ $item->jumlah }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                    <hr>

                    <h6 class="fw-bold mt-3">Rental Date</h6>

                    <p class="text-muted mb-3">
                        {{ $tanggalSewa }} → {{ $tanggalKembali }}
                    </p>

                    <h6 class="fw-bold">Total Price</h6>

                    <p class="fw-bold text-dark">
                        Rp {{ number_format($totalHarga) }}
                    </p>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="col-lg-5">

                <div class="card card-checkout p-4 p-lg-5">

                    <h5 class="fw-bold mb-4 text-dark">
                        Detail Biaya
                    </h5>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Total Sewa</span>
                        <span class="fw-semibold">
                            Rp {{ number_format($totalHarga) }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-muted">Potongan Promo</span>
                        <span class="text-success fw-semibold">- Rp 0</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center my-4">
                        <h5 class="fw-bold mb-0">Total Tagihan</h5>
                        <h4 class="fw-bold mb-0">
                            Rp {{ number_format($totalHarga) }}
                        </h4>
                    </div>

                    <!-- PAYMENT FORM (POST) -->
                    <form action="{{ route('rentals.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="tanggal_sewa" value="{{ $tanggalSewa }}">
                        <input type="hidden" name="tanggal_kembali" value="{{ $tanggalKembali }}">
                        <input type="hidden" name="total_harga" value="{{ $totalHarga }}">

                        <label class="small fw-semibold">Method</label>

                        <select name="metode_pembayaran"
                                class="form-select mb-3"
                                required>

                            <option value="Transfer">Transfer Bank</option>
                            <option value="E-Wallet">E-Wallet</option>
                            <option value="QRIS">QRIS</option>

                        </select>

                        <button type="submit"
                                class="btn btn-dark w-100">
                            Lanjut ke Pembayaran
                            <i class="bi bi-chevron-right ms-2"></i>
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>
@endsection
