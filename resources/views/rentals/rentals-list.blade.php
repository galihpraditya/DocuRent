@extends('layouts.app')

@section('content')
<style>
    .rental-wrapper {
        background-color: #f2f4f6;
        min-height: calc(100vh - 70px);
        padding: 40px 0;
    }

    /* Kustomisasi Tab Filter */
    .nav-pills .nav-link {
        color: #555;
        border-radius: 30px;
        padding: 8px 20px;
        font-weight: 600;
        margin-right: 10px;
        background-color: #e9ecef;
        transition: all 0.2s ease;
    }
    .nav-pills .nav-link:hover {
        background-color: #dcdcdc;
    }
    .nav-pills .nav-link.active {
        background-color: #1c2024;
        color: #fff;
    }

    /* Kustomisasi Kartu Pesanan */
    .card-order {
        background-color: #ffffff;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        transition: transform 0.2s;
    }
    .card-order:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    }

    /* Badge Status */
    .badge-pending { background-color: #ffc107; color: #000; }
    .badge-ongoing { background-color: #0d6efd; color: #fff; }
    .badge-completed { background-color: #198754; color: #fff; }
</style>

<div class="rental-wrapper">
    <div class="container">

        <div class="col-lg-9 mx-auto">

            <h3 class="fw-bold mb-4 text-dark">
                Pesanan Saya
            </h3>

            <!-- FILTER -->
            <ul class="nav nav-pills mb-4">

                <li class="nav-item">
                    <a href="{{ route('rentals.list') }}"
                       class="nav-link {{ !request()->segment(3) ? 'active' : '' }}">
                        Semua
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('rentals.filter', 'pending') }}"
                       class="nav-link {{ request()->segment(3) == 'pending' ? 'active' : '' }}">
                        Pending
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('rentals.filter', 'ongoing') }}"
                       class="nav-link {{ request()->segment(3) == 'ongoing' ? 'active' : '' }}">
                        Berlangsung
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('rentals.filter', 'completed') }}"
                       class="nav-link {{ request()->segment(3) == 'completed' ? 'active' : '' }}">
                        Selesai
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('rentals.filter', 'canceled') }}"
                       class="nav-link {{ request()->segment(3) == 'canceled' ? 'active' : '' }}">
                        Dibatalkan
                    </a>
                </li>

            </ul>

            <!-- LIST -->
            @forelse($rentals as $rental)

                <div class="card card-order p-4 mb-3">

                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">

                        <div>
                            <i class="bi bi-bag-check-fill me-2 text-primary"></i>

                            <span class="fw-bold text-dark">
                                Booking #{{ $rental->id }}
                            </span>

                            <span class="text-muted ms-2 small">
                                {{ $rental->created_at }} WIB
                            </span>
                        </div>

                        @if($rental->status == 'pending')

                            <span class="badge badge-pending px-3 py-2 rounded-pill">
                                Pending
                            </span>

                        @elseif($rental->status == 'ongoing')

                            <span class="badge badge-ongoing px-3 py-2 rounded-pill">
                                Ongoing
                            </span>

                        @else

                            <span class="badge bg-success px-3 py-2 rounded-pill">
                                Completed
                            </span>

                        @endif

                    </div>

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="fw-bold mb-1 text-dark">
                                Periode Sewa
                            </h6>

                            <p class="mb-0 text-muted small">
                                {{ $rental->tanggal_sewa }}
                                →
                                {{ $rental->tanggal_kembali }}
                            </p>

                        </div>

                        <div class="text-end">

                            <p class="text-muted small mb-1">
                                Total Belanja
                            </p>

                            <h6 class="fw-bold text-dark mb-0">
                                Rp {{ number_format($rental->total_harga) }}
                            </h6>

                        </div>

                    </div>

                    <div class="mt-4 text-end">

                        <a href="{{ route('rentals.show', $rental->id) }}"
                           class="btn btn-outline-dark fw-semibold rounded-pill px-4">
                            Lihat Detail
                        </a>

                    </div>

                </div>

            @empty

                <div class="text-center py-5">

                    <h5 class="text-muted">
                        No rentals found
                    </h5>

                </div>

            @endforelse

        </div>

    </div>
</div>
@endsection