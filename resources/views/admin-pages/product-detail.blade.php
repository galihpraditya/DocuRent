@extends('layouts.admin')

@section('title', 'Detail Produk')
@section('header_title', 'Detail Produk')
@section('header_subtitle', 'Informasi lengkap tentang spesifikasi dan inventaris peralatan.')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- BACK LINK -->
    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Kembali ke Daftar Produk</span>
    </a>

    <!-- PRODUCT DETAIL CARD -->
    <div class="bg-white rounded-3xl border border-zinc-200/80 overflow-hidden shadow-2xs flex flex-col md:flex-row">
        
        <!-- IMAGE SIDE -->
        <div class="w-full md:w-5/12 bg-zinc-100 relative min-h-[280px] md:min-h-full flex items-center justify-center border-b md:border-b-0 md:border-r border-zinc-200/80">
            @if ($product->gambar)
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
            @else
                <div class="text-zinc-300 text-center p-6">
                    <i class="ti ti-camera text-5xl"></i>
                    <p class="text-xs text-zinc-400 mt-2 font-medium">Foto alat belum diunggah</p>
                </div>
            @endif
        </div>

        <!-- INFO SIDE -->
        <div class="w-full md:w-7/12 p-6 sm:p-8 lg:p-9 flex flex-col justify-between">
            <div>
                <!-- Category & Stock Status -->
                <div class="flex items-center justify-between gap-3 mb-2.5">
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider">
                        {{ $product->kategori ?? 'Peralatan Produksi' }}
                    </span>

                    @if($product->stok > 0)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/80 gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Tersedia ({{ $product->stok }} unit)
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-zinc-900 text-white gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                            Stok Habis
                        </span>
                    @endif
                </div>

                <!-- Product Name -->
                <h2 class="text-xl sm:text-2xl font-bold text-zinc-900 tracking-tight leading-snug mb-4">
                    {{ $product->nama_produk }}
                </h2>

                <!-- Price Card -->
                <div class="bg-zinc-900 rounded-2xl p-4 sm:p-5 mb-6 text-white shadow-2xs flex items-baseline justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Tarif Sewa Harian</span>
                        <p class="text-2xl font-bold text-white tracking-tight mt-0.5 font-mono tabular-nums">
                            Rp {{ number_format($product->harga_sewa, 0, ',', '.') }}
                        </p>
                    </div>
                    <span class="text-xs text-zinc-400 font-normal">/ hari sewa</span>
                </div>

                <!-- Description Block -->
                <div class="mb-6">
                    <h4 class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Deskripsi & Kelengkapan</h4>
                    <div class="p-4 rounded-2xl bg-zinc-50 border border-zinc-100 text-xs sm:text-sm text-zinc-600 leading-relaxed whitespace-pre-line font-normal">
                        @if ($product->deskripsi)
                            {{ $product->deskripsi }}
                        @else
                            <span class="text-zinc-400 italic">Belum ada keterangan deskripsi untuk produk ini.</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions Bar -->
            <div class="flex items-center gap-3 pt-4 border-t border-zinc-100 mt-2">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="flex-1 py-2.5 px-4 bg-zinc-900 text-white rounded-xl text-xs font-semibold hover:bg-zinc-800 transition-all shadow-2xs flex items-center justify-center gap-2">
                    <i class="ti ti-edit text-sm"></i>
                    <span>Edit Produk</span>
                </a>
                <form id="delete-product-form" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="flex-1 m-0">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="button" 
                        onclick="confirmDeleteProduct('{{ addslashes($product->nama_produk) }}')"
                        class="w-full py-2.5 px-4 bg-white border border-zinc-200/90 text-zinc-500 hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 rounded-xl text-xs font-semibold transition-colors flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <i class="ti ti-trash text-sm"></i>
                        <span>Hapus Produk</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function confirmDeleteProduct(name) {
        openConfirmModal({
            title: 'Hapus Produk dari Inventaris?',
            message: `Apakah Anda yakin ingin menghapus <strong>${name}</strong>? Tindakan ini bersifat permanen dan data riwayat transaksi sewa terkait dapat terpengaruh.`,
            confirmText: 'Ya, Hapus Produk',
            isDanger: true,
            onConfirm: function() {
                const form = document.getElementById('delete-product-form');
                if (form) form.submit();
            }
        });
    }
</script>
@endsection
