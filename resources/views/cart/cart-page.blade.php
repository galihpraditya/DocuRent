@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Back Button -->
    <a href="javascript:history.back()" class="inline-flex items-center text-sm font-bold text-zinc-500 hover:text-zinc-900 transition-colors mb-6">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>

    <div class="flex items-center space-x-4 mb-10">
        <h2 class="text-3xl font-bold text-zinc-900 tracking-tight">Keranjang Sewa</h2>
        @if(isset($cart) && $cart->cartItems->count() > 0)
            <span class="px-3 py-1 bg-zinc-100 text-zinc-600 rounded-full text-sm font-medium">{{ $cart->cartItems->count() }} item</span>
        @endif
    </div>

    @if(session('error'))
        <div class="p-4 mb-6 text-sm text-rose-800 rounded-xl bg-rose-50 border border-rose-200 flex items-center">
            <svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Cart Items -->
        <div class="lg:w-2/3">
            @if(isset($cart) && $cart->cartItems->count() > 0)
                <div class="bg-white rounded-3xl border border-zinc-200 overflow-hidden shadow-sm">
                    
                    <!-- Header -->
                    <div class="hidden sm:grid grid-cols-12 gap-4 p-6 bg-zinc-50 border-b border-zinc-200 text-sm font-semibold text-zinc-500 uppercase tracking-wider">
                        <div class="col-span-6">Produk</div>
                        <div class="col-span-3 text-center">Jumlah</div>
                        <div class="col-span-3 text-right">Subtotal / Hari</div>
                    </div>

                    <!-- Items -->
                    <div class="divide-y divide-zinc-100">
                        @foreach($cart->cartItems as $item)
                            <div class="p-6 grid grid-cols-1 sm:grid-cols-12 gap-6 sm:gap-4 items-center group transition-colors hover:bg-zinc-50/50">
                                
                                <!-- Product -->
                                <div class="col-span-1 sm:col-span-6 flex gap-4">
                                    <div class="w-24 h-24 rounded-2xl bg-zinc-100 overflow-hidden shrink-0 border border-zinc-200">
                                        <img src="{{ asset('storage/' . $item->product->gambar) }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <a href="{{ route('products.show', $item->product->id) }}" class="font-bold text-zinc-900 text-lg hover:text-rose-600 transition-colors mb-1">
                                            {{ $item->product->nama_produk }}
                                        </a>
                                        <p class="text-rose-500 font-semibold mb-3">Rp {{ number_format($item->product->harga_sewa, 0, ',', '.') }}<span class="text-xs text-zinc-500 font-normal">/hari</span></p>
                                        <form action="{{ route('cart-items.destroy', $item->id) }}" method="POST" hx-post="{{ route('cart-items.destroy', $item->id) }}" hx-target="body">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-zinc-400 hover:text-rose-600 transition-colors flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Quantity -->
                                <div class="col-span-1 sm:col-span-3 flex sm:justify-center">
                                    <form action="{{ route('cart-items.update', $item->id) }}" method="POST" hx-post="{{ route('cart-items.update', $item->id) }}" hx-trigger="change from:input" hx-target="body" class="flex items-center space-x-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex items-center border border-zinc-200 rounded-xl bg-white overflow-hidden shadow-sm focus-within:border-zinc-400 transition-colors">
                                            <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" max="{{ $item->product->stok }}" class="w-16 py-2 text-center text-sm font-semibold text-zinc-900 bg-transparent border-none focus:ring-0 outline-none">
                                        </div>
                                    </form>
                                </div>

                                <!-- Subtotal -->
                                <div class="col-span-1 sm:col-span-3 sm:text-right">
                                    <p class="text-zinc-900 font-bold text-lg">Rp {{ number_format($item->product->harga_sewa * $item->jumlah, 0, ',', '.') }}</p>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl border border-zinc-200 border-dashed p-16 flex flex-col items-center justify-center text-center">
                    <div class="w-24 h-24 bg-zinc-50 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-2">Keranjang Kosong</h3>
                    <p class="text-zinc-500 mb-8 max-w-md">Anda belum menambahkan peralatan apapun ke keranjang. Jelajahi katalog kami untuk menemukan gear yang tepat.</p>
                    <a href="{{ route('home') }}#catalog" class="px-8 py-3 bg-zinc-900 text-white rounded-xl font-semibold hover:bg-zinc-800 transition-colors shadow-lg">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>

        <!-- Order Summary -->
        <div class="lg:w-1/3">
            @if(isset($cart) && $cart->cartItems->count() > 0)
                @php
                    $baseTotalPerDay = 0;
                    foreach($cart->cartItems as $item) {
                        $baseTotalPerDay += ($item->product->harga_sewa * $item->jumlah);
                    }
                @endphp

                <div class="bg-white rounded-3xl border border-zinc-200 shadow-sm sticky top-28 p-8">
                    <h5 class="text-xl font-bold text-zinc-900 mb-6">Ringkasan Sewa</h5>

                    <form action="{{ route('cart.checkout-page') }}" method="POST" class="space-y-5" id="checkoutForm">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Tanggal Mulai</label>
                            <input type="date" id="tanggal_sewa" name="tanggal_sewa" value="{{ $tanggalMulai ?? date('Y-m-d') }}" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-3 outline-none transition-colors">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Tanggal Selesai</label>
                            <input type="date" id="tanggal_kembali" name="tanggal_kembali" value="{{ $tanggalSelesai ?? date('Y-m-d', strtotime('+1 day')) }}" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-3 outline-none transition-colors">
                        </div>

                        <div class="mt-8 pt-6 border-t border-zinc-200 border-dashed">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-zinc-500">Durasi Sewa</span>
                                <span class="font-semibold text-zinc-900" id="durasiDisplay">1 Hari</span>
                            </div>
                            <div class="flex justify-between items-end mt-4">
                                <span class="text-lg font-bold text-zinc-900">Total Biaya</span>
                                <span class="text-3xl font-bold text-rose-500" id="totalBiayaDisplay">Rp 0</span>
                            </div>
                        </div>

                        <button type="submit" id="btnCheckout" class="w-full bg-zinc-900 text-white rounded-xl py-4 font-semibold hover:bg-zinc-800 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex justify-center items-center mt-6">
                            Lanjut ke Pembayaran
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
                
                <script>
                    function initCartCalculation() {
                        const baseTotalPerDay = {{ $baseTotalPerDay }};
                        const tglSewaInput = document.getElementById('tanggal_sewa');
                        const tglKembaliInput = document.getElementById('tanggal_kembali');
                        const durasiDisplay = document.getElementById('durasiDisplay');
                        const totalBiayaDisplay = document.getElementById('totalBiayaDisplay');
                        const btnCheckout = document.getElementById('btnCheckout');

                        if (!tglSewaInput) return;

                        function calculateTotal() {
                            if (!tglSewaInput.value || !tglKembaliInput.value) {
                                durasiDisplay.innerText = '-';
                                totalBiayaDisplay.innerText = 'Rp 0';
                                btnCheckout.disabled = true;
                                btnCheckout.classList.add('opacity-50', 'cursor-not-allowed');
                                return;
                            }

                            const start = new Date(tglSewaInput.value);
                            const end = new Date(tglKembaliInput.value);
                            
                            const diffTime = end.getTime() - start.getTime();
                            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                            
                            if (diffDays <= 0) {
                                durasiDisplay.innerText = 'Tanggal Tidak Valid';
                                durasiDisplay.classList.add('text-rose-500');
                                totalBiayaDisplay.innerText = 'Rp 0';
                                btnCheckout.disabled = true;
                                btnCheckout.classList.add('opacity-50', 'cursor-not-allowed');
                                return;
                            } else {
                                durasiDisplay.classList.remove('text-rose-500');
                                btnCheckout.disabled = false;
                                btnCheckout.classList.remove('opacity-50', 'cursor-not-allowed');
                            }

                            const total = diffDays * baseTotalPerDay;
                            
                            durasiDisplay.innerText = diffDays + ' Hari';
                            totalBiayaDisplay.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
                        }

                        tglSewaInput.addEventListener('change', calculateTotal);
                        tglKembaliInput.addEventListener('change', calculateTotal);
                        calculateTotal();
                    }

                    document.addEventListener('DOMContentLoaded', initCartCalculation);
                    document.addEventListener('htmx:afterSettle', initCartCalculation);
                </script>
            @endif
        </div>

    </div>
</div>
@endsection
