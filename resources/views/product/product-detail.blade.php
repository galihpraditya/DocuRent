@extends('layouts.app')

@section('content')
<div class="bg-zinc-50 py-12 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-zinc-500 mb-8 font-medium">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 transition-colors">Beranda</a>
            <span class="mx-3 text-zinc-300">/</span>
            <a href="{{ route('home') }}#catalog" class="hover:text-zinc-900 transition-colors">Katalog</a>
            <span class="mx-3 text-zinc-300">/</span>
            <span class="text-zinc-900 truncate">{{ $product->nama_produk }}</span>
        </nav>

        <div class="bg-white rounded-[2rem] border border-zinc-200 shadow-sm p-4 sm:p-6 lg:p-8 flex flex-col lg:flex-row gap-8 lg:gap-16 items-start">
            
            <!-- Left: Product Image -->
            <div class="w-full lg:w-1/2 rounded-[1.5rem] bg-zinc-100 overflow-hidden relative group aspect-[4/3] lg:aspect-square">
                <img 
                    src="{{ asset('storage/' . $product->gambar) }}" 
                    alt="{{ $product->nama_produk }}" 
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                >
                @if($product->stok <= 0)
                    <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px] flex items-center justify-center">
                        <span class="px-6 py-2 bg-zinc-900 text-white text-sm font-bold tracking-wider rounded-full uppercase shadow-lg">Habis Disewa</span>
                    </div>
                @endif
            </div>

            <!-- Right: Product Details -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center lg:py-8">
                
                <!-- Badges -->
                <div class="flex items-center gap-3 mb-4">
                    @if($product->stok > 0)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600 mr-1.5 animate-pulse"></span>
                            Tersedia ({{ $product->stok }} item)
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-600 mr-1.5"></span>
                            Stok Kosong
                        </span>
                    @endif
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-zinc-100 text-zinc-600 border border-zinc-200">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Terverifikasi
                    </span>
                </div>

                <!-- Title & Price -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-zinc-900 tracking-tight leading-tight mb-4">
                    {{ $product->nama_produk }}
                </h1>
                
                <div class="flex items-end gap-2 mb-8">
                    <span class="text-3xl sm:text-4xl font-bold text-rose-500">Rp {{ number_format($product->harga_sewa, 0, ',', '.') }}</span>
                    <span class="text-zinc-500 font-medium mb-1">/ hari</span>
                </div>

                <!-- Description -->
                <div class="prose prose-zinc mb-10 text-zinc-600 leading-relaxed text-sm sm:text-base">
                    <h3 class="text-lg font-bold text-zinc-900 mb-3 tracking-tight">Deskripsi Alat</h3>
                    <p class="whitespace-pre-line">{{ $product->deskripsi }}</p>
                </div>

                <!-- Action Bar -->
                @if($product->stok > 0)
                    <form action="{{ route('cart-items.store') }}" method="POST" class="bg-zinc-50 p-4 sm:p-6 rounded-[1.5rem] border border-zinc-200 flex flex-col sm:flex-row gap-4 items-end sm:items-center">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="w-full sm:w-auto flex-1">
                            <label for="jumlah" class="block text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Jumlah Sewa</label>
                            <div class="relative flex items-center">
                                <button type="button" onclick="document.getElementById('jumlah').stepDown()" class="w-12 h-12 flex items-center justify-center bg-white border border-zinc-200 rounded-l-xl text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 transition-colors focus:outline-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </button>
                                <input 
                                    type="number" 
                                    id="jumlah" 
                                    name="jumlah" 
                                    value="1" 
                                    min="1" 
                                    max="{{ $product->stok }}"
                                    class="w-16 h-12 text-center bg-white border-y border-zinc-200 text-zinc-900 font-bold focus:outline-none focus:ring-0 p-0"
                                >
                                <button type="button" onclick="document.getElementById('jumlah').stepUp()" class="w-12 h-12 flex items-center justify-center bg-white border border-zinc-200 rounded-r-xl text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 transition-colors focus:outline-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full sm:w-auto flex-1 flex items-center justify-center gap-2 px-8 py-4 bg-zinc-900 text-white rounded-xl font-bold hover:bg-zinc-800 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Tambahkan ke Keranjang
                        </button>
                    </form>
                @else
                    <div class="bg-rose-50 p-6 rounded-[1.5rem] border border-rose-100 flex flex-col items-center justify-center text-center">
                        <svg class="w-8 h-8 text-rose-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <h4 class="text-rose-800 font-bold mb-1">Maaf, Alat Sedang Tidak Tersedia</h4>
                        <p class="text-rose-600 text-sm">Semua unit untuk alat ini sedang disewa. Silakan cek kembali nanti atau cari alternatif lain di katalog kami.</p>
                        <a href="{{ route('home') }}#catalog" class="mt-4 px-6 py-2.5 bg-white border border-rose-200 text-rose-600 font-bold rounded-xl hover:bg-rose-50 transition-colors">Lihat Alat Lain</a>
                    </div>
                @endif
                
                <!-- Trust Indicators -->
                <div class="mt-8 pt-8 border-t border-zinc-100 grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-3 text-zinc-500">
                        <div class="w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <span class="text-sm font-medium">Asuransi Kerusakan</span>
                    </div>
                    <div class="flex items-center gap-3 text-zinc-500">
                        <div class="w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-sm font-medium">Proses Cepat</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    /* Hide number input arrows */
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@endsection