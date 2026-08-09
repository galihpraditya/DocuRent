@extends('layouts.admin')

@section('title', 'Detail Produk')
@section('header_title', 'Detail Produk')
@section('header_subtitle', 'Informasi lengkap tentang peralatan rental.')

@section('content')
        <div class="max-w-5xl mx-auto space-y-6">">
            
            <!-- BACK BUTTON -->
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-sm font-bold text-zinc-500 hover:text-zinc-900 transition-colors mb-4">
                <i class="ti ti-arrow-left mr-2"></i> Kembali ke Daftar Produk
            </a>

            <!-- PRODUCT DETAIL CARD -->
            <div class="bg-white rounded-3xl border border-zinc-200 overflow-hidden shadow-sm flex flex-col md:flex-row">
                
                <!-- IMAGE SIDE -->
                <div class="w-full md:w-2/5 bg-zinc-100 relative group min-h-[300px] flex items-center justify-center">
                    @if ($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <i class="ti ti-camera text-6xl text-zinc-300"></i>
                    @endif
                </div>

                <!-- INFO SIDE -->
                <div class="w-full md:w-3/5 p-8 lg:p-10 flex flex-col">
                    
                    <h2 class="text-3xl font-bold text-zinc-900 leading-tight mb-2">{{ $product->nama_produk }}</h2>
                    
                    <div class="mb-6 flex flex-wrap gap-2">
                        @if($product->stok > 0)
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                <i class="ti ti-box mr-1.5"></i> Stok Tersedia: {{ $product->stok }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-rose-100 text-rose-700 border border-rose-200">
                                <i class="ti ti-alert-circle mr-1.5"></i> Stok Habis
                            </span>
                        @endif
                    </div>

                    <div class="bg-zinc-900 rounded-2xl p-6 mb-8 text-white relative overflow-hidden shadow-lg">
                        <div class="absolute -right-8 -top-8 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                        <p class="text-zinc-400 text-xs font-bold uppercase tracking-widest mb-1 relative z-10">Harga Sewa</p>
                        <div class="flex items-end gap-2 relative z-10">
                            <h3 class="text-3xl font-bold">Rp {{ number_format($product->harga_sewa, 0, ',', '.') }}</h3>
                            <span class="text-zinc-400 font-medium mb-1">/ hari</span>
                        </div>
                    </div>

                    <div class="mb-8 flex-grow">
                        <h4 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-3">Deskripsi Produk</h4>
                        @if ($product->deskripsi)
                            <p class="text-zinc-600 leading-relaxed text-sm">{{ $product->deskripsi }}</p>
                        @else
                            <p class="text-zinc-400 italic text-sm">Tidak ada deskripsi yang ditambahkan untuk produk ini.</p>
                        @endif
                    </div>

                    <div class="flex gap-4 mt-auto pt-6 border-t border-zinc-100">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="flex-1 px-6 py-3.5 bg-zinc-900 text-white rounded-xl font-bold text-sm text-center shadow-md hover:bg-zinc-800 transition-colors flex items-center justify-center">
                            <i class="ti ti-edit mr-2"></i> Edit Produk
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini secara permanen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-6 py-3.5 bg-white border-2 border-rose-100 text-rose-600 rounded-xl font-bold text-sm text-center hover:bg-rose-50 hover:border-rose-200 transition-colors flex items-center justify-center">
                                <i class="ti ti-trash mr-2"></i> Hapus Produk
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
@endsection
