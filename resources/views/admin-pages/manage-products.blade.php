@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('header_title', 'Manajemen Produk')
@section('header_subtitle', 'Kelola inventaris peralatan rental Anda.')

@section('header_actions')
<a href="{{ route('admin.products.create') }}" class="px-4 md:px-6 py-2 md:py-2.5 bg-rose-500 text-white rounded-full font-bold shadow-lg shadow-rose-500/30 hover:bg-rose-600 transition-all flex items-center text-sm">
    <i class="ti ti-plus mr-1 md:mr-2"></i> Tambah Alat Baru
</a>
@endsection

@section('content')
<!-- SEARCH BAR -->
<div class="bg-white p-4 rounded-3xl border border-zinc-200 shadow-sm flex items-center gap-4 mb-6">
    <div class="flex-1 relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="ti ti-search text-zinc-400 text-lg"></i>
        </div>
        <input type="text" id="searchInput" onkeyup="filterProducts()" class="w-full pl-12 pr-4 py-3 bg-zinc-50 border border-zinc-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all text-sm font-medium" placeholder="Cari berdasarkan nama peralatan...">
    </div>
</div>

<!-- PRODUCT GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6" id="productGrid">
    @forelse ($products as $product)
        <div class="product-card group bg-white rounded-3xl border border-zinc-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full" data-name="{{ strtolower($product->nama_produk) }}">
            
            <a href="{{ route('admin.products.show', $product->id) }}" class="flex-grow block relative overflow-hidden">
                <div class="w-full aspect-square bg-zinc-100 flex items-center justify-center">
                    @if ($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <i class="ti ti-camera text-4xl text-zinc-300"></i>
                    @endif
                </div>
                <div class="absolute top-3 right-3">
                    @if($product->stok > 0)
                        <span class="px-3 py-1 bg-white/90 backdrop-blur text-green-700 text-xs font-bold rounded-full border border-green-200 shadow-sm">
                            Sisa: {{ $product->stok }}
                        </span>
                    @else
                        <span class="px-3 py-1 bg-white/90 backdrop-blur text-rose-700 text-xs font-bold rounded-full border border-rose-200 shadow-sm">
                            Habis
                        </span>
                    @endif
                </div>
                
                <div class="p-5">
                    <h3 class="font-bold text-zinc-900 text-base leading-tight mb-1 line-clamp-2">{{ $product->nama_produk }}</h3>
                    <p class="text-rose-500 font-bold text-sm">Rp {{ number_format($product->harga_sewa, 0, ',', '.') }} <span class="text-zinc-400 font-normal">/ hari</span></p>
                </div>
            </a>

            <!-- ACTIONS -->
            <div class="p-4 pt-0 mt-auto flex gap-2">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="flex-1 py-2 bg-zinc-100 hover:bg-zinc-200 text-zinc-700 rounded-xl text-xs font-bold flex items-center justify-center transition-colors">
                    <i class="ti ti-edit mr-1"></i> Edit
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="flex-1 m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini? Semua data terkait mungkin akan terpengaruh.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl text-xs font-bold flex items-center justify-center transition-colors">
                        <i class="ti ti-trash mr-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-3xl border border-zinc-200 border-dashed p-16 flex flex-col items-center justify-center text-center shadow-sm">
            <div class="w-20 h-20 bg-zinc-50 rounded-full flex items-center justify-center mb-6">
                <i class="ti ti-box text-3xl text-zinc-400"></i>
            </div>
            <h3 class="text-xl font-bold text-zinc-900 mb-2">Inventaris Kosong</h3>
            <p class="text-zinc-500 mb-6">Belum ada produk yang ditambahkan ke sistem.</p>
            <a href="{{ route('admin.products.create') }}" class="px-6 py-2.5 bg-zinc-900 text-white rounded-full font-bold shadow-md hover:bg-zinc-800 transition-colors">
                <i class="ti ti-plus mr-1"></i> Tambah Produk Pertama
            </a>
        </div>
    @endforelse
</div>

<!-- Inline Script for Filter -->
<script>
    function filterProducts() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('#productGrid .product-card').forEach(card => {
            if (card.dataset.name.includes(q)) {
                card.classList.remove('hidden');
                card.classList.add('flex');
            } else {
                card.classList.add('hidden');
                card.classList.remove('flex');
            }
        });
    }
</script>
@endsection
