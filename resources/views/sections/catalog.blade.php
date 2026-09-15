@php
    $currentKat = request('kategori');
    $currentSort = request('urutan');
    $currentSearch = request('search');
    $categories = [
        'kamera' => 'Kamera',
        'lensa' => 'Lensa',
        'lighting' => 'Lighting',
        'audio' => 'Audio & Mic',
        'drone' => 'Drone',
        'aksesoris' => 'Aksesoris'
    ];
@endphp

<div>
    <!-- Section Header & Filter Controls -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
        <div>
            <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Inventaris Gear</span>
            <h3 class="text-2xl sm:text-3xl font-bold text-zinc-900 tracking-tight mt-1">Katalog Produk</h3>
            <p class="text-zinc-500 text-sm mt-1">Pilih perlengkapan dokumentasi yang sesuai dengan kebutuhan produksi Anda.</p>
        </div>

        <!-- Sort Control -->
        <form action="{{ route('home') }}#catalog" method="GET" class="flex items-center gap-2" id="sortForm">
            @if($currentKat)
                <input type="hidden" name="kategori" value="{{ $currentKat }}">
            @endif
            @if($currentSearch)
                <input type="hidden" name="search" value="{{ $currentSearch }}">
            @endif

            <label for="urutan" class="text-xs font-medium text-zinc-500 whitespace-nowrap">Urutkan:</label>
            <select 
                name="urutan" 
                id="urutan" 
                onchange="document.getElementById('sortForm').submit()"
                class="bg-white border border-zinc-200 text-zinc-800 text-xs font-medium rounded-full py-2 px-3.5 focus:border-zinc-400 focus:ring-0 outline-none transition-colors cursor-pointer shadow-2xs"
            >
                <option value="">Default (Pilihan)</option>
                <option value="nama" {{ $currentSort == 'nama' ? 'selected' : '' }}>Nama (A - Z)</option>
                <option value="termurah" {{ $currentSort == 'termurah' ? 'selected' : '' }}>Harga Termurah</option>
                <option value="terbaru" {{ $currentSort == 'terbaru' ? 'selected' : '' }}>Terbaru Ditambahkan</option>
            </select>
        </form>
    </div>

    <!-- Category Filter Bar (Pills) -->
    <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 no-scrollbar">
        <a 
            href="{{ route('home', array_filter(['urutan' => $currentSort, 'search' => $currentSearch])) }}#catalog"
            class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium transition-all {{ empty($currentKat) ? 'bg-zinc-900 text-white shadow-2xs' : 'bg-white text-zinc-600 border border-zinc-200/90 hover:bg-zinc-50 hover:text-zinc-900' }}"
        >
            Semua Produk
        </a>
        @foreach($categories as $slug => $label)
            <a 
                href="{{ route('home', array_filter(['kategori' => $slug, 'urutan' => $currentSort, 'search' => $currentSearch])) }}#catalog"
                class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium transition-all {{ $currentKat == $slug ? 'bg-zinc-900 text-white shadow-2xs' : 'bg-white text-zinc-600 border border-zinc-200/90 hover:bg-zinc-50 hover:text-zinc-900' }}"
            >
                {{ $label }}
            </a>
        @endforeach

        @if($currentKat || $currentSearch)
            <a 
                href="{{ route('home') }}#catalog" 
                class="whitespace-nowrap px-3 py-2 rounded-full text-xs font-medium text-zinc-400 hover:text-zinc-900 transition-colors inline-flex items-center"
                title="Hapus semua filter"
            >
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                Reset
            </a>
        @endif
    </div>

    <!-- Search Active Notice (If filtered) -->
    @if($currentSearch)
        <div class="mb-6 flex items-center justify-between p-3.5 rounded-xl bg-zinc-50 border border-zinc-200/80 text-xs text-zinc-600">
            <span>Hasil pencarian untuk: <strong class="text-zinc-900">"{{ $currentSearch }}"</strong></span>
            <a href="{{ route('home', array_filter(['kategori' => $currentKat, 'urutan' => $currentSort])) }}#catalog" class="text-zinc-500 hover:text-zinc-900 font-medium">Hapus kata kunci &times;</a>
        </div>
    @endif

    <!-- Product Grid -->
    @if($catalogs->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 bg-white rounded-3xl border border-zinc-200/80 border-dashed text-center px-4">
            <div class="w-14 h-14 rounded-full bg-zinc-50 flex items-center justify-center text-zinc-400 mb-4 border border-zinc-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <h4 class="text-base font-semibold text-zinc-900 mb-1">Gear tidak ditemukan</h4>
            <p class="text-zinc-500 text-xs max-w-sm mb-6">Coba pilih kategori lain atau atur ulang kata kunci pencarian Anda.</p>
            <a href="{{ route('home') }}#catalog" class="px-5 py-2.5 rounded-full bg-zinc-900 text-white text-xs font-semibold hover:bg-zinc-800 transition-colors">
                Lihat Semua Gear
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($catalogs as $product)
            <div class="group bg-white rounded-2xl border border-zinc-200/80 overflow-hidden hover:border-zinc-300 hover:shadow-sm transition-all duration-200 flex flex-col">
                
                <!-- Product Image -->
                <a href="{{ route('products.show', $product->id) }}" class="block relative aspect-[4/3] overflow-hidden bg-zinc-100/70">
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300">
                    
                    @if($product->stok <= 0)
                        <div class="absolute inset-0 bg-white/70 backdrop-blur-2xs flex items-center justify-center">
                            <span class="px-3 py-1 bg-zinc-900 text-white text-[10px] font-semibold tracking-wider rounded-full uppercase">Habis Disewa</span>
                        </div>
                    @else
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-1 bg-white/95 text-zinc-800 text-[10px] font-medium tracking-tight rounded-full border border-zinc-200/60 shadow-2xs">
                                Ready {{ $product->stok }}
                            </span>
                        </div>
                    @endif
                </a>

                <!-- Product Details -->
                <div class="p-5 flex flex-col flex-grow justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider">{{ $product->kategori }}</span>
                        <a href="{{ route('products.show', $product->id) }}">
                            <h5 class="font-semibold text-zinc-900 text-sm truncate mt-0.5 hover:text-zinc-700 transition-colors" title="{{ $product->nama_produk }}">
                                {{ $product->nama_produk }}
                            </h5>
                        </a>
                    </div>
                    
                    <div class="mt-4 pt-3 border-t border-zinc-100">
                        <div class="flex items-baseline justify-between mb-3">
                            <span class="text-[11px] text-zinc-400">Tarif sewa:</span>
                            <p class="text-sm font-bold text-zinc-900">
                                Rp {{ number_format($product->harga_sewa, 0, ',', '.') }}<span class="text-[11px] font-normal text-zinc-400"> /hari</span>
                            </p>
                        </div>
                        
                        @if($product->stok > 0)
                            <a href="{{ route('products.show', $product->id) }}" class="flex items-center justify-center w-full py-2.5 rounded-xl bg-zinc-900 text-white font-medium text-xs hover:bg-zinc-800 transition-colors shadow-2xs">
                                Sewa Sekarang
                            </a>
                        @else
                            <button disabled class="flex items-center justify-center w-full py-2.5 rounded-xl bg-zinc-100 text-zinc-400 font-medium text-xs cursor-not-allowed">
                                Stok Kosong
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>