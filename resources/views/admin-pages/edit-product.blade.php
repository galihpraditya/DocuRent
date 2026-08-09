@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('header_title', 'Perbarui Unit Alat')
@section('header_subtitle', 'Ubah informasi detail peralatan rental.')

@section('content')
        <div class="max-w-4xl mx-auto space-y-6">">
            
            <!-- BACK BUTTON -->
            <a href="{{ route('admin.products.show', $product->id) }}" class="inline-flex items-center text-sm font-bold text-zinc-500 hover:text-zinc-900 transition-colors mb-2">
                <i class="ti ti-arrow-left mr-2"></i> Kembali ke Detail Produk
            </a>

            <!-- FORM CARD -->
            <div class="bg-white rounded-3xl border border-zinc-200 overflow-hidden shadow-sm">
                <div class="p-6 md:p-8 border-b border-zinc-100 bg-zinc-50/50 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="absolute -right-8 -top-8 w-40 h-40 bg-zinc-100 rounded-full blur-3xl z-0"></div>
                    <div class="relative z-10 flex items-center gap-4">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center border border-zinc-200 shadow-sm text-zinc-600 text-xl">
                            <i class="ti ti-edit"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-zinc-900">Edit Alat</h2>
                            <p class="text-sm text-zinc-500">Perbarui informasi untuk alat ini.</p>
                        </div>
                    </div>

                    <!-- Current Image Preview Mini -->
                    <div class="relative z-10 w-20 h-20 bg-white rounded-xl border border-zinc-200 p-1 shadow-sm shrink-0 flex items-center justify-center overflow-hidden">
                        @if ($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" class="w-full h-full object-cover rounded-lg">
                        @else
                            <i class="ti ti-camera text-2xl text-zinc-300"></i>
                        @endif
                    </div>
                </div>

                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- NAMA PRODUK -->
                        <div class="space-y-2 md:col-span-2">
                            <label for="nama_produk" class="block text-sm font-bold text-zinc-700">Nama Produk / Alat</label>
                            <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}" 
                                class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all text-sm font-medium @error('nama_produk') border-rose-500 ring-rose-500/20 @enderror" 
                                placeholder="Contoh: Kamera Sony A7III">
                            @error('nama_produk')<p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- STOK -->
                        <div class="space-y-2">
                            <label for="stok" class="block text-sm font-bold text-zinc-700">Jumlah Stok</label>
                            <input type="number" id="stok" name="stok" value="{{ old('stok', $product->stok) }}" min="0" 
                                class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all text-sm font-medium @error('stok') border-rose-500 ring-rose-500/20 @enderror" 
                                placeholder="0">
                            @error('stok')<p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- HARGA SEWA -->
                        <div class="space-y-2">
                            <label for="harga_sewa" class="block text-sm font-bold text-zinc-700">Harga Sewa Harian</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-zinc-500 text-sm font-bold">Rp</span>
                                </div>
                                <input type="number" id="harga_sewa" name="harga_sewa" value="{{ old('harga_sewa', $product->harga_sewa) }}" min="0" 
                                    class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 rounded-xl pl-12 pr-16 py-3 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all text-sm font-medium @error('harga_sewa') border-rose-500 ring-rose-500/20 @enderror" 
                                    placeholder="150000">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-zinc-400 text-sm">/ hari</span>
                                </div>
                            </div>
                            @error('harga_sewa')<p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="space-y-2 md:col-span-2">
                            <label for="deskripsi" class="block text-sm font-bold text-zinc-700">Deskripsi Lengkap</label>
                            <div class="relative">
                                <textarea id="deskripsi" name="deskripsi" rows="5" maxlength="1500" 
                                    class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all text-sm font-medium resize-none @error('deskripsi') border-rose-500 ring-rose-500/20 @enderror" 
                                    placeholder="Jelaskan spesifikasi, kondisi, dan kelengkapan alat..."
                                    oninput="document.getElementById('charCount').textContent = this.value.length + '/1500'">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                                <div class="absolute bottom-3 right-4 text-xs font-bold text-zinc-400 bg-zinc-50/80 px-2 py-1 rounded backdrop-blur-sm" id="charCount">0/1500</div>
                            </div>
                            @error('deskripsi')<p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- GAMBAR -->
                        <div class="space-y-2 md:col-span-2">
                            <label for="gambar" class="block text-sm font-bold text-zinc-700">Ganti Foto (Opsional)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-zinc-300 border-dashed rounded-xl bg-zinc-50 hover:bg-zinc-100 transition-colors relative group">
                                <div class="space-y-1 text-center">
                                    <i class="ti ti-photo-up mx-auto text-4xl text-zinc-400 group-hover:text-zinc-500 transition-colors"></i>
                                    <div class="flex text-sm text-zinc-600 justify-center">
                                        <label for="gambar" class="relative cursor-pointer bg-white rounded-md font-medium text-rose-600 hover:text-rose-500 focus-within:outline-none px-1">
                                            <span>Pilih foto baru</span>
                                            <input id="gambar" name="gambar" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                        </label>
                                        <p class="pl-1">jika ingin mengubah</p>
                                    </div>
                                    <p class="text-xs text-zinc-500">PNG, JPG, JPEG hingga 2MB</p>
                                </div>
                                <!-- Image Preview Area (Hidden by default) -->
                                <div id="imagePreviewContainer" class="absolute inset-0 bg-zinc-50 rounded-xl hidden flex-col items-center justify-center p-2">
                                    <img id="imagePreview" src="#" alt="Preview" class="max-h-full max-w-full object-contain rounded-lg">
                                    <button type="button" onclick="clearImage()" class="absolute top-2 right-2 w-8 h-8 bg-white/90 backdrop-blur-sm text-rose-500 rounded-full flex items-center justify-center border border-zinc-200 shadow-sm hover:bg-rose-50 transition-colors">
                                        <i class="ti ti-x"></i>
                                    </button>
                                </div>
                            </div>
                            @error('gambar')<p class="text-xs font-semibold text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                    </div>

                    <div class="pt-6 border-t border-zinc-100 flex justify-end gap-3 mt-6">
                        <a href="{{ route('admin.products.show', $product->id) }}" class="px-6 py-3 bg-white border border-zinc-200 text-zinc-700 rounded-xl font-bold hover:bg-zinc-50 transition-colors text-sm">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3 bg-zinc-900 text-white rounded-xl font-bold shadow-md hover:bg-zinc-800 transition-colors text-sm flex items-center">
                            <i class="ti ti-device-floppy mr-2"></i> Update Alat
                        </button>
                    </div>

                </form>
            </div>

        </div>
@endsection

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
