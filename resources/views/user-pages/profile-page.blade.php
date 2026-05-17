@extends('layouts.app')

@section('content')
<style>
    .profile-wrapper {
        background-color: #f2f4f6;
        min-height: calc(100vh - 70px);
        padding: 40px 0;
    }

    .card-profile {
        background-color: #ffffff;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    /* Kustomisasi Tab Navigasi */
    .nav-pills .nav-link {
        color: #555;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        margin-right: 10px;
        transition: all 0.2s ease;
    }
    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
    }
    .nav-pills .nav-link.active {
        background-color: #f4f4f4; /* Abu-abu terang untuk tab aktif */
        color: #000;
        border-bottom: 2px solid #000;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    /* Kustomisasi Input Form */
    .custom-input {
        background-color: #fafafa;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 0.95rem;
        box-shadow: none !important;
        transition: border-color 0.2s;
    }
    .custom-input:focus {
        border-color: #ccc;
        background-color: #fff;
    }

    .btn-save {
        background-color: #1c2024;
        color: #ffffff;
        border-radius: 8px;
        font-weight: 600;
        padding: 12px 30px;
        transition: background-color 0.2s;
    }
    .btn-save:hover { background-color: #000; color: #fff; }

    /* Avatar styling */
    .avatar-container {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
        border: 3px solid #f2f4f6;
        position: relative;
    }
    .avatar-edit-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: #000;
        color: #fff;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 2px solid #fff;
        transition: transform 0.2s;
    }
    .avatar-edit-btn:hover { transform: scale(1.1); }
</style>

<div class="profile-wrapper">
    <div class="container">
        
        <h3 class="fw-bold mb-4 text-dark">Profil Saya</h3>

        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card card-profile p-4 text-center">
                    
                    <div class="position-relative d-inline-block mb-3">
                        <div class="avatar-container bg-light d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-fill text-secondary" style="font-size: 5rem;"></i>
                            </div>
                        <div class="avatar-edit-btn" title="Ubah Foto Profil">
                            <i class="bi bi-camera-fill" style="font-size: 0.8rem;"></i>
                        </div>
                    </div>

                    <h5 class="fw-bold text-dark mb-1">Username</h5>
                    <p class="text-muted small mb-3">user@email.com</p>
                    
                    <hr style="border-color: #eaeaea;">

                    <div class="d-flex justify-content-between text-start mt-3">
                        <span class="text-muted small">Bergabung sejak</span>
                        <span class="text-dark fw-semibold small">10 Mei 2026</span>
                    </div>
                    <div class="d-flex justify-content-between text-start mt-2">
                        <span class="text-muted small">Total Transaksi</span>
                        <span class="text-dark fw-semibold small">5 Pesanan</span>
                    </div>

                </div>
            </div>

            <div class="col-lg-8">
                <div class="card card-profile p-4 p-md-5">
                    
                    <ul class="nav nav-pills border-bottom mb-4 pb-2" id="profile-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="biodata-tab" data-bs-toggle="pill" data-bs-target="#biodata" type="button" role="tab">Biodata Diri</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="keamanan-tab" data-bs-toggle="pill" data-bs-target="#keamanan" type="button" role="tab">Keamanan</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="profile-tabs-content">
                        
                        <div class="tab-pane fade show active" id="biodata" role="tabpanel">
                            <form action="#" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small fw-semibold">Nama Lengkap</label>
                                        <input type="text" class="form-control custom-input" value="Username" placeholder="Masukkan nama lengkap">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-muted small fw-semibold">Nomor Telepon</label>
                                        <input type="text" class="form-control custom-input" value="081234567890" placeholder="Contoh: 0812...">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-semibold">Alamat Email</label>
                                    <input type="email" class="form-control custom-input" value="user@email.com" placeholder="Masukkan email aktif">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label text-muted small fw-semibold">Alamat Lengkap</label>
                                    <textarea class="form-control custom-input" rows="3" placeholder="Masukkan alamat lengkap untuk keperluan penyewaan">Lowokwaru, kota Malang, Jawa Timur</textarea>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="keamanan" role="tabpanel">
                            <form action="#" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-semibold">Password Saat Ini</label>
                                    <input type="password" class="form-control custom-input" placeholder="Masukkan password saat ini">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-semibold">Password Baru</label>
                                    <input type="password" class="form-control custom-input" placeholder="Minimal 8 karakter">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label text-muted small fw-semibold">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control custom-input" placeholder="Ketik ulang password baru">
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-save">Perbarui Password</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection