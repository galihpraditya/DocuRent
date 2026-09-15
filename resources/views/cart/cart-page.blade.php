@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
    
    <!-- Back Button & Breadcrumbs -->
    <div class="flex items-center justify-between mb-8">
        <nav class="flex items-center space-x-2 text-xs font-medium text-zinc-400">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-zinc-900">Keranjang Sewa</span>
        </nav>
        
        <a href="{{ route('home') }}#catalog" class="inline-flex items-center text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors">
            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Tambah Gear Lain
        </a>
    </div>

    <div class="flex items-baseline space-x-3 mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-zinc-900 tracking-tight">Keranjang Sewa</h1>
        @if(isset($cart) && $cart->cartItems->count() > 0)
            <span class="px-2.5 py-0.5 bg-zinc-100 text-zinc-600 rounded-full text-xs font-medium">{{ $cart->cartItems->count() }} item</span>
        @endif
    </div>

    @if(session('error'))
        <div class="p-4 mb-6 text-xs font-medium text-rose-800 rounded-2xl bg-rose-50 border border-rose-200/80 flex items-center">
            <svg class="w-4 h-4 mr-2 shrink-0 text-rose-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('success'))
        <div class="p-4 mb-6 text-xs font-medium text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-200/80 flex items-center">
            <svg class="w-4 h-4 mr-2 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-10 items-start">
        
        <!-- Cart Items (Left) -->
        <div class="lg:w-2/3 w-full">
            @if(isset($cart) && $cart->cartItems->count() > 0)
                <div class="bg-white rounded-3xl border border-zinc-200/80 overflow-hidden shadow-2xs">
                    
                    <!-- Table Header -->
                    <div class="hidden sm:grid grid-cols-12 gap-4 px-6 py-4 bg-zinc-50/70 border-b border-zinc-200/70 text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                        <div class="col-span-6">Peralatan</div>
                        <div class="col-span-3 text-center">Jumlah</div>
                        <div class="col-span-3 text-right">Tarif / Hari</div>
                    </div>

                    <!-- Items List -->
                    <div class="divide-y divide-zinc-100">
                        @foreach($cart->cartItems as $item)
                            <div class="p-6 grid grid-cols-1 sm:grid-cols-12 gap-5 sm:gap-4 items-center transition-colors hover:bg-zinc-50/40">
                                
                                <!-- Product Info -->
                                <div class="col-span-1 sm:col-span-6 flex gap-4">
                                    <div class="w-20 h-20 rounded-2xl bg-zinc-50 overflow-hidden shrink-0 border border-zinc-200/70">
                                        <img src="{{ asset('storage/' . $item->product->gambar) }}" alt="{{ $item->product->nama_produk }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <a href="{{ route('products.show', $item->product->id) }}" class="font-semibold text-zinc-900 text-sm hover:text-zinc-600 transition-colors">
                                            {{ $item->product->nama_produk }}
                                        </a>
                                        <p class="text-xs text-zinc-500 mt-0.5">Rp {{ number_format($item->product->harga_sewa, 0, ',', '.') }} / hari</p>
                                        
                                        <form action="{{ route('cart-items.destroy', $item->id) }}" method="POST" hx-boost="false" class="mt-2.5">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-zinc-400 hover:text-rose-600 transition-colors inline-flex items-center font-medium cursor-pointer">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Quantity with Stepper -->
                                <div class="col-span-1 sm:col-span-3 flex sm:justify-center">
                                    <form action="{{ route('cart-items.update', $item->id) }}" method="POST" hx-boost="false" class="flex items-center" id="form-qty-{{ $item->id }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex items-center border border-zinc-200 rounded-xl bg-white p-0.5 shadow-2xs">
                                            <button 
                                                type="button" 
                                                onclick="changeItemQty({{ $item->id }}, -1, 1, {{ $item->product->stok }})"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg text-zinc-400 hover:text-zinc-900 hover:bg-zinc-100 transition-colors cursor-pointer"
                                                aria-label="Kurangi"
                                            >
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M20 12H4"></path></svg>
                                            </button>
                                            <input 
                                                type="number" 
                                                id="input-qty-{{ $item->id }}"
                                                name="jumlah" 
                                                value="{{ $item->jumlah }}" 
                                                min="1" 
                                                max="{{ $item->product->stok }}" 
                                                onchange="this.form.submit()"
                                                class="w-10 py-1 text-center text-xs font-bold text-zinc-900 bg-transparent border-none focus:ring-0 outline-none"
                                            >
                                            <button 
                                                type="button" 
                                                onclick="changeItemQty({{ $item->id }}, 1, 1, {{ $item->product->stok }})"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg text-zinc-400 hover:text-zinc-900 hover:bg-zinc-100 transition-colors cursor-pointer"
                                                aria-label="Tambah"
                                            >
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"></path></svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Subtotal -->
                                <div class="col-span-1 sm:col-span-3 sm:text-right">
                                    <span class="text-xs text-zinc-400 sm:hidden">Subtotal: </span>
                                    <span class="text-zinc-900 font-bold text-sm">
                                        Rp {{ number_format($item->product->harga_sewa * $item->jumlah, 0, ',', '.') }}
                                    </span>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl border border-zinc-200/80 border-dashed p-16 flex flex-col items-center justify-center text-center">
                    <div class="w-16 h-16 bg-zinc-50 rounded-full flex items-center justify-center mb-4 text-zinc-400 border border-zinc-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <h3 class="text-base font-bold text-zinc-900 mb-1">Keranjang Sewa Masih Kosong</h3>
                    <p class="text-zinc-500 text-xs mb-6 max-w-sm">Anda belum memasukkan gear apapun ke dalam keranjang.</p>
                    <a href="{{ route('home') }}#catalog" class="px-6 py-2.5 bg-zinc-900 text-white rounded-full font-medium text-xs hover:bg-zinc-800 transition-colors shadow-2xs">
                        Jelajahi Katalog Gear
                    </a>
                </div>
            @endif
        </div>

        <!-- Order Duration & Summary (Right) -->
        <div class="lg:w-1/3 w-full">
            @if(isset($cart) && $cart->cartItems->count() > 0)
                @php
                    $baseTotalPerDay = 0;
                    foreach($cart->cartItems as $item) {
                        $baseTotalPerDay += ($item->product->harga_sewa * $item->jumlah);
                    }
                @endphp

                <div class="bg-white rounded-3xl border border-zinc-200/80 shadow-2xs sticky top-28 p-7">
                    <h5 class="text-base font-bold text-zinc-900 mb-5 pb-3 border-b border-zinc-100">Jadwal & Biaya Sewa</h5>

                    <form action="{{ route('cart.checkout-page') }}" method="POST" hx-boost="false" class="space-y-4" id="checkoutForm">
                        @csrf
                        
                        <div>
                            <label for="tanggal_sewa" class="block text-xs font-semibold text-zinc-600 mb-1.5">Tanggal Mulai Sewa</label>
                            <input 
                                type="date" 
                                id="tanggal_sewa" 
                                name="tanggal_sewa" 
                                min="{{ date('Y-m-d') }}"
                                value="{{ $tanggalMulai ?? date('Y-m-d') }}" 
                                required 
                                class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs rounded-xl focus:border-zinc-400 focus:bg-white p-3 outline-none transition-colors"
                            >
                        </div>

                        <div>
                            <label for="tanggal_kembali" class="block text-xs font-semibold text-zinc-600 mb-1.5">Tanggal Pengembalian</label>
                            <input 
                                type="date" 
                                id="tanggal_kembali" 
                                name="tanggal_kembali" 
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                value="{{ $tanggalSelesai ?? date('Y-m-d', strtotime('+1 day')) }}" 
                                required 
                                class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs rounded-xl focus:border-zinc-400 focus:bg-white p-3 outline-none transition-colors"
                            >
                        </div>

                        <div class="pt-4 border-t border-zinc-100 space-y-2.5">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-zinc-500">Tarif per hari</span>
                                <span class="font-medium text-zinc-800">Rp {{ number_format($baseTotalPerDay, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-zinc-500">Durasi sewa</span>
                                <span class="font-semibold text-zinc-900 bg-zinc-100 px-2 py-0.5 rounded" id="durasiDisplay">1 Hari</span>
                            </div>
                            <div class="flex justify-between items-baseline pt-3 border-t border-zinc-100">
                                <span class="text-sm font-bold text-zinc-900">Total Biaya</span>
                                <span class="text-xl font-bold text-zinc-900" id="totalBiayaDisplay">Rp {{ number_format($baseTotalPerDay, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button 
                            type="submit" 
                            id="btnCheckout" 
                            class="w-full bg-zinc-900 text-white rounded-xl py-3.5 text-xs font-semibold hover:bg-zinc-800 transition-colors shadow-2xs flex justify-center items-center mt-6 cursor-pointer"
                        >
                            Lanjut ke Konfirmasi Pesanan
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
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
                                durasiDisplay.innerText = 'Tanggal tidak valid';
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

                    function changeItemQty(itemId, delta, min, max) {
                        const input = document.getElementById('input-qty-' + itemId);
                        const form = document.getElementById('form-qty-' + itemId);
                        if (!input || !form) return;
                        let currentVal = parseInt(input.value) || 1;
                        let newVal = currentVal + delta;
                        if (newVal >= min && newVal <= max) {
                            input.value = newVal;
                            form.submit();
                        }
                    }

                    document.addEventListener('DOMContentLoaded', initCartCalculation);
                    document.addEventListener('htmx:afterSettle', initCartCalculation);
                </script>
            @endif
        </div>

    </div>
</div>
@endsection
