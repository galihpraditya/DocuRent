@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('header_title', 'Manajemen Produk')
@section('header_subtitle', 'Kelola inventaris peralatan rental Anda.')

@section('header_actions')
<a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center gap-1.5 h-9 px-2.5 sm:px-3.5 bg-zinc-900 text-white rounded-xl text-xs font-semibold hover:bg-zinc-800 transition-all shadow-2xs cursor-pointer shrink-0" title="Tambah Alat Baru">
    <i class="ti ti-plus text-sm"></i>
    <span class="hidden sm:inline">Tambah Alat Baru</span>
</a>
@endsection

@section('content')
<div class="space-y-6">
    
    <!-- SEARCH & CONTROLS BAR -->
    <div class="bg-white p-3 sm:p-4 rounded-2xl border border-zinc-200/80 shadow-2xs flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
        <div class="flex-1 relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                <i class="ti ti-search text-base"></i>
            </div>
            <input 
                type="text" 
                id="searchInput" 
                onkeyup="filterProducts()" 
                class="w-full pl-10 pr-4 py-2 bg-zinc-50 border border-zinc-200/80 rounded-xl focus:bg-white focus:outline-none focus:border-zinc-400 focus:ring-2 focus:ring-zinc-900/5 transition-all text-xs sm:text-sm font-medium" 
                placeholder="Cari berdasarkan nama peralatan, tipe kamera..."
            >
        </div>
        <div class="flex items-center justify-between sm:justify-end gap-3 px-1 text-xs text-zinc-500 font-medium whitespace-nowrap">
            <span>Total: <strong id="productCount" class="text-zinc-900 font-bold">{{ $products->count() }}</strong> unit alat</span>
        </div>
    </div>

    <!-- PRODUCT GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="productGrid">
        @forelse ($products as $product)
            <div class="product-card group bg-white rounded-2xl border border-zinc-200/80 overflow-hidden hover:border-zinc-300 hover:shadow-xs transition-all duration-200 flex flex-col justify-between" data-name="{{ strtolower($product->nama_produk) }}">
                
                <div>
                    <!-- Product Thumbnail -->
                    <a href="{{ route('admin.products.show', $product->id) }}" class="block relative aspect-[4/3] overflow-hidden bg-zinc-100">
                        @if ($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-zinc-300">
                                <i class="ti ti-camera text-4xl"></i>
                            </div>
                        @endif

                        <!-- Floating Stock Badge -->
                        <div class="absolute top-3 left-3">
                            @if($product->stok > 0)
                                <span class="px-2.5 py-1 bg-white/95 text-zinc-800 text-[10px] font-medium tracking-tight rounded-full border border-zinc-200/60 shadow-2xs">
                                    Tersedia {{ $product->stok }}
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-zinc-900 text-white text-[10px] font-medium tracking-tight rounded-full border border-zinc-700/60 shadow-2xs">
                                    Stok Habis
                                </span>
                            @endif
                        </div>
                    </a>

                    <!-- Product Details -->
                    <div class="p-4 sm:p-5">
                        <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">
                            {{ $product->kategori ?? 'Gear' }}
                        </span>
                        <a href="{{ route('admin.products.show', $product->id) }}">
                            <h3 class="font-semibold text-zinc-900 text-sm truncate mt-0.5 hover:text-zinc-700 transition-colors" title="{{ $product->nama_produk }}">
                                {{ $product->nama_produk }}
                            </h3>
                        </a>
                        <p class="text-xs font-bold text-zinc-900 mt-2 font-mono tabular-nums">
                            Rp {{ number_format($product->harga_sewa, 0, ',', '.') }}<span class="text-[11px] font-normal text-zinc-400 font-sans"> / hari</span>
                        </p>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="p-4 pt-0 border-t border-zinc-100 flex items-center gap-2 mt-2">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="flex-1 py-2 px-3 bg-zinc-100 hover:bg-zinc-900 hover:text-white text-zinc-700 rounded-xl text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors shadow-2xs">
                        <i class="ti ti-edit text-sm"></i>
                        <span>Edit</span>
                    </a>
                    <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="flex-1 m-0">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="button" 
                            onclick="confirmDeleteProduct({{ $product->id }}, '{{ addslashes($product->nama_produk) }}')"
                            class="w-full py-2 px-3 bg-white hover:bg-rose-50 text-zinc-400 hover:text-rose-600 border border-zinc-200/80 hover:border-rose-200 rounded-xl text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors cursor-pointer"
                        >
                            <i class="ti ti-trash text-sm"></i>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="col-span-full bg-white rounded-3xl border border-zinc-200/80 border-dashed p-12 sm:p-16 flex flex-col items-center justify-center text-center shadow-2xs">
                <div class="w-16 h-16 bg-zinc-100 rounded-2xl flex items-center justify-center mb-4 text-zinc-400 text-2xl shadow-2xs">
                    <i class="ti ti-box"></i>
                </div>
                <h3 class="text-base font-bold text-zinc-900 mb-1">Inventaris Kosong</h3>
                <p class="text-xs text-zinc-400 mb-5 max-w-sm">Belum ada unit peralatan atau kamera yang ditambahkan ke sistem.</p>
                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-zinc-900 text-white rounded-xl text-xs font-semibold hover:bg-zinc-800 transition-colors shadow-2xs">
                    <i class="ti ti-plus text-sm"></i>
                    <span>Tambah Produk Pertama</span>
                </a>
            </div>
        @endforelse
    </div>

    <!-- Empty Search State -->
    <div id="noSearchMatch" class="hidden bg-white rounded-3xl border border-zinc-200/80 border-dashed p-12 text-center shadow-2xs">
        <div class="w-12 h-12 bg-zinc-100 rounded-2xl flex items-center justify-center mx-auto mb-3 text-zinc-400 text-xl">
            <i class="ti ti-search"></i>
        </div>
        <h4 class="text-sm font-bold text-zinc-900 mb-1">Produk Tidak Ditemukan</h4>
        <p class="text-xs text-zinc-400 mb-4">Coba cari dengan kata kunci lain atau periksa ejaan nama produk.</p>
        <button onclick="document.getElementById('searchInput').value = ''; filterProducts();" class="px-4 py-2 bg-zinc-100 hover:bg-zinc-200 text-zinc-700 rounded-xl text-xs font-semibold transition-colors cursor-pointer">
            Reset Pencarian
        </button>
    </div>

</div>

<!-- Inline Script for Filter & Counter -->
<script>
    function filterProducts() {
        const q = document.getElementById('searchInput').value.toLowerCase().trim();
        const cards = document.querySelectorAll('#productGrid .product-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const name = card.dataset.name || '';
            if (name.includes(q)) {
                card.classList.remove('hidden');
                card.classList.add('flex');
                visibleCount++;
            } else {
                card.classList.add('hidden');
                card.classList.remove('flex');
            }
        });

        const countEl = document.getElementById('productCount');
        if (countEl) countEl.innerText = visibleCount;

        const noMatch = document.getElementById('noSearchMatch');
        if (noMatch) {
            if (visibleCount === 0 && cards.length > 0) {
                noMatch.classList.remove('hidden');
            } else {
                noMatch.classList.add('hidden');
            }
        }
    }

    function confirmDeleteProduct(id, name) {
        openConfirmModal({
            title: 'Hapus Produk dari Inventaris?',
            message: `Apakah Anda yakin ingin menghapus <strong>${name}</strong>? Tindakan ini bersifat permanen dan data riwayat transaksi sewa terkait dapat terpengaruh.`,
            confirmText: 'Ya, Hapus Produk',
            isDanger: true,
            onConfirm: function() {
                const form = document.getElementById('delete-form-' + id);
                if (form) form.submit();
            }
        });
    }
</script>
@endsection
