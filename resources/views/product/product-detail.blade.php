@extends('layouts.app')

@section('content')
<div class="bg-[#FCFCFC] py-10 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb & Back -->
        <div class="flex items-center justify-between mb-8">
            <nav class="flex items-center space-x-2 text-xs font-medium text-zinc-400">
                <a href="{{ route('home') }}" class="hover:text-zinc-900 transition-colors">Beranda</a>
                <span>/</span>
                <a href="{{ route('home') }}#catalog" class="hover:text-zinc-900 transition-colors">Katalog</a>
                <span>/</span>
                <span class="text-zinc-900 truncate max-w-xs">{{ $product->nama_produk }}</span>
            </nav>

            <a href="javascript:history.back()" class="inline-flex items-center text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <!-- Product Card Layout -->
        <div class="bg-white rounded-3xl border border-zinc-200/80 p-6 sm:p-10 lg:p-12 shadow-2xs">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                
                <!-- Left: Studio Image Showcase (col 12 -> 5) -->
                <div class="lg:col-span-5">
                    <div class="rounded-2xl bg-zinc-50 border border-zinc-200/70 overflow-hidden relative aspect-square flex items-center justify-center">
                        <img 
                            src="{{ asset('storage/' . $product->gambar) }}" 
                            alt="{{ $product->nama_produk }}" 
                            class="w-full h-full object-cover"
                        >
                        @if($product->stok <= 0)
                            <div class="absolute inset-0 bg-white/80 backdrop-blur-2xs flex items-center justify-center">
                                <span class="px-4 py-1.5 bg-zinc-900 text-white text-xs font-semibold tracking-wider rounded-full uppercase">Habis Disewa</span>
                            </div>
                        @endif
                    </div>

                    <!-- Trust Pillars -->
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <div class="p-3 rounded-xl bg-zinc-50 border border-zinc-100 flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-white border border-zinc-200 flex items-center justify-center text-zinc-700 shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-zinc-600">Sensor & Optik Bersih</span>
                        </div>
                        <div class="p-3 rounded-xl bg-zinc-50 border border-zinc-100 flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-white border border-zinc-200 flex items-center justify-center text-zinc-700 shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-zinc-600">Verifikasi Cepat</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Information & Actions (col 12 -> 7) -->
                <div class="lg:col-span-7 flex flex-col justify-between h-full">
                    <div>
                        <!-- Category & Availability Status -->
                        <div class="flex items-center gap-2.5 mb-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-zinc-400 capitalize">{{ $product->kategori }}</span>
                            <span class="text-zinc-300">•</span>
                            @if($product->stok > 0)
                                <span class="inline-flex items-center text-xs font-medium text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                    Tersedia ({{ $product->stok }} unit)
                                </span>
                            @else
                                <span class="inline-flex items-center text-xs font-medium text-zinc-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-zinc-300 mr-1.5"></span>
                                    Stok Tidak Tersedia
                                </span>
                            @endif
                        </div>

                        <!-- Product Title -->
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-zinc-900 tracking-tight leading-snug mb-4">
                            {{ $product->nama_produk }}
                        </h1>
                        
                        <!-- Price Display -->
                        <div class="flex items-baseline gap-2 mb-8 pb-6 border-b border-zinc-100">
                            <span class="text-3xl font-bold text-zinc-900 tracking-tight">Rp {{ number_format($product->harga_sewa, 0, ',', '.') }}</span>
                            <span class="text-xs font-normal text-zinc-400">/ hari sewa</span>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h3 class="text-xs font-bold text-zinc-900 uppercase tracking-wider mb-2.5">Deskripsi Peralatan</h3>
                            <p class="text-zinc-600 leading-relaxed text-sm whitespace-pre-line font-normal">
                                {{ $product->deskripsi }}
                            </p>
                        </div>

                        <!-- Included in Package (Checklist) -->
                        <div class="mb-8 p-4 rounded-2xl bg-zinc-50/80 border border-zinc-100">
                            <h4 class="text-xs font-bold text-zinc-900 uppercase tracking-wider mb-3">Kelengkapan Paket Sewa</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-zinc-600 font-medium">
                                <div class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    <span>1x Unit {{ $product->nama_produk }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    <span>2x Baterai Original Siap Pakai</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    <span>1x Dual Charger & Kabel Power</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    <span>1x Tas / Hardcase Pelindung</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Bar / Add to Cart Form -->
                    <div class="pt-4">
                        @if($product->stok > 0)
                            <form action="{{ route('cart-items.store') }}" method="POST" hx-boost="false" class="space-y-4">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="flex items-center gap-3">
                                    <!-- Stepper Quantity (Compact & aligned) -->
                                    <div class="flex items-center justify-between border border-zinc-200/90 rounded-2xl bg-white p-1 shadow-2xs shrink-0 w-28 sm:w-32 h-12">
                                        <button 
                                            type="button" 
                                            onclick="stepQuantity(-1)" 
                                            class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-xl text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100 active:scale-95 transition-all"
                                            aria-label="Kurangi"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        </button>
                                        <input 
                                            type="number" 
                                            id="jumlah" 
                                            name="jumlah" 
                                            value="1" 
                                            min="1" 
                                            max="{{ $product->stok }}"
                                            class="w-8 sm:w-10 text-center bg-transparent text-sm font-bold text-zinc-900 border-none outline-none focus:ring-0 p-0"
                                            readonly
                                        >
                                        <button 
                                            type="button" 
                                            onclick="stepQuantity(1)" 
                                            class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-xl text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100 active:scale-95 transition-all"
                                            aria-label="Tambah"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        </button>
                                    </div>

                                    <!-- Submit Button -->
                                    <button 
                                        type="submit" 
                                        class="flex-1 h-12 flex items-center justify-center gap-2 px-4 sm:px-6 bg-zinc-900 text-white rounded-2xl font-medium text-xs sm:text-sm hover:bg-zinc-800 active:scale-[0.99] transition-all shadow-2xs cursor-pointer"
                                    >
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        <span>Tambahkan ke Keranjang</span>
                                    </button>
                                </div>
                            </form>

                            <script>
                                function stepQuantity(delta) {
                                    const input = document.getElementById('jumlah');
                                    if (!input) return;
                                    let val = parseInt(input.value) || 1;
                                    const max = {{ $product->stok }};
                                    val = Math.max(1, Math.min(max, val + delta));
                                    input.value = val;
                                }
                            </script>
                        @else
                            <div class="p-4 rounded-xl bg-zinc-100 text-zinc-500 text-xs flex items-center justify-between">
                                <span>Saat ini semua unit sedang disewa.</span>
                                <a href="{{ route('home') }}#catalog" class="font-semibold text-zinc-900 hover:underline">Lihat Alternatif Lain &rarr;</a>
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection