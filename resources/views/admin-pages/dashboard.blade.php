<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin – DocuRent</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-zinc-50 text-zinc-900 h-screen overflow-hidden flex selection:bg-rose-500 selection:text-white">

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
                
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 bg-zinc-900 text-white rounded-xl font-semibold shadow-md transition-all group">
                    <i class="ti ti-layout-dashboard text-lg mr-3"></i> 
                    Dashboard
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100 rounded-xl font-semibold transition-all group">
                    <i class="ti ti-package text-lg mr-3 text-zinc-400 group-hover:text-zinc-900 transition-colors"></i> 
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
                <h1 class="text-2xl font-bold text-zinc-900 tracking-tight">Ikhtisar Dashboard</h1>
                <p class="text-sm text-zinc-500 font-medium">Selamat datang kembali, pantau kinerja penyewaan hari ini.</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="w-10 h-10 rounded-full border border-zinc-200 bg-white text-zinc-500 hover:text-zinc-900 flex items-center justify-center hover:bg-zinc-50 transition-colors relative">
                    <i class="ti ti-bell"></i>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full animate-ping"></span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                </button>
            </div>
        </header>

        <div class="p-8 max-w-7xl mx-auto space-y-8">
            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Stat 1 -->
                <div class="bg-zinc-900 rounded-3xl p-8 relative overflow-hidden text-white shadow-xl">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                    <div class="flex items-start justify-between relative z-10">
                        <div>
                            <p class="text-zinc-400 text-sm font-semibold uppercase tracking-widest mb-1">Total Produk</p>
                            <h3 class="text-5xl font-bold tracking-tight">{{ $totalProduk ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/10">
                            <i class="ti ti-package text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="bg-white rounded-3xl p-8 border border-zinc-200 shadow-sm relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-rose-50 opacity-50 rounded-full blur-2xl"></div>
                    <div class="flex items-start justify-between relative z-10">
                        <div>
                            <p class="text-zinc-500 text-sm font-semibold uppercase tracking-widest mb-1">Pelanggan Aktif</p>
                            <h3 class="text-5xl font-bold tracking-tight text-zinc-900">{{ $totalPelanggan ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center border border-rose-100">
                            <i class="ti ti-users text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TRANSAKSI TABLE -->
            <div class="bg-white border border-zinc-200 rounded-3xl overflow-hidden shadow-sm">
                <div class="p-6 border-b border-zinc-100 flex items-center justify-between bg-zinc-50/50">
                    <div>
                        <h2 class="text-lg font-bold text-zinc-900">Transaksi Perlu Konfirmasi</h2>
                        <p class="text-sm text-zinc-500 mt-1">Segera verifikasi pembayaran yang berstatus pending.</p>
                    </div>
                    <a href="{{ route('admin.rentals.index') }}" class="text-sm font-semibold text-rose-500 hover:text-rose-600 transition-colors flex items-center">
                        Lihat Semua <i class="ti ti-arrow-right ml-1"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-zinc-100 text-xs text-zinc-400 font-bold uppercase tracking-widest">
                                <th class="px-6 py-4 font-semibold">ID Pesanan</th>
                                <th class="px-6 py-4 font-semibold">Penyewa</th>
                                <th class="px-6 py-4 font-semibold text-right">Total Belanja</th>
                                <th class="px-6 py-4 font-semibold text-center">Status</th>
                                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-zinc-50">
                            @forelse($rentalsPaymentPending as $rental)
                                <tr class="hover:bg-zinc-50 transition-colors group">
                                    <td class="px-6 py-4 font-bold text-zinc-900 whitespace-nowrap">
                                        #{{ $rental->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-500 font-bold text-xs">
                                                {{ substr($rental->user->nama, 0, 1) }}
                                            </div>
                                            <span class="font-semibold text-zinc-900">{{ $rental->user->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-rose-500 text-right whitespace-nowrap">
                                        Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600 mr-1.5 animate-pulse"></span>
                                            {{ ucwords($rental->payment->status_pembayaran ?? '-') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <a href="{{ route('admin.rentals.show', $rental->id) }}" class="inline-flex items-center px-4 py-2 bg-zinc-900 text-white rounded-lg text-xs font-bold hover:bg-zinc-800 transition-colors shadow-sm transform group-hover:-translate-y-0.5">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-zinc-500">
                                        <div class="w-16 h-16 bg-zinc-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <i class="ti ti-inbox text-2xl text-zinc-400"></i>
                                        </div>
                                        <p class="font-semibold text-zinc-900">Tidak ada transaksi tertunda</p>
                                        <p class="text-sm">Semua pembayaran telah dikonfirmasi.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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