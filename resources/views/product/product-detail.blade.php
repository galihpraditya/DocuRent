@extends('layouts.app')

@section('content')
<style>
    /* Styling untuk garis pemisah vertikal (hanya muncul di desktop) */
    @media (min-width: 768px) {
        .detail-divider {
            border-left: 2px solid #dcdcdc;
            padding-left: 40px; /* Jarak antara garis dengan teks detail */
        }
    }

    /* Styling Custom untuk Tab Deskripsi */
    .product-tabs .nav-link {
        color: #888;
        font-weight: 500;
        border: none;
        padding: 10px 15px;
        margin-right: 15px;
        background: transparent;
        border-bottom: 2px solid transparent;
    }
    
    .product-tabs .nav-link:hover {
        color: #333;
    }

    .product-tabs .nav-link.active {
        color: #000;
        font-weight: 700;
        border-bottom: 2px solid #000; /* Garis hitam tebal di bawah tab aktif */
    }

    .product-tabs-container {
        border-bottom: 1px solid #dcdcdc; /* Garis abu-abu panjang di bawah seluruh tab */
        margin-bottom: 20px;
    }

    /* Styling Custom untuk Input di Bottom Bar */
    .custom-underline-input {
        border: none;
        border-bottom: 1px solid #aaa;
        border-radius: 0;
        background: transparent;
        padding: 0 5px;
        font-size: 0.9rem;
        outline: none;
        box-shadow: none !important;
        color: #555;
    }

    .custom-underline-input:focus {
        border-bottom: 1px solid #000;
    }
    
    /* Menghilangkan border focus bawaan bootstrap */
    .form-control:focus {
        border-color: transparent;
        box-shadow: none;
    }
</style>

<div class="container my-5 py-4">
    <div class="row">
        
        <!-- KOLOM KIRI: Gambar Produk -->
        <div class="col-md-5 mb-5 mb-md-0">
            <!-- Gambar Utama -->
            <div class="bg-light rounded-4 d-flex align-items-center justify-content-center shadow-sm mb-4" style="height: 400px; overflow: hidden; border: 1px solid #eaeaea;">
                <!-- TODO: Ganti src dengan gambar aslimu -->
                <img src="/path/ke/gambar-utama.jpg" alt="Gambar Utama" class="img-fluid w-100 h-100" style="object-fit: cover; display: none;">
                <!-- Ikon placeholder jika gambar belum ada -->
                <i class="bi bi-camera text-secondary" style="font-size: 5rem;"></i>
            </div>
            
            <!-- Thumbnail Gambar -->
            <div class="d-flex gap-3 justify-content-center">
                @for ($i = 0; $i < 3; $i++)
                <div class="bg-light rounded-3 shadow-sm" style="width: 90px; height: 90px; border: 1px solid #eaeaea; cursor: pointer;">
                    <!-- TODO: Ganti src dengan gambar thumbnail -->
                    <!-- <img src="/path/ke/thumb.jpg" class="w-100 h-100 rounded-3" style="object-fit: cover;"> -->
                </div>
                @endfor
            </div>
        </div>

        <!-- KOLOM KANAN: Detail & Transaksi -->
        <div class="col-md-7 detail-divider">
            <h1 class="fw-bold mb-2">Kamera xxx</h1>
            <p class="mb-3 small">Status: <span class="text-success fw-semibold">Tersedia</span></p>
            <h2 class="fw-bold mb-4">Rp120.000 / Hari</h2>

            <!-- Nav Tabs -->
            <div class="product-tabs-container">
                <ul class="nav nav-pills product-tabs" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="spek-tab" data-bs-toggle="tab" data-bs-target="#spek" type="button" role="tab">Spesifikasi Produk</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="kondisi-tab" data-bs-toggle="tab" data-bs-target="#kondisi" type="button" role="tab">Kondisi Produk</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ulasan-tab" data-bs-toggle="tab" data-bs-target="#ulasan" type="button" role="tab">Ulasan</button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="tab-content text-dark mb-5" id="productTabContent" style="min-height: 120px; font-size: 0.95rem; line-height: 1.6;">
                <div class="tab-pane fade show active" id="spek" role="tabpanel">
                    <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="tab-pane fade" id="kondisi" role="tabpanel">
                    <p>Kondisi fisik 95% mulus. Sensor bersih tanpa jamur. Karet kencang tidak melar. Sudah termasuk strap, 1 baterai, dan charger.</p>
                </div>
                <div class="tab-pane fade" id="ulasan" role="tabpanel">
                    <p class="text-muted fst-italic">Belum ada ulasan untuk produk ini.</p>
                </div>
            </div>

            <!-- Booking Action Bar (Mirip Pop-up Melayang di Bawah) -->
            <div class="border rounded-pill p-3 px-4 d-flex align-items-center justify-content-between flex-wrap gap-3 mt-4" style="border-color: #ddd !important;">
                
                <!-- Input Jumlah -->
                <div class="d-flex align-items-center gap-2">
                    <label class="fw-bold small mb-0 text-dark">Jumlah Alat:</label>
                    <input type="number" value="1" min="1" class="custom-underline-input text-center" style="width: 50px;">
                </div>

                <!-- Input Tanggal Sewa -->
                <div class="d-flex align-items-center gap-2">
                    <label class="fw-bold small mb-0 text-dark">Tanggal Sewa:</label>
                    <div class="d-flex align-items-center gap-2">
                        <!-- Tanggal Mulai -->
                        <input type="date" class="custom-underline-input" style="width: 110px;">
                        <span class="text-muted fw-bold">-</span>
                        <!-- Tanggal Selesai -->
                        <input type="date" class="custom-underline-input" style="width: 110px;">
                    </div>
                </div>

                <!-- Tombol Add to Cart -->
                <button class="btn btn-dark rounded-circle d-flex align-items-center justify-content-center border-0" style="width: 45px; height: 45px; background-color: #222;">
                    <i class="bi bi-cart-plus-fill fs-5 text-white"></i>
                </button>
            </div>

        </div>
    </div>
</div>
@endsection