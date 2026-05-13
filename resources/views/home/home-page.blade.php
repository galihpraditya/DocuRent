@extends('layouts.app')

@section('content')
<style>
    /* Mengaktifkan efek scroll yang mulus saat anchor link diklik */
    html {
        scroll-behavior: smooth;
    }

    /* Custom CSS menyesuaikan referensi kamu dengan sentuhan modern */
    .hero-section {
        background-color: #000;
        color: #fff;
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }

    .nav-button-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: 30px 0;
        flex-wrap: wrap; /* Agar rapi di layar kecil */
    }

    .nav-button {
        background-color: #ffffff;
        border: 1px solid #ccc;
        padding: 10px 25px;
        border-radius: 30px;
        color: #333;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .nav-button:hover {
        background-color: #1c2024;
        color: #fff;
        border-color: #1c2024;
    }

    /* Styling Section dari referensimu */
    .content-section {
        margin-top: 40px;
        padding-top: 80px; /* Offset agar saat discroll tidak tertutup navbar (asumsi navbar fixed/sticky) */
        margin-bottom: 50px;
    }

    /* Styling Product Card berbasis Flexbox sesuai referensimu */
    .product-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center; /* Memastikan produk berada di tengah */
    }

    .product-card {
        width: 220px; /* Sedikit diperlebar dari 180px agar teks dan harga lebih leluasa */
        border: 1px solid #eaeaea;
        border-radius: 8px;
        padding: 12px;
        text-align: left;
        background: #fff;
        transition: transform 0.2s;
    }

    .product-card:hover {
        transform: translateY(-5px); /* Efek melayang saat di-hover */
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .product-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        background: #f4f4f4;
        border-radius: 6px;
        margin-bottom: 10px;
    }
</style>

<!-- Hero Section (Tetap menggunakan desain sebelumnya) -->
<section class="hero-section">
    <div class="container py-md-5">
        <div class="row align-items-center">
            <div class="col-md-6 z-2">
                <h1 class="fw-bold display-5 mb-4" style="line-height: 1.2;">SEWA KAMERA & ALAT DOKUMENTASI DENGAN CEPAT DAN MUDAH HANYA DI DOCURENT</h1>
                <a href="#recommendation" class="btn btn-light rounded-pill px-5 py-2 fw-semibold">Mulai sewa</a>
            </div>
            <div class="col-md-6 position-relative z-1 text-end d-none d-md-block">
                <!-- TODO: Ganti path dengan foto hero kamu -->
                <img src="/path/ke/kamera-hero.png" alt="Kamera Hero" class="img-fluid" style="max-height: 350px; object-fit: contain;">
            </div>
        </div>
    </div>
</section>

<div class="container">

    {{-- Tombol Pindah Section --}}
    <div class="nav-button-container">
        <a href="#recommendation" class="nav-button">Rekomendasi</a>
        <a href="#catalog" class="nav-button">Katalog</a>
        <a href="#gallery" class="nav-button">Galeri</a>
    </div>

    {{-- 
        Include Sections 
        Catatan: Aku tetap menggunakan nama file yang sudah kita sepakati di awal 
        (pakai akhiran -section) agar file yang sudah kamu buat tidak error.
    --}}
    
    <div id="recommendation" class="content-section">
        @include('sections.recommendation')
    </div>

    <!-- Garis pemisah antar section -->
    <hr style="border-color: #ddd;">

    <div id="catalog" class="content-section">
        @include('sections.catalog')
    </div>

    <hr style="border-color: #ddd;">

    <div id="gallery" class="content-section">
        @include('sections.gallery')
    </div>

</div>
@endsection