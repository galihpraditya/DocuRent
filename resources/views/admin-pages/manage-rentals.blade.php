<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi – DocuRent</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- HTMX for Instant Navigation -->
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
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
                
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100 rounded-xl font-semibold transition-all group">
                    <i class="ti ti-package text-lg mr-3 text-zinc-400 group-hover:text-zinc-900 transition-colors"></i> 
                    Manajemen Produk
                </a>
                
                <a href="{{ route('admin.rentals.index') }}" class="flex items-center px-4 py-3 bg-zinc-900 text-white rounded-xl font-semibold shadow-md transition-all group">
                    <i class="ti ti-file-text text-lg mr-3"></i> 
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
                <h1 class="text-2xl font-bold text-zinc-900 tracking-tight">Daftar Transaksi</h1>
                <p class="text-sm text-zinc-500 font-medium">Kelola dan pantau seluruh transaksi rental.</p>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto space-y-6">
            
            <!-- SEARCH & SORT -->
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1 bg-white p-2 rounded-3xl border border-zinc-200 shadow-sm flex items-center gap-2">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ti ti-search text-zinc-400 text-lg"></i>
                        </div>
                        <input type="text" id="searchInput" onkeyup="filterRentals()" class="w-full pl-12 pr-4 py-2.5 bg-transparent border-none focus:outline-none transition-all text-sm font-medium" placeholder="Cari berdasarkan nama penyewa...">
                    </div>
                </div>
                <div class="bg-white p-2 rounded-3xl border border-zinc-200 shadow-sm flex items-center pr-4">
                    <div class="pl-4 flex items-center pointer-events-none">
                        <i class="ti ti-arrows-sort text-zinc-400 text-lg"></i>
                    </div>
                    <select id="sortSelect" onchange="sortRentals()" class="pl-2 pr-4 py-2.5 bg-transparent border-none focus:outline-none text-sm font-medium text-zinc-700 cursor-pointer">
                        <option value="asc">A - Z (Nama)</option>
                        <option value="desc">Z - A (Nama)</option>
                    </select>
                </div>
            </div>

            <!-- STATUS FILTER -->
            <div class="flex overflow-x-auto no-scrollbar gap-2 pb-2">
                <span class="flex items-center text-sm font-bold text-zinc-400 uppercase tracking-widest mr-2">Filter:</span>
                <button class="filter-btn active whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold transition-all bg-zinc-900 text-white shadow-md" onclick="setFilter('all', this)">Semua Transaksi</button>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold transition-all bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50" onclick="setFilter('pending', this)">Pending</button>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold transition-all bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50" onclick="setFilter('ongoing', this)">Berlangsung</button>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold transition-all bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50" onclick="setFilter('completed', this)">Selesai</button>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold transition-all bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50" onclick="setFilter('cancelled', this)">Dibatalkan</button>
            </div>

            <!-- RENTAL LIST -->
            <div class="space-y-4" id="rentalList">
                @forelse ($rentals as $rental)
                    @php $firstItem = $rental->rentalItems->first(); @endphp
                    
                    <div class="rental-card group bg-white rounded-3xl border border-zinc-200 p-6 flex flex-col md:flex-row md:items-center gap-6 hover:shadow-lg transition-all duration-300"
                         data-status="{{ $rental->status }}"
                         data-name="{{ strtolower($rental->user->nama ?? '') }}">
                        
                        <!-- Gambar & Info Produk -->
                        <div class="flex items-center gap-5 w-full md:w-2/5">
                            <div class="w-20 h-20 rounded-2xl bg-zinc-100 flex items-center justify-center shrink-0 border border-zinc-200 overflow-hidden">
                                @if ($firstItem && $firstItem->product->gambar)
                                    <img src="{{ asset('storage/' . $firstItem->product->gambar) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="ti ti-camera text-3xl text-zinc-300"></i>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-zinc-900 text-lg leading-tight mb-1">
                                    {{ $firstItem ? $firstItem->product->nama_produk : '-' }}
                                </h3>
                                @if ($rental->rentalItems->count() > 1)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-zinc-100 text-zinc-600 mb-2">
                                        +{{ $rental->rentalItems->count() - 1 }} item lainnya
                                    </span>
                                @endif
                                <div class="text-xs text-zinc-500 font-medium flex items-center">
                                    <i class="ti ti-calendar mr-1"></i>
                                    {{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d/m/y') }} – {{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d/m/y') }}
                                </div>
                            </div>
                        </div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 w-full md:w-3/5 items-center">
                            <div>
                                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1">Penyewa</p>
                                <p class="font-semibold text-zinc-900 flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center text-xs shrink-0">
                                        {{ substr($rental->user->nama, 0, 1) }}
                                    </span>
                                    {{ $rental->user->nama ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1">Total Biaya</p>
                                <p class="font-bold text-rose-500">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</p>
                            </div>

                            <div class="col-span-2 md:col-span-1 flex flex-col sm:flex-row md:flex-col lg:flex-row gap-3 items-start sm:items-center justify-between">
                                <div>
                                    <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 md:hidden lg:block">Status</p>
                                    @if($rental->status == 'pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600 mr-1.5 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @elseif($rental->status == 'ongoing')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600 mr-1.5"></span>
                                            Sedang Disewa
                                        </span>
                                    @elseif($rental->status == 'completed')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-600 mr-1.5"></span>
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-600 mr-1.5"></span>
                                            Dibatalkan
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('admin.rentals.show', $rental->id) }}" class="px-5 py-2.5 bg-zinc-900 text-white rounded-xl text-xs font-bold hover:bg-zinc-800 transition-colors shadow-sm whitespace-nowrap">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="bg-white rounded-3xl border border-zinc-200 border-dashed p-16 flex flex-col items-center justify-center text-center shadow-sm">
                        <div class="w-20 h-20 bg-zinc-50 rounded-full flex items-center justify-center mb-6">
                            <i class="ti ti-file-text text-3xl text-zinc-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-900 mb-2">Tidak Ada Transaksi</h3>
                        <p class="text-zinc-500">Belum ada transaksi penyewaan yang sesuai dengan kriteria saat ini.</p>
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

        let activeFilter = 'all';

        function setFilter(status, btn) {
            activeFilter = status;
            
            // Update button styles
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-zinc-900', 'text-white', 'shadow-md');
                b.classList.add('bg-white', 'text-zinc-600', 'border', 'border-zinc-200', 'hover:bg-zinc-50');
            });
            btn.classList.remove('bg-white', 'text-zinc-600', 'border', 'border-zinc-200', 'hover:bg-zinc-50');
            btn.classList.add('bg-zinc-900', 'text-white', 'shadow-md');
            
            applyFilters();
        }

        function filterRentals() { applyFilters(); }

        function applyFilters() {
            const q = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('#rentalList .rental-card').forEach(card => {
                const matchStatus = activeFilter === 'all' || card.dataset.status === activeFilter;
                const matchName   = card.dataset.name.includes(q);
                if (matchStatus && matchName) {
                    card.classList.remove('hidden');
                    card.classList.add('flex');
                } else {
                    card.classList.add('hidden');
                    card.classList.remove('flex');
                }
            });
        }

        function sortRentals() {
            const list = document.getElementById('rentalList');
            const cards = [...list.querySelectorAll('.rental-card')];
            const asc = document.getElementById('sortSelect').value === 'asc';
            
            cards.sort((a, b) => {
                const na = a.dataset.name, nb = b.dataset.name;
                return asc ? na.localeCompare(nb) : nb.localeCompare(na);
            });
            
            cards.forEach(c => list.appendChild(c));
        }
    </script>
</body>
</html>
