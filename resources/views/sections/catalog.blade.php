<div>
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
        <div>
            <h3 class="text-2xl font-bold text-zinc-900 tracking-tight">Katalog Produk</h3>
            <p class="text-zinc-500 mt-1">Eksplorasi gear terlengkap untuk setiap kebutuhan produksi Anda.</p>
        </div>
    </div>
    
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Sidebar Filter (Kiri) -->
        <div class="lg:w-1/4 shrink-0">
            <form action="{{ route('products.filter') }}#catalog" method="GET" class="sticky top-40 bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm">
                
                <h6 class="font-bold text-lg text-zinc-900 border-b border-zinc-100 pb-4 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter Produk
                </h6>

                <a href="{{ route('home') }}#catalog" class="flex items-center text-zinc-600 hover:text-zinc-900 mb-6 font-medium transition-colors">
                    <svg class="w-5 h-5 mr-3 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Semua Produk
                </a>

                <!-- Kategori -->
                <div class="mb-6">
                    <p class="font-semibold text-zinc-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        Kategori
                    </p>
                    
                    <div class="space-y-2.5 ml-1">
                        @php
                            $kategori = request('kategori');
                        @endphp
                        @foreach(['kamera', 'lensa', 'lighting', 'audio', 'drone', 'aksesoris'] as $kat)
                        <label class="flex items-center group cursor-pointer">
                            <input type="radio" name="kategori" value="{{ $kat }}" class="w-4 h-4 text-zinc-900 border-zinc-300 focus:ring-zinc-900" {{ $kategori == $kat ? 'checked' : '' }}>
                            <span class="ml-3 text-sm text-zinc-600 group-hover:text-zinc-900 capitalize">{{ $kat }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Urutkan -->
                <div class="mb-8">
                    <p class="font-semibold text-zinc-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                        Urutkan
                    </p>
                    <select name="urutan" class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-2.5 outline-none">
                        <option value="">Default</option>
                        <option value="nama" {{ request('urutan') == 'nama' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="termurah" {{ request('urutan') == 'termurah' ? 'selected' : '' }}>Termurah</option>
                        <option value="terbaru" {{ request('urutan') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-zinc-900 text-white rounded-xl py-3 text-sm font-semibold hover:bg-zinc-800 transition-colors shadow-sm">
                    Terapkan Filter
                </button>
            </form>
        </div>

        <!-- Daftar Produk (Kanan) -->
        <div class="lg:w-3/4">
            @if($catalogs->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 bg-zinc-50 rounded-2xl border border-zinc-200 border-dashed">
                    <svg class="w-16 h-16 text-zinc-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h4 class="text-lg font-medium text-zinc-900 mb-1">Tidak ada produk ditemukan</h4>
                    <p class="text-zinc-500 text-sm">Coba ubah filter atau kata kunci pencarian Anda.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($catalogs as $product)
                    <div class="group bg-white rounded-2xl border border-zinc-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col">
                        <a href="{{ route('products.show', $product->id) }}" class="block relative aspect-square overflow-hidden bg-zinc-100">
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @if($product->stok <= 0)
                                <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px] flex items-center justify-center">
                                    <span class="px-4 py-1.5 bg-zinc-900 text-white text-xs font-bold tracking-wider rounded-full uppercase">Habis Disewa</span>
                                </div>
                            @endif
                        </a>
                        <div class="p-5 flex flex-col flex-grow">
                            <h6 class="font-bold text-zinc-900 truncate mb-1" title="{{ $product->nama_produk }}">{{ $product->nama_produk }}</h6>
                            <p class="text-rose-500 font-bold mb-4">
                                Rp {{ number_format($product->harga_sewa, 0, ',', '.') }}<span class="text-xs font-normal text-zinc-500"> /hari</span>
                            </p>
                            
                            <div class="mt-auto">
                                @if($product->stok > 0)
                                    <a href="{{ route('products.show', $product->id) }}" class="flex items-center justify-center w-full py-2.5 rounded-xl border-2 border-zinc-900 text-zinc-900 font-semibold text-sm hover:bg-zinc-900 hover:text-white transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                        Sewa Sekarang
                                    </a>
                                @else
                                    <button disabled class="flex items-center justify-center w-full py-2.5 rounded-xl bg-zinc-100 text-zinc-400 font-semibold text-sm cursor-not-allowed">
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

    </div>
</div>