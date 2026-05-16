@extends('layouts.app')

@section('content')
<style>
    .status-wrapper {
        background-color: #f2f4f6;
        min-height: calc(100vh - 70px);
        padding: 40px 0;
    }

    .card-status {
        background-color: #ffffff;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    /* Kotak Timer Countdown */
    .timer-box {
        background-color: #727a82;
        color: #ffffff;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.2rem;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Alert / Warning Box Custom */
    .alert-custom {
        background-color: #e9ecef;
        border-radius: 8px;
        border: none;
        color: #333;
    }

    /* Kustomisasi Accordion Bootstrap untuk Cara Pembayaran */
    .accordion-button:not(.collapsed) {
        color: #000;
        background-color: transparent;
        box-shadow: none;
    }
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,0.1);
    }
    .accordion-button {
        font-weight: 600;
        padding: 1rem 0;
    }
    .accordion-item {
        border-left: none;
        border-right: none;
        border-top: none;
        border-bottom: 1px solid #eaeaea;
    }
    .accordion-item:last-child {
        border-bottom: none;
    }
    .accordion-body {
        padding: 0 0 1rem 0;
        color: #555;
        font-size: 0.9rem;
    }

    /* Efek hover untuk ikon copy */
    .copy-icon {
        cursor: pointer;
        transition: color 0.2s;
    }
    .copy-icon:hover {
        color: #000 !important;
    }
</style>

<div class="status-wrapper">
    <div class="container">

        <div class="col-lg-8 mx-auto">

            <div class="card card-status p-4 p-md-5 mb-4">

                <!-- HEADER TIMER (tetap UI) -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div>
                            <h1 class="fw-bold mb-0 text-dark">Status Pembayaran</h4>
                        </div>
                    </div>
                </div>

                <!-- STATUS INFO -->
                <div class="mb-3">
                    <h5 class="fw-bold text-dark mb-1">Booking Code</h5>
                    <p class="text-muted mb-3">{{ $payment->rental->id }}</p>

                    <h5 class="fw-bold text-dark mb-1">Total Pembayaran</h5>
                    <p class="text-muted mb-3">
                        Rp {{ number_format($payment->jumlah_bayar) }}
                    </p>

                    <h5 class="fw-bold text-dark mb-1">Metode Pembayaran</h5>
                    <p class="text-muted mb-3">
                        {{ strtoupper($payment->metode_pembayaran) }}
                    </p>

                    <h5 class="fw-bold text-dark mb-1">Status Pembayaran</h5>
                    <p class="mb-0">
                        @if($payment->status_pembayaran == 'waiting for verification')
                            <span class="text-warning fw-semibold">Menunggu Verifikasi Owner</span>
                        @elseif($payment->status_pembayaran == 'paid')
                            <span class="text-success fw-semibold">PAID</span>
                        @elseif($payment->status_pembayaran == 'pending')
                            <span class="text-warning fw-semibold">PENDING</span>
                        @else
                            <span class="text-danger fw-semibold">FAILED</span>
                        @endif
                    </p>
                </div>

                <hr style="border-color: #ddd;" class="my-4">

                @if($payment->bukti_pembayaran)
                    <div class="alert alert-success mt-4 mb-0">
                        Payment proof uploaded successfully.
                    </div>
                @endif

                <a href="{{ route('rentals.list') }}" class="btn btn-dark mt-4">
                    Lihat Detail Transaksi
                </a>

            </div>

        </div>

    </div>
</div>

@endsection