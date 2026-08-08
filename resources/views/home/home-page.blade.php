@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative h-[600px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-zinc-900">
        <!-- Add a subtle gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-zinc-900/90 via-zinc-900/50 to-transparent z-10"></div>
        <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=2000&auto=format&fit=crop" alt="Hero background" class="w-full h-full object-cover opacity-60">
    </div>
    
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-2xl">
            <span class="inline-block py-1 px-3 rounded-full bg-rose-500/10 text-rose-400 font-semibold text-sm mb-6 border border-rose-500/20 backdrop-blur-sm">
                #1 Penyedia Alat Dokumentasi
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6 tracking-tight">
                Abadikan Momen <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-orange-300">Tanpa Batas</span>
            </h1>
            <p class="text-lg text-zinc-300 mb-8 max-w-xl leading-relaxed">
                Sewa perlengkapan kamera, drone, dan alat dokumentasi profesional dengan mudah, cepat, dan terpercaya hanya di DocuRent.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#catalog" class="px-8 py-3.5 rounded-full bg-white text-zinc-900 font-semibold hover:bg-zinc-100 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Mulai Sewa
                </a>
                <a href="#recommendation" class="px-8 py-3.5 rounded-full bg-zinc-800/50 text-white font-semibold hover:bg-zinc-800 border border-zinc-700/50 backdrop-blur-md transition-all">
                    Lihat Rekomendasi
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Navigation Pills -->
<div class="sticky top-20 z-40 bg-white/80 backdrop-blur-md border-b border-zinc-200 shadow-sm py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center gap-3 overflow-x-auto no-scrollbar">
            <a href="#recommendation" class="whitespace-nowrap px-6 py-2 rounded-full bg-zinc-100 text-zinc-600 hover:bg-zinc-900 hover:text-white font-medium text-sm transition-colors">Rekomendasi</a>
            <a href="#catalog" class="whitespace-nowrap px-6 py-2 rounded-full bg-zinc-100 text-zinc-600 hover:bg-zinc-900 hover:text-white font-medium text-sm transition-colors">Katalog</a>
            <a href="#gallery" class="whitespace-nowrap px-6 py-2 rounded-full bg-zinc-100 text-zinc-600 hover:bg-zinc-900 hover:text-white font-medium text-sm transition-colors">Galeri</a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-24">

    <!-- Recommendation Section -->
    <div id="recommendation" class="scroll-mt-32">
        <div class="flex items-end justify-between mb-8">
            <div>
                <h3 class="text-2xl font-bold text-zinc-900 tracking-tight">Rekomendasi Pilihan</h3>
                <p class="text-zinc-500 mt-1">Gear terbaik yang sering disewa oleh profesional.</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($recommendations as $product)
            <div class="group bg-white rounded-2xl border border-zinc-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <a href="{{ route('products.show', $product->id) }}" class="block relative aspect-[4/3] overflow-hidden bg-zinc-100">
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <div class="p-5">
                    <h6 class="font-bold text-zinc-900 truncate mb-1" title="{{ $product->nama_produk }}">{{ $product->nama_produk }}</h6>
                    <div class="flex items-center justify-between mt-4">
                        <p class="text-rose-500 font-bold">
                            Rp {{ number_format($product->harga_sewa, 0, ',', '.') }}<span class="text-xs font-normal text-zinc-500"> /hari</span>
                        </p>
                        <a href="{{ route('products.show', $product->id) }}" class="w-8 h-8 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-600 group-hover:bg-zinc-900 group-hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Catalog Section -->
    <div id="catalog" class="scroll-mt-32">
        @include('sections.catalog')
    </div>

    <!-- Gallery Section -->
    <div id="gallery" class="scroll-mt-32">
        @include('sections.gallery')
    </div>

</div>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection