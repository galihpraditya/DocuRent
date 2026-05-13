@extends('layouts.app') 
{{-- Asumsi kamu sudah menghubungkan Bootstrap CSS & JS di layouts/app.blade.php --}}

@section('content')
<style>
    /* Mengatur latar belakang halaman agar full screen dan berada di tengah */
    .login-wrapper {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        /* Ganti path url() di bawah jika ingin menggunakan gambar asli website di background */
        background-color: #f8f9fa; 
        background-image: url('/path/ke/gambar/background-beranda.jpg'); 
        background-size: cover;
        background-position: center;
    }

    /* Overlay untuk memberikan efek BLUR dan sedikit gelap pada background */
    .login-wrapper::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0, 0, 0, 0.4); /* Warna overlay transparan */
        backdrop-filter: blur(8px); /* Efek blur ala modern UI */
        -webkit-backdrop-filter: blur(8px);
        z-index: 1;
    }

    /* Styling untuk kotak "Pop-up" Login */
    .login-card {
        z-index: 2; /* Memastikan card berada di atas efek blur */
        width: 100%;
        max-width: 850px; /* Ukuran maksimal pop-up */
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    /* Bagian gambar (Sisi Kiri) */
    .login-image-section {
        background-color: #212529; /* Warna dasar jika gambar gagal dimuat */
        /* TODO: Masukkan path gambar kamera kamu di sini (misal di folder public/images/) */
        background-image: url('/path/ke/gambar/kamera-kamu.jpg');
        background-size: cover;
        background-position: center;
        min-height: 400px;
    }

    /* Styling tombol login agar membulat sesuai desain */
    .btn-login {
        background-color: #1c2024;
        color: #ffffff;
        border-radius: 30px;
        padding: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background-color: #000000;
        color: #ffffff;
    }

    /* Menghilangkan border focus bawaan bootstrap agar lebih elegan */
    .form-control:focus {
        border-color: #1c2024;
        box-shadow: none;
    }
</style>

<div class="login-wrapper">
    <div class="card border-0 login-card mx-3 mx-md-0">
        <div class="row g-0 h-100">
            
            <div class="col-md-6 d-none d-md-block login-image-section">
                </div>

            <div class="col-md-6 bg-white">
                <div class="card-body p-4 p-lg-5 d-flex flex-column justify-content-center h-100">
                    
                    <div class="text-center mb-4 mt-2">
                        <h2 class="fw-bold mb-1" style="color: #000;">Welcome</h2>
                        <p class="text-muted small">Login dengan Email</p>
                    </div>

                    <form action="#" method="POST">
                        @csrf <div class="mb-3">
                            <label for="email" class="form-label small fw-semibold" style="color: #333;">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label small fw-semibold" style="color: #333;">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-login w-100 mb-4">Login</button>

                        <div class="text-center small" style="color: #666;">
                            Belum punya akun?<br>
                            <a href="#" class="text-dark fw-bold text-decoration-none">Daftar sekarang</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection