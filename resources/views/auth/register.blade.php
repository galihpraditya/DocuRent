@extends('layouts.app')

@section('content')
<style>
    /* Wrapper dibuat mirip dengan login */
    .register-wrapper {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa; 
        /* TODO: Samakan gambar background dengan login */
        background-image: url('/path/ke/gambar/background-beranda.jpg'); 
        background-size: cover;
        background-position: center;
        padding: 2rem 1rem; /* Tambahan padding agar form tidak menempel di ujung layar mobile */
    }

    .register-wrapper::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 1;
    }

    .register-card {
        z-index: 2;
        width: 100%;
        /* Diperlebar menjadi 900px untuk mengakomodasi 6 input field dengan 2 kolom */
        max-width: 900px; 
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    /* Bagian Gambar (Kiri) */
    .register-image-section {
        background-color: #212529;
        background-image: url("{{ asset('images/login-background.jpg') }}");
        background-size: cover;
        background-position: center;
        min-height: 100%; 
    }

    .btn-register {
        background-color: #1c2024;
        color: #ffffff;
        border-radius: 30px;
        padding: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
        background-color: #000000;
        color: #ffffff;
    }

    .form-control:focus {
        border-color: #1c2024;
        box-shadow: none;
    }

    /* Mengecilkan sedikit ukuran font label agar terlihat rapi */
    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.3rem;
    }
</style>

<div class="register-wrapper">
    <div class="card border-0 register-card mx-auto">
        <div class="row g-0 h-100">
            
            <!-- Kiri: Gambar Kamera (Disembunyikan di layar mobile) -->
            <!-- Menggunakan col-md-5 agar area gambar sedikit lebih kecil, memberi ruang lebih untuk form -->
            <div class="col-md-5 d-none d-md-block register-image-section">
            </div>

            <!-- Kanan: Form Register -->
            <div class="col-md-7 bg-white">
                <div class="card-body p-4 p-lg-5">
                    
                    <!-- Header Form -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mb-1" style="color: #000;">Get Started</h2>
                        <p class="text-muted small">Buat Akun Baru</p>
                    </div>

                    <form method="POST" action="/register">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger small">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Baris 1 -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">
                                    Nama Lengkap
                                </label>

                                <input 
                                    type="text"
                                    class="form-control"
                                    id="nama"
                                    name="nama"
                                    value="{{ old('nama') }}"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">
                                    Username
                                </label>

                                <input 
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    value="{{ old('username') }}"
                                    required
                                >
                            </div>

                        </div>

                        <!-- Baris 2 -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    Email
                                </label>

                                <input 
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label">
                                    Nomor Telp / HP
                                </label>

                                <input 
                                    type="text"
                                    class="form-control"
                                    id="no_hp"
                                    name="no_hp"
                                    value="{{ old('no_hp') }}"
                                    required
                                >
                            </div>

                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">

                            <label for="alamat" class="form-label">
                                Alamat Lengkap
                            </label>

                            <textarea 
                                class="form-control"
                                id="alamat"
                                name="alamat"
                                rows="2"
                                required
                            >{{ old('alamat') }}</textarea>

                        </div>

                        <!-- Password -->
                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <input 
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    required
                                >

                            </div>

                            <div class="col-md-6 mb-4">

                                <label for="password_confirmation" class="form-label">
                                    Konfirmasi Password
                                </label>

                                <input 
                                    type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    required
                                >

                            </div>

                        </div>

                        <!-- Tombol -->
                        <button type="submit" class="btn btn-register w-100 mb-3">
                            Register
                        </button>

                        <!-- Login -->
                        <div class="text-center small" style="color: #666;">

                            Sudah punya akun?<br>

                            <a 
                                href="{{ route('login') }}"
                                class="text-dark fw-bold text-decoration-none"
                            >
                                Login di sini
                            </a>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection