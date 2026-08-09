<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk – DocuRent</title>
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
        <!-- TOPBAR -->
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-zinc-200 flex items-center justify-between px-8 sticky top-0 z-10">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 tracking-tight">Manajemen Produk</h1>
                <p class="text-sm text-zinc-500 font-medium">Kelola inventaris peralatan rental Anda.</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.products.create') }}" class="px-6 py-2.5 bg-rose-500 text-white rounded-full font-bold shadow-lg shadow-rose-500/30 hover:bg-rose-600 transition-all flex items-center">
                    <i class="ti ti-plus mr-2"></i> Tambah Alat Baru
                </a>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto space-y-6">
            
            <!-- SEARCH BAR -->
            <div class="bg-white p-4 rounded-3xl border border-zinc-200 shadow-sm flex items-center gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="ti ti-search text-zinc-400 text-lg"></i>
                    </div>
                    <input type="text" id="searchInput" onkeyup="filterProducts()" class="w-full pl-12 pr-4 py-3 bg-zinc-50 border border-zinc-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all text-sm font-medium" placeholder="Cari berdasarkan nama peralatan...">
                </div>
            </div>

            <!-- PRODUCT GRID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6" id="productGrid">
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
</body>
</html>
