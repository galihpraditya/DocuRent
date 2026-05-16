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
        background-color: transparent !important;
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

            <!-- Gambar Produk -->
            <div 
                class="bg-light rounded-4 d-flex align-items-center justify-content-center shadow-sm mb-4"
                style="height: 550; overflow: hidden; border: 1px solid #eaeaea;"
            >

                <img 
                    src="{{ asset('storage/' . $product->gambar) }}"
                    alt="{{ $product->nama_produk }}"
                    class="img-fluid w-100 h-100"
                    style="object-fit: cover;"
                >

            </div>

        </div>

        <!-- KOLOM KANAN: Detail & Transaksi -->
        <div class="col-md-7 detail-divider">
            <h1 class="fw-bold mb-2">
                {{ $product->nama_produk }}
            </h1>

            <p class="mb-3 small">
                Stok: 
                @if($product->stok > 0)
                    <span class="text-success fw-semibold">
                        {{ $product->stok }}
                    </span>
                @else
                    <span class="text-danger fw-semibold">
                        Habis
                    </span>
                @endif
            </p>

            <h2 class="fw-bold mb-4">
                Rp{{ number_format($product->harga_sewa, 0, ',', '.') }} / Hari
            </h2>

            <!-- Nav Tabs -->
            <div class="product-tabs-container">
                <ul class="nav nav-pills product-tabs" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="spek-tab" data-bs-toggle="tab" data-bs-target="#spek" type="button" role="tab">Deskripsi Produk</button>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="tab-content text-dark mb-5" id="productTabContent" style="min-height: 120px; font-size: 0.95rem; line-height: 1.6;">
                <div class="tab-pane fade show active" id="spek" role="tabpanel">
                    <p style="text-align: justify;">
                        {{ $product->deskripsi }}
                    </p>
                </div>
            </div>

            {{-- Booking Action Bar --}}
            <form action="{{ route('cart-items.store') }}" method="POST">

                @csrf

                <input 
                    type="hidden" 
                    name="product_id" 
                    value="{{ $product->id }}"
                >

                <!-- Booking Action Bar -->
                <div 
                    class="border rounded-pill py-2 px-4 d-inline-flex align-items-center gap-3 mt-4"
                    style="border-color: #ddd !important;"
                >
                    
                    <!-- Input Jumlah -->
                    <div class="d-flex align-items-center gap-2">

                        <label class="fw-bold small mb-0 text-dark">
                            Jumlah Alat:
                        </label>

                        <input 
                            type="number"
                            name="jumlah"
                            value="1"
                            min="1"
                            class="custom-underline-input text-center"
                            style="width: 50px;"
                        >

                    </div>

                    <!-- Tombol Add To Cart -->
                    <button 
                        type="submit"
                        class="btn btn-dark rounded-circle d-flex align-items-center justify-content-center border-0"
                        style="width: 45px; height: 45px; background-color: #222;"
                    >
                        <i class="bi bi-cart-plus-fill fs-5 text-white"></i>
                    </button>

                </div>

            </form>

            <div class="mt-3">
                <a href="/" class="text-decoration-none">
                    ← Kembali
                </a>
            </div>

        </div>
    </div>
</div>
@endsection