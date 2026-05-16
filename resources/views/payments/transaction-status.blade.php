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
                
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-clock fs-1 text-dark"></i>
                        <div>
                            <h4 class="fw-bold mb-0 text-dark">Bayar sebelum</h4>
                            <p class="mb-0 text-muted" style="font-size: 0.9rem;">17 Mei 2026, 23:59 WIB</p>
                        </div>
                    </div>

                    <div class="d-flex gap-2 text-center align-items-start">
                        <div>
                            <div class="timer-box">23</div>
                            <small class="text-muted" style="font-size: 0.75rem;">Jam</small>
                        </div>
                        <div class="fs-4 fw-bold text-muted" style="margin-top: 2px;">:</div>
                        <div>
                            <div class="timer-box">59</div>
                            <small class="text-muted" style="font-size: 0.75rem;">Menit</small>
                        </div>
                        <div class="fs-4 fw-bold text-muted" style="margin-top: 2px;">:</div>
                        <div>
                            <div class="timer-box">10</div>
                            <small class="text-muted" style="font-size: 0.75rem;">Detik</small>
                        </div>
                    </div>
                </div>

                <div class="alert alert-custom p-3 d-flex align-items-start gap-3 mb-4">
                    <i class="bi bi-exclamation-triangle-fill fs-5 text-dark mt-1"></i>
                    <div>
                        <strong class="d-block text-dark" style="font-size: 0.95rem;">Buruan selesaikan pembayaranmu</strong>
                        <span class="small">Stok Barang di pesananmu tinggal sedikit. Segera bayar biar gak kehabisan stok</span>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-muted mb-1" style="font-size: 0.95rem;">Nomor Virtual Account</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <h2 class="fw-bold mb-0 text-dark">80732XXXXXXXXX</h2>
                            <i class="bi bi-files fs-5 text-muted copy-icon" title="Salin Nomor VA"></i>
                        </div>
                        <img src="{{ asset('images/logo-bca.png') }}" alt="BCA" style="height: 25px; width: 70px; object-fit: contain;">
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-muted mb-1" style="font-size: 0.95rem;">Total Tagihan</p>
                    <div class="d-flex align-items-center gap-3">
                        <h2 class="fw-bold mb-0 text-dark">Rp465.000</h2>
                        <i class="bi bi-files fs-5 text-muted copy-icon" title="Salin Nominal"></i>
                    </div>
                </div>

                <hr style="border-color: #ddd;" class="my-4">

                <ul class="text-muted small ps-3 mb-0">
                    <li class="mb-1"><strong>Perhatian:</strong> Transfer Virtual Account hanya bisa dilakukan dari bank yang kamu pilih</li>
                    <li>Transaksi kamu baru akan diteruskan ke admin setelah pembayaran berhasil diverifikasi.</li>
                </ul>

            </div>

            <div class="card card-status p-4 p-md-5 mb-5">
                <h4 class="fw-bold mb-4 text-dark">Cara pembayaran</h4>

                <div class="accordion accordion-flush" id="accordionCaraPembayaran">
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed fs-5 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                ATM BCA
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionCaraPembayaran">
                            <div class="accordion-body">
                                <ol class="ps-3 mb-0">
                                    <li class="mb-2">Masukkan Kartu ATM BCA & PIN.</li>
                                    <li class="mb-2">Pilih menu <strong>Transaksi Lainnya > Transfer > ke Rekening BCA Virtual Account</strong>.</li>
                                    <li class="mb-2">Masukkan 5 angka kode perusahaan dan Nomor HP yang terdaftar (Contoh: 80732 XXXXXXX).</li>
                                    <li class="mb-2">Di halaman konfirmasi, pastikan detil pembayaran sudah sesuai seperti No VA, Nama, Perus/Produk dan Total Tagihan.</li>
                                    <li>Ikuti instruksi untuk menyelesaikan transaksi.</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed fs-5 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                m-BCA (BCA mobile)
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionCaraPembayaran">
                            <div class="accordion-body">
                                <ol class="ps-3 mb-0">
                                    <li class="mb-2">Lakukan log in pada aplikasi BCA Mobile.</li>
                                    <li class="mb-2">Pilih menu <strong>m-BCA Transfer > m-Transfer > BCA Virtual Account</strong>.</li>
                                    <li class="mb-2">Masukkan nomor BCA Virtual Account dan klik <strong>Send</strong>.</li>
                                    <li class="mb-2">Periksa informasi yang tertera di layar. Pastikan nama merchant adalah DocuRent, Total tagihan sudah benar dan username kamu.</li>
                                    <li>Masukkan PIN m-BCA Anda dan pilih <strong>OK</strong>.</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="paymentSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 p-3">
            <div class="modal-body text-center">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                <h3 class="fw-bold mt-3 mb-2 text-dark">Pembayaran Berhasil!</h3>
                <p class="text-muted mb-4">Terima kasih, pembayaranmu telah kami verifikasi. Pesananmu sedang disiapkan.</p>
                
                <a href="{{ route('rentals.list') }}" class="btn btn-dark w-100 rounded-pill py-2 fw-semibold">
                    Lihat Pesanan Saya
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Anggap saja ini adalah simulasi respon sukses dari Payment Gateway
        setTimeout(function() {
            var myModal = new bootstrap.Modal(document.getElementById('paymentSuccessModal'));
            myModal.show();
        }, 5000); // Muncul setelah 5000 milidetik (5 detik)
    });
</script>

@endsection