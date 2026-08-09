<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk – DocuRent</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- HTMX for Instant Navigation -->
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body hx-boost="true" class="bg-zinc-50 text-zinc-900 h-screen overflow-hidden flex selection:bg-rose-500 selection:text-white">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-zinc-200 flex flex-col justify-between h-full shrink-0 shadow-sm z-20">
        <div>
            <!-- LOGO -->
            <div class="h-20 flex items-center px-8 border-b border-zinc-100">
                <div class="w-10 h-10 rounded-xl bg-zinc-900 text-white flex items-center justify-center mr-3 shadow-md">
                    <i class="ti ti-camera text-xl"></i>
                </div>
                <span class="text-xl font-bold tracking-tight">DocuRent<span class="text-rose-500">.</span></span>
            </div>
            
            <!-- NAV -->
            <nav class="p-4 space-y-1.5 mt-4">
                <p class="px-4 text-xs font-bold text-zinc-400 tracking-widest uppercase mb-3">Menu Utama</p>
                
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100 rounded-xl font-semibold transition-all group">
                    <i class="ti ti-layout-dashboard text-lg mr-3 text-zinc-400 group-hover:text-zinc-900 transition-colors"></i> 
                    Dashboard
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 bg-zinc-900 text-white rounded-xl font-semibold shadow-md transition-all group">
                    <i class="ti ti-package text-lg mr-3"></i> 
                    Manajemen Produk
                </a>
                
                <a href="{{ route('admin.rentals.index') }}" class="flex items-center px-4 py-3 text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100 rounded-xl font-semibold transition-all group">
                    <i class="ti ti-file-text text-lg mr-3 text-zinc-400 group-hover:text-zinc-900 transition-colors"></i> 
                    Daftar Transaksi
                </a>
            </nav>
        </div>

        <!-- SIDEBAR BOTTOM -->
        <div class="p-4 border-t border-zinc-100 bg-zinc-50/50">
            <div class="flex items-center p-3 bg-white border border-zinc-200 rounded-xl mb-3 shadow-sm">
                <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mr-3">
                    <i class="ti ti-user font-bold"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-zinc-900">Administrator</p>
                    <p class="text-xs text-zinc-500">admin@docurent.id</p>
                </div>
            </div>
            <button onclick="openLogout()" class="w-full flex items-center justify-center px-4 py-2.5 border border-zinc-200 text-zinc-600 hover:text-rose-600 hover:bg-rose-50 hover:border-rose-100 rounded-xl font-semibold transition-all">
                <i class="ti ti-logout text-lg mr-2"></i> Log Out
            </button>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 h-full overflow-y-auto bg-zinc-50/50 relative">
        <div class="p-8 max-w-5xl mx-auto space-y-6">
            
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
    </main>

    <!-- LOGOUT MODAL -->
    <div id="logoutModal" class="fixed inset-0 bg-zinc-900/40 backdrop-blur-sm z-50 hidden items-center justify-center transition-opacity">
        <div class="bg-white rounded-3xl p-8 max-w-sm w-full mx-4 shadow-2xl transform scale-95 transition-transform" id="logoutModalBox">
            <div class="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center mx-auto mb-4 text-rose-500">
                <i class="ti ti-logout text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-center text-zinc-900 mb-2">Akhiri Sesi?</h3>
            <p class="text-center text-zinc-500 mb-8 text-sm">Anda akan keluar dari akun Administrator. Anda harus login kembali untuk masuk.</p>
            <div class="flex gap-3">
                <button onclick="closeLogout()" class="flex-1 py-3 px-4 bg-white border-2 border-zinc-200 text-zinc-700 rounded-xl font-bold hover:bg-zinc-50 transition-colors">
                    Batal
                </button>
                <form action="{{ route('logout') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full py-3 px-4 bg-rose-500 text-white rounded-xl font-bold hover:bg-rose-600 shadow-lg shadow-rose-500/30 transition-all">
                        Ya, Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('logoutModal');
        const modalBox = document.getElementById('logoutModalBox');

        function openLogout() { 
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modalBox.classList.remove('scale-95');
                modalBox.classList.add('scale-100');
            }, 10);
        }

        function closeLogout() { 
            modalBox.classList.remove('scale-100');
            modalBox.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        modal.addEventListener('click', function(e) {
            if (e.target === this) closeLogout();
        });
    </script>
</body>
</html>
