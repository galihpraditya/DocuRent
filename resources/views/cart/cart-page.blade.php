@extends('layouts.app')

@section('content')
<style>
    .custom-input-clean {
        border: none;
        background: transparent;
        outline: none;
        box-shadow: none !important;
        font-size: 0.85rem;
    }
    
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    input[type=number] {
        -appearance: textfield;
    }

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

                    <!-- HEADER -->
                    <div class="row bg-light rounded-pill py-3 mb-4 text-center fw-semibold cart-header-row"
                        style="background-color: #f0f0f0 !important;">

                        <div class="col-5 text-start ps-5">Produk</div>
                        <div class="col-2">Jumlah</div>
                        <div class="col-3">Aksi</div>
                        <div class="col-2">Subtotal</div>

                    </div>

                    @php
                        $grandTotal = 0;
                    @endphp

                    @foreach($cart->cartItems as $item)

                        @php
                            $subtotal =
                                $item->product->harga_sewa *
                                $item->jumlah
                        @endphp

                        <!-- ITEM -->
                        <div class="row align-items-center bg-light rounded-4 p-3 mb-3 cart-item-row"
                            style="background-color: #f4f4f4 !important;">

                            <!-- PRODUCT -->
                            <div class="col-lg-5 d-flex align-items-center gap-3 cart-item-col">

                                <img src="{{ asset('storage/' . $item->product->gambar) }}"
                                    class="rounded-3 shadow-sm"
                                    style="width: 80px; height: 80px; object-fit: cover;">

                                <div>
                                    <h6 class="fw-bold mb-1">
                                        {{ $item->product->nama_produk }}
                                    </h6>

                                    <small class="text-muted">
                                        Rp {{ number_format($item->product->harga_sewa) }} / Hari
                                    </small>
                                </div>

                            </div>

                            <!-- QTY -->
                            <div class="col-lg-2 d-flex justify-content-lg-center cart-item-col">

                                <form action="{{ route('cart-items.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="bg-white border rounded-pill d-flex align-items-center px-2 py-1">

                                        <input type="number"
                                            name="jumlah"
                                            value="{{ $item->jumlah }}"
                                            min="1"
                                            class="custom-input-clean text-center fw-semibold mx-1"
                                            style="width: 50px;">

                                    </div>

                            </div>

                            <!-- AKSI -->
                            <div class="col-lg-3 cart-item-col">

                                <div class="d-flex flex-column gap-2 align-items-center">

                                    <button type="submit" class="btn btn-sm btn-dark w-60">
                                        Update
                                    </button>

                                </form>

                                <form action="{{ route('cart-items.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger w-60">
                                        Hapus
                                    </button>
                                </form>

                                </div>

                            </div>

                            <!-- SUBTOTAL -->
                            <div class="col-lg-2 d-flex align-items-center justify-content-lg-end cart-item-col mt-3 mt-lg-0">

                                <span class="fw-bold text-nowrap">
                                    Rp {{ number_format($subtotal) }}
                                </span>

                            </div>

                        </div>

                    @endforeach

                </div>
            </div>

        </div>

        <div class="col-lg-4">

            @if($cart && $cart->cartItems->count() > 0)

                <div class="card border rounded-4 shadow-sm border-0 sticky-top"
                    style="top: 100px; border: 1px solid #e0e0e0 !important;">

                    <div class="card-body p-4 p-lg-5">

                        <h5 class="fw-bold text-center mb-4 pb-2">
                            Ringkasan Sewa
                        </h5>

                        {{-- FORM CALCULATE --}}
                        <form action="{{ route('cart.calculate') }}" method="POST">

                            @csrf

                            <div class="mb-3">

                                <label class="small fw-semibold">Tanggal Mulai</label>

                                <input type="date"
                                    name="tanggal_sewa"
                                    class="form-control"
                                    value="{{ $tanggalMulai ?? '' }}"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="small fw-semibold">Tanggal Selesai</label>

                                <input type="date"
                                    name="tanggal_kembali"
                                    class="form-control"
                                    value="{{ $tanggalSelesai ?? '' }}"
                                    required>

                            </div>

                            <button type="submit"
                                    class="btn btn-dark w-100 mb-4">
                                Hitung Total
                            </button>

                        </form>

                        {{-- TOTAL --}}
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-dark fw-semibold">Total:</span>

                            <span class="text-dark fw-bold">
                                Rp {{ number_format($totalHarga ?? 0) }}
                            </span>
                        </div>

                        <hr class="mb-4" style="border-color: #ccc;">

                        {{-- CHECKOUT --}}
                        @if(isset($totalHarga))
                            <form action="{{ route('cart.checkout-page') }}" method="POST">

                                @csrf

                                <input type="hidden"
                                    name="tanggal_sewa"
                                    value="{{ $tanggalMulai }}">

                                <input type="hidden"
                                    name="tanggal_kembali"
                                    value="{{ $tanggalSelesai }}">

                                <button type="submit"
                                        class="btn btn-dark w-100 rounded-pill fw-semibold py-2 d-flex align-items-center justify-content-center"
                                        style="background-color: #000; height: 50px;">
                                    Lanjut ke Pembayaran
                                </button>

                            </form>
                        @endif

                    </div>

                </div>
            
            @else
                <div class="d-flex align-items-center justify-content-center" style="min-height: 200px;">
                    <p class="fw-semibold fs-5 text-muted my-5">
                        Cart kosong
                    </p>
                </div>
            @endif

        </div>

    </div>
</div>
@endsection
