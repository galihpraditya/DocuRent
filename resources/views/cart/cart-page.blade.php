@extends('layouts.app')

@section('content')
<style>
    /* Styling untuk menghilangkan border bawaan input date & number */
    .custom-input-clean {
        border: none;
        background: transparent;
        outline: none;
        box-shadow: none !important;
        font-size: 0.85rem;
    }
    
    /* Menghilangkan panah atas-bawah bawaan browser pada input tipe number */
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    input[type=number] {
        -appearance: textfield;
    }

    /* Kustomisasi bentuk kotak Promo */
    .promo-input-group {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }
    .promo-input-group input {
        border: none;
        background-color: #fafafa;
    }
    .promo-input-group button {
        border: none;
        background-color: #fafafa;
        color: #333;
    }
    
    /* Responsivitas text agar tidak terlalu besar di layar kecil */
    @media (max-width: 991px) {
        .cart-header-row { display: none !important; }
        .cart-item-row { flex-direction: column; align-items: flex-start !important; gap: 15px; }
        .cart-item-col { width: 100% !important; display: flex; justify-content: space-between; align-items: center;}
    }
</style>

<div class="container my-5">
    <h2 class="text-center fw-bold mb-5" style="font-size: 2.5rem;">Keranjang</h2>

    <div class="row g-4">
        
        <div class="col-lg-8">
            <div class="card border rounded-4 shadow-sm border-0" style="border: 1px solid #e0e0e0 !important;">
                <div class="card-body p-4">
                    
                    <div class="row bg-light rounded-pill py-3 mb-4 text-center fw-semibold cart-header-row" style="background-color: #f0f0f0 !important;">
                        <div class="col-4 text-start ps-5">Produk</div>
                        <div class="col-2">Jumlah</div>
                        <div class="col-4">Tanggal Sewa</div>
                        <div class="col-2">Subtotal</div>
                    </div>

                    <div class="row align-items-center bg-light rounded-4 p-3 mb-3 cart-item-row" style="background-color: #f4f4f4 !important;">
                        
                        <div class="col-lg-4 d-flex align-items-center gap-3 cart-item-col">
                            <img src="{{ asset('images/product.jpg') }}" alt="Kamera" class="rounded-3 object-fit-cover shadow-sm" style="width: 80px; height: 80px; background-color: #ddd;">
                            <div>
                                <h6 class="fw-bold mb-1">Kamera xxx</h6>
                                <small class="text-muted">Rp. 120.000 / Hari</small>
                            </div>
                        </div>

                        <div class="col-lg-2 d-flex justify-content-lg-center cart-item-col">
                            <div class="bg-white border rounded-pill d-flex align-items-center px-2 py-1">
                                <button class="btn btn-sm p-0 text-muted border-0"><i class="bi bi-dash"></i></button>
                                <input type="number" value="2" class="custom-input-clean text-center fw-semibold mx-1" style="width: 30px;" readonly>
                                <button class="btn btn-sm p-0 text-muted border-0"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>

                        <div class="col-lg-4 cart-item-col">
                            <div class="d-flex flex-column gap-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-dark small" style="width: 50px;">Mulai:</span>
                                    <div class="bg-white border rounded-2 px-2 py-1 d-flex align-items-center w-100">
                                        <input type="date" class="custom-input-clean w-100 text-muted">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-dark small" style="width: 50px;">Sampai:</span>
                                    <div class="bg-white border rounded-2 px-2 py-1 d-flex align-items-center w-100">
                                        <input type="date" class="custom-input-clean w-100 text-muted">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 d-flex align-items-center justify-content-between justify-content-lg-end gap-lg-3 cart-item-col mt-3 mt-lg-0">
                            <span class="fw-bold text-nowrap">Rp. 480.000</span>
                            <button class="btn btn-link text-dark p-0 text-decoration-none hover-danger">
                                <i class="bi bi-trash-fill fs-5"></i>
                            </button>
                        </div>
                    </div>

                    <div class="rounded-4 mb-3" style="height: 100px; background-color: #f4f4f4;"></div>
                    <div class="rounded-4" style="height: 100px; background-color: #f4f4f4;"></div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border rounded-4 shadow-sm border-0 sticky-top" style="top: 100px; border: 1px solid #e0e0e0 !important;">
                <div class="card-body p-4 p-lg-5">
                    
                    <h5 class="fw-bold text-center mb-4 pb-2">Ringkasan Sewa</h5>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-dark fw-semibold">Total:</span>
                        <span class="text-dark fw-bold">Rp. 480.000</span>
                    </div>
                    
                    <hr class="mb-4" style="border-color: #ccc;">

                    <div class="input-group promo-input-group mb-5">
                        <input type="text" class="form-control shadow-none py-2 px-3 small text-muted" placeholder="Masukkan Kode Promo" style="font-size: 0.85rem;">
                        <button class="btn fw-semibold small" type="button" style="font-size: 0.85rem;">Pakai</button>
                    </div>

                    <a href="{{ route('payment.checkout') }}" class="btn btn-dark w-100 rounded-pill fw-semibold py-2 d-flex align-items-center justify-content-center" style="background-color: #000; height: 50px;">
                        Lanjut ke Pembayaran
                    </a>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection