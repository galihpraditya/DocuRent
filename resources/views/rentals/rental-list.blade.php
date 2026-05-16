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
            
            <h3 class="fw-bold mb-4 text-dark">Pesanan Saya</h3>

            <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-semua-tab" data-bs-toggle="pill" data-bs-target="#pills-semua" type="button" role="tab">Semua</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-pending-tab" data-bs-toggle="pill" data-bs-target="#pills-pending" type="button" role="tab">Pending</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-ongoing-tab" data-bs-toggle="pill" data-bs-target="#pills-ongoing" type="button" role="tab">Ongoing</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-completed-tab" data-bs-toggle="pill" data-bs-target="#pills-completed" type="button" role="tab">Completed</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                
                <div class="tab-pane fade show active" id="pills-semua" role="tabpanel">
                    
                    <div class="card card-order p-4 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <div>
                                <i class="bi bi-bag-check-fill me-2 text-primary"></i>
                                <span class="fw-bold text-dark">Sewa</span>
                                <span class="text-muted ms-2 small">15 Mei 2026</span>
                            </div>
                            <span class="badge badge-ongoing px-3 py-2 rounded-pill">Sedang Disewa</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('images/product.jpg') }}" alt="Produk" class="rounded-3 object-fit-cover" style="width: 70px; height: 70px; background-color: #ddd;">
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Kamera Sony A7III</h6>
                                    <p class="mb-0 text-muted small">2 Barang • 2 Hari</p>
                                </div>
                            </div>
                            <div class="text-end">
                                <p class="text-muted small mb-1">Total Belanja</p>
                                <h6 class="fw-bold text-dark mb-0">Rp465.000</h6>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ route('rentals.detail', ['id' => 1]) }}" class="btn btn-outline-dark fw-semibold rounded-pill px-4">Lihat Detail</a>
                        </div>
                    </div>

                    <div class="card card-order p-4 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <div>
                                <i class="bi bi-clock-history me-2 text-warning"></i>
                                <span class="fw-bold text-dark">Sewa</span>
                                <span class="text-muted ms-2 small">17 Mei 2026</span>
                            </div>
                            <span class="badge badge-pending px-3 py-2 rounded-pill">Menunggu Pembayaran</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('images/product.jpg') }}" alt="Produk" class="rounded-3 object-fit-cover" style="width: 70px; height: 70px; background-color: #ddd;">
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">Lensa Canon 50mm</h6>
                                    <p class="mb-0 text-muted small">1 Barang • 1 Hari</p>
                                </div>
                            </div>
                            <div class="text-end">
                                <p class="text-muted small mb-1">Total Belanja</p>
                                <h6 class="fw-bold text-dark mb-0">Rp150.000</h6>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ route('payment.status', ['id' => 2]) }}" class="btn btn-dark fw-semibold rounded-pill px-4 me-2">Bayar Sekarang</a>
                            <a href="{{ route('rentals.detail', ['id' => 2]) }}" class="btn btn-outline-dark fw-semibold rounded-pill px-4">Lihat Detail</a>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="pills-pending" role="tabpanel">
                    <p class="text-muted text-center mt-5">Fitur filter ini akan berfungsi penuh saat sudah disambungkan ke database.</p>
                </div>
                
                <div class="tab-pane fade" id="pills-ongoing" role="tabpanel"></div>

                <div class="tab-pane fade" id="pills-completed" role="tabpanel"></div>

            </div>
        </div>
    </div>
</div>
@endsection