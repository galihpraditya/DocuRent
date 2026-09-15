@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('header_title', 'Perbarui Unit Alat')
@section('header_subtitle', 'Ubah informasi detail peralatan rental.')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- BACK LINK -->
    <a href="{{ route('admin.products.show', $product->id) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors">
        <i class="ti ti-arrow-left text-sm"></i>
        <span>Kembali ke Detail Produk</span>
    </a>

    <!-- FORM CARD -->
    <div class="bg-white rounded-3xl border border-zinc-200/80 overflow-hidden shadow-2xs">
        <div class="p-6 md:p-8 border-b border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-2xl bg-zinc-900 text-white flex items-center justify-center text-base shadow-2xs shrink-0">
                    <i class="ti ti-edit"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-zinc-900 tracking-tight">Edit Informasi Alat</h2>
                    <p class="text-xs text-zinc-500 mt-0.5">Perbarui data teknis, stok, dan tarif rental</p>
                </div>
            </div>

            <!-- Current Image Preview Mini -->
            <div class="flex items-center gap-3 bg-zinc-50 p-2 rounded-2xl border border-zinc-200/70 self-start sm:self-auto">
                <div class="w-12 h-12 bg-white rounded-xl border border-zinc-200 p-0.5 shadow-2xs shrink-0 flex items-center justify-center overflow-hidden">
                    @if ($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" class="w-full h-full object-cover rounded-lg">
                    @else
                        <i class="ti ti-camera text-xl text-zinc-300"></i>
                    @endif
                </div>
                <div class="pr-2 text-left">
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Foto Aktif</span>
                    <span class="text-xs font-semibold text-zinc-800 truncate max-w-[120px] block">{{ $product->nama_produk }}</span>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- NAMA PRODUK -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="nama_produk" class="block text-xs font-semibold text-zinc-700">Nama Produk / Tipe Alat <span class="text-rose-500">*</span></label>
                    <input 
                        type="text" 
                        id="nama_produk" 
                        name="nama_produk" 
                        value="{{ old('nama_produk', $product->nama_produk) }}" 
                        required
                        class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs sm:text-sm rounded-xl px-4 py-3 focus:bg-white focus:outline-none focus:border-zinc-400 focus:ring-2 focus:ring-zinc-900/5 transition-all font-medium @error('nama_produk') border-rose-400 bg-rose-50/20 @enderror" 
                        placeholder="Contoh: Kamera Sony A7III"
                    >
                    @error('nama_produk')<p class="text-xs font-medium text-rose-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- STOK -->
                <div class="space-y-1.5">
                    <label for="stok" class="block text-xs font-semibold text-zinc-700">Jumlah Unit Stok <span class="text-rose-500">*</span></label>
                    <input 
                        type="number" 
                        id="stok" 
                        name="stok" 
                        value="{{ old('stok', $product->stok) }}" 
                        min="0" 
                        required
                        class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs sm:text-sm rounded-xl px-4 py-3 focus:bg-white focus:outline-none focus:border-zinc-400 focus:ring-2 focus:ring-zinc-900/5 transition-all font-medium tabular-nums @error('stok') border-rose-400 bg-rose-50/20 @enderror" 
                        placeholder="0"
                    >
                    @error('stok')<p class="text-xs font-medium text-rose-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- HARGA SEWA -->
                <div class="space-y-1.5">
                    <label for="harga_sewa" class="block text-xs font-semibold text-zinc-700">Harga Sewa Harian <span class="text-rose-500">*</span></label>
                    <div class="relative flex items-center">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-xs font-bold text-zinc-400">
                            Rp
                        </span>
                        <input 
                            type="number" 
                            id="harga_sewa" 
                            name="harga_sewa" 
                            value="{{ old('harga_sewa', $product->harga_sewa) }}" 
                            min="0" 
                            required
                            class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs sm:text-sm rounded-xl pl-10 pr-16 py-3 focus:bg-white focus:outline-none focus:border-zinc-400 focus:ring-2 focus:ring-zinc-900/5 transition-all font-medium tabular-nums @error('harga_sewa') border-rose-400 bg-rose-50/20 @enderror" 
                            placeholder="150000"
                        >
                        <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-xs text-zinc-400">
                            / hari
                        </span>
                    </div>
                    @error('harga_sewa')<p class="text-xs font-medium text-rose-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- DESKRIPSI -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="deskripsi" class="block text-xs font-semibold text-zinc-700">Deskripsi & Kelengkapan Paket</label>
                    <div class="relative">
                        <textarea 
                            id="deskripsi" 
                            name="deskripsi" 
                            rows="5" 
                            maxlength="1500" 
                            class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs sm:text-sm rounded-xl p-4 focus:bg-white focus:outline-none focus:border-zinc-400 focus:ring-2 focus:ring-zinc-900/5 transition-all font-medium resize-none leading-relaxed @error('deskripsi') border-rose-400 bg-rose-50/20 @enderror" 
                            placeholder="Jelaskan spesifikasi alat, kelengkapan (baterai, charger, memory card), dan kondisi fisik unit..."
                            oninput="document.getElementById('charCount').textContent = this.value.length + '/1500'"
                        >{{ old('deskripsi', $product->deskripsi) }}</textarea>
                        <div class="absolute bottom-3 right-4 text-[11px] font-mono font-medium text-zinc-400 bg-white/90 px-2 py-0.5 rounded-md border border-zinc-200/60 shadow-2xs" id="charCount">0/1500</div>
                    </div>
                    @error('deskripsi')<p class="text-xs font-medium text-rose-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- GAMBAR -->
                <div class="space-y-1.5 md:col-span-2">
                    <label class="block text-xs font-semibold text-zinc-700">Ganti Foto (Opsional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-7 pb-8 border-2 border-zinc-200/80 border-dashed rounded-2xl bg-zinc-50/60 hover:bg-zinc-50 transition-colors relative group">
                        <div class="space-y-2 text-center">
                            <div class="w-12 h-12 rounded-2xl bg-white border border-zinc-200 flex items-center justify-center mx-auto text-zinc-500 shadow-2xs group-hover:scale-105 transition-transform">
                                <i class="ti ti-photo-up text-xl"></i>
                            </div>
                            <div class="flex text-xs text-zinc-600 justify-center">
                                <label for="gambar" class="relative cursor-pointer font-bold text-zinc-900 hover:underline focus-within:outline-none">
                                    <span>Pilih foto baru</span>
                                    <input id="gambar" name="gambar" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                </label>
                                <span class="pl-1 text-zinc-400">jika ingin mengubah foto</span>
                            </div>
                            <p class="text-[11px] text-zinc-400">PNG, JPG, JPEG hingga 2MB (Biarkan kosong jika tidak ingin mengubah)</p>
                        </div>

                        <!-- Image Preview Area (Hidden by default) -->
                        <div id="imagePreviewContainer" class="absolute inset-0 bg-white rounded-2xl hidden flex-col items-center justify-center p-3 border border-zinc-200 z-10">
                            <img id="imagePreview" src="#" alt="Preview" class="max-h-full max-w-full object-contain rounded-xl">
                            <button type="button" onclick="clearImage()" class="absolute top-3 right-3 w-8 h-8 bg-zinc-900 text-white rounded-full flex items-center justify-center shadow-md hover:bg-rose-600 transition-colors cursor-pointer" title="Batalkan foto baru">
                                <i class="ti ti-x text-sm"></i>
                            </button>
                        </div>
                    </div>
                    @error('gambar')<p class="text-xs font-medium text-rose-600 mt-1">{{ $message }}</p>@enderror
                </div>

            </div>

            <!-- FORM ACTIONS -->
            <div class="pt-6 border-t border-zinc-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.products.show', $product->id) }}" class="px-5 py-2.5 bg-white border border-zinc-200/90 text-zinc-700 rounded-xl font-semibold hover:bg-zinc-50 transition-colors text-xs shadow-2xs">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-zinc-900 text-white rounded-xl font-semibold shadow-2xs hover:bg-zinc-800 active:scale-[0.99] transition-all text-xs flex items-center gap-2 cursor-pointer">
                    <i class="ti ti-check text-sm"></i>
                    <span>Perbarui Alat</span>
                </button>
            </div>

        </form>
    </div>

</div>

<script>
    // Image Preview Function
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreviewContainer').classList.remove('hidden');
                document.getElementById('imagePreviewContainer').classList.add('flex');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearImage() {
        document.getElementById('gambar').value = '';
        document.getElementById('imagePreviewContainer').classList.add('hidden');
        document.getElementById('imagePreviewContainer').classList.remove('flex');
    }

    // Initialize char count on load
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('deskripsi');
        if(textarea) {
            document.getElementById('charCount').textContent = textarea.value.length + '/1500';
        }
    });
</script>
@endsection
