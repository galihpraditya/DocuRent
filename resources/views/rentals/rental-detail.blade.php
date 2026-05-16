@extends('layouts.app')

@section('content')
<style>
    .detail-wrapper {
        background-color: #f2f4f6;
        min-height: calc(100vh - 70px);
        padding: 40px 0;
    }

    .card-detail {
        background-color: #ffffff;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    .info-label {
        color: #888;
        font-size: 0.85rem;
        margin-bottom: 2px;
    }
    
    .info-value {
        color: #222;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .status-paid { background-color: #d1e7dd; color: #0f5132; }
    .status-active { background-color: #cfe2ff; color: #084298; }
</style>

<div class="detail-wrapper">
    <div class="container">

        <div class="col-lg-8 mx-auto">

            <a href="{{ route('rentals.list') }}"
               class="text-decoration-none text-dark fw-semibold mb-4 d-inline-block">

                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Daftar Pesanan

            </a>

            <div class="card card-detail p-4 p-md-5">

                <!-- HEADER -->
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">

                    <div>

                        <h4 class="fw-bold text-dark mb-1">
                            Detail Pesanan
                        </h4>

                        <p class="text-muted mb-0">
                            No. Invoice:
                            <span class="fw-bold text-dark">
                                INV-RNT-{{ $rental->id }}
                            </span>
                        </p>

                    </div>

                </div>

                <!-- STATUS -->
                <div class="row mb-4">

                    <div class="col-md-6 mb-3 mb-md-0">

                        <p class="info-label">
                            Status Pembayaran
                        </p>

                        @if($rental->payment->status_pembayaran == 'paid')

                            <span class="status-badge status-paid">
                                <i class="bi bi-check-circle me-1"></i>
                                Lunas
                            </span>

                        @else

                            <span class="status-badge status-pending">
                                <i class="bi bi-clock me-1"></i>
                                Menunggu Verifikasi
                            </span>

                        @endif

                    </div>

                    <div class="col-md-6">

                        <p class="info-label">
                            Status Penyewaan
                        </p>

                        <span class="status-badge status-active">
                            <i class="bi bi-camera-video me-1"></i>
                            {{ ucfirst($rental->status) }}
                        </span>

                    </div>

                </div>

                <!-- DATES -->
                <div class="bg-light rounded-3 p-3 mb-4 border">

                    <div class="row text-center">

                        <div class="col-5">

                            <p class="info-label">
                                Tanggal Ambil
                            </p>

                            <p class="info-value">
                                {{ $rental->tanggal_sewa }}
                            </p>

                        </div>

                        <div class="col-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-arrow-right text-muted fs-4"></i>
                        </div>

                        <div class="col-5">

                            <p class="info-label">
                                Tanggal Pengembalian
                            </p>

                            <p class="info-value">
                                {{ $rental->tanggal_kembali }}
                            </p>

                        </div>

                    </div>

                </div>

                <!-- ITEMS -->
                <h6 class="fw-bold text-dark mb-3">
                    Item Disewa
                </h6>

                @foreach($rental->rentalItems as $item)

                    @php
                        $subtotal =
                            $item->harga_saat_sewa *
                            $item->jumlah;
                    @endphp

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div class="d-flex align-items-center gap-3">

                            <img src="{{ asset('storage/' . $item->product->gambar) }}"
                                 alt="{{ $item->product->nama_produk }}"
                                 class="rounded-3 object-fit-cover border"
                                 style="width: 60px; height: 60px;">

                            <div>

                                <p class="fw-bold text-dark mb-0"
                                   style="font-size: 0.95rem;">

                                    {{ $item->product->nama_produk }}

                                </p>

                                <p class="text-muted small mb-0">

                                    {{ $item->jumlah }}
                                    x
                                    Rp {{ number_format($item->harga_saat_sewa) }} / hari

                                </p>

                            </div>

                        </div>

                        <p class="fw-bold text-dark mb-0">
                            Rp {{ number_format($subtotal) }}
                        </p>

                    </div>

                @endforeach

                <hr style="border-style: dashed; border-color: #ccc;"
                    class="my-4">

                <!-- PAYMENT DETAIL -->
                <h6 class="fw-bold text-dark mb-3">
                    Rincian Biaya
                </h6>

                <div class="d-flex justify-content-between mb-2">

                    <span class="text-muted small">
                        Total Harga Sewa × {{ $hari }} Hari
                    </span>

                    <span class="text-dark fw-medium small">
                        Rp {{ number_format($rental->total_harga) }}
                    </span>

                </div>

                <div class="d-flex justify-content-between align-items-center pt-3 border-top">

                    <span class="fw-bold text-dark">
                        Total Tagihan
                    </span>

                    <h5 class="fw-bold text-dark mb-0">
                        Rp {{ number_format($rental->total_harga) }}
                    </h5>

                </div>

                <div class="d-flex justify-content-between align-items-center mt-1">
                    <span class="text-muted small">
                        Metode Pembayaran
                    </span>
                    <span class="text-dark fw-semibold small">
                        {{ $rental->payment->metode_pembayaran }}
                    </span>
                </div>

                @if($rental->payment->bukti_pembayaran)
                    <div class="mt-3 text-end">
                        <a 
                            href="{{ asset('storage/' . $rental->payment->bukti_pembayaran) }}"
                            target="_blank"
                            class="btn btn-outline-dark btn-sm rounded-pill"
                        >
                            <i class="bi bi-image me-1"></i>
                            Lihat Bukti Pembayaran
                        </a>
                    </div>
                @endif

            </div>

        </div>

    </div>
</div>
@endsection
