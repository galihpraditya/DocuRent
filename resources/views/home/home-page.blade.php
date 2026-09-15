@extends('layouts.app')

@section('content')

<!-- Hero Section: Clean, Minimalist & Elegant with Studio Showcase -->
<section class="relative bg-gradient-to-b from-zinc-50 via-white to-zinc-50/40 border-b border-zinc-200/60 pt-12 pb-16 md:pt-20 md:pb-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
            
            <!-- Left Column: Copywriting & CTA (col 12 -> 7) -->
            <div class="lg:col-span-7">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-zinc-900 tracking-tight leading-[1.12] mb-6">
                    {{ __('Rent professional production gear,') }}<br>
                    <span class="text-zinc-500 font-normal">{{ __('seamless & hassle-free rental.') }}</span>
                </h1>

                <p class="text-base sm:text-lg text-zinc-600 mb-8 max-w-xl leading-relaxed font-normal">
                    {{ __('DocuRent provides cinema & mirrorless cameras, prime lenses, wireless audio, studio lighting, and drones with clean sensors and complete production-ready kits.') }}
                </p>

                <div class="flex items-center gap-3.5 mb-8 lg:mb-0">
                    <a href="#catalog" class="flex-1 sm:flex-initial text-center px-7 py-3.5 rounded-full bg-zinc-900 text-white font-medium text-sm hover:bg-zinc-800 transition-all shadow-sm hover:shadow">
                        {{ __('Explore Catalog') }}
                    </a>
                    <a href="#recommendation" class="flex-1 sm:flex-initial text-center px-7 py-3.5 rounded-full bg-white text-zinc-800 font-medium text-sm hover:bg-zinc-50 border border-zinc-200/80 transition-all">
                        {{ __('View Recommendations') }}
                    </a>
                </div>
            </div>

            <!-- Right Column: Studio Camera Showcase (col 12 -> 5) -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <!-- Subtle Glow Backdrop -->
                    <div class="absolute -inset-2 bg-gradient-to-tr from-zinc-200/40 via-zinc-100/30 to-white rounded-3xl blur-xl -z-10"></div>

                    <!-- Main Image Frame -->
                    <div class="relative rounded-3xl overflow-hidden border border-zinc-200/80 bg-zinc-100/50 shadow-sm group">
                        <img 
                            src="{{ asset('images/hero-camera.jpg') }}" 
                            alt="DocuRent Studio Camera & Lens Gear" 
                            class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-103"
                        >
                    </div>
                </div>
            </div>

        </div>

        <!-- Value Proposition Pillars: Full-width row below both Headline and Showcase -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 pt-10 sm:pt-12 mt-10 sm:mt-14 border-t border-zinc-200/70 text-zinc-600 pb-2">
            <div>
                <p class="text-xs font-semibold text-zinc-900 uppercase tracking-wider mb-1">{{ __('Clean Sensors') }}</p>
                <p class="text-xs text-zinc-500 leading-relaxed">{{ __('Immaculate optics & clean body') }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-zinc-900 uppercase tracking-wider mb-1">{{ __('Complete Kit') }}</p>
                <p class="text-xs text-zinc-500 leading-relaxed">{{ __('Batteries, charger, & bag included') }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-zinc-900 uppercase tracking-wider mb-1">{{ __('Flexible Duration') }}</p>
                <p class="text-xs text-zinc-500 leading-relaxed">{{ __('Daily or weekly rental') }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-zinc-900 uppercase tracking-wider mb-1">{{ __('Central Malang') }}</p>
                <p class="text-xs text-zinc-500 leading-relaxed">{{ __('Easy & swift gear pickup') }}</p>
            </div>
        </div>
    </div>
</section>



<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-24">

    <!-- Recommendation Section -->
    <div id="recommendation" class="scroll-mt-32">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-3">
            <div>
                <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">{{ __('Curated Favorites') }}</span>
                <h3 class="text-2xl sm:text-3xl font-bold text-zinc-900 tracking-tight mt-1">{{ __('Recommended Gear') }}</h3>
            </div>
            <a href="#catalog" class="text-xs font-semibold text-zinc-600 hover:text-zinc-900 inline-flex items-center">
                {{ __('View all catalog') }}
                <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($recommendations as $product)
            <div class="group bg-white rounded-2xl border border-zinc-200/80 overflow-hidden hover:border-zinc-300 hover:shadow-sm transition-all duration-200 flex flex-col">
                <a href="{{ route('products.show', $product->id) }}" class="block relative aspect-[4/3] overflow-hidden bg-zinc-100/80">
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300">
                    @if($product->stok <= 0)
                        <div class="absolute inset-0 bg-white/70 backdrop-blur-2xs flex items-center justify-center">
                            <span class="px-3 py-1 bg-zinc-900 text-white text-[10px] font-semibold tracking-wider rounded-full uppercase">{{ __('Rented Out') }}</span>
                        </div>
                    @else
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-1 bg-white/95 text-zinc-800 text-[10px] font-medium tracking-tight rounded-full border border-zinc-200/60 shadow-2xs">
                                {{ __('Available') }} ({{ $product->stok }})
                            </span>
                        </div>
                    @endif
                </a>
                <div class="p-5 flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-[11px] font-semibold text-zinc-400 uppercase tracking-wider capitalize">{{ __($product->kategori) }}</span>
                        <h4 class="font-semibold text-zinc-900 text-sm truncate mt-0.5" title="{{ $product->nama_produk }}">{{ $product->nama_produk }}</h4>
                    </div>
                    
                    <div class="flex items-center justify-between mt-5 pt-3 border-t border-zinc-100">
                        <div>
                            <span class="text-xs text-zinc-400 font-normal">{{ __('Rental Rate') }}</span>
                            <p class="text-sm font-bold text-zinc-900">
                                Rp {{ number_format($product->harga_sewa, 0, ',', '.') }}<span class="text-xs font-normal text-zinc-500"> {{ __('/day') }}</span>
                            </p>
                        </div>
                        <a href="{{ route('products.show', $product->id) }}" class="w-8 h-8 rounded-full bg-zinc-100 hover:bg-zinc-900 text-zinc-600 hover:text-white flex items-center justify-center transition-colors" title="Lihat detail">
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
@endsection