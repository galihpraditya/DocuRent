<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi – DocuRent</title>
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
        <div class="p-8 max-w-6xl mx-auto space-y-6">
            
            <!-- BACK BUTTON -->
            <a href="{{ route('admin.rentals.index') }}" class="inline-flex items-center text-sm font-bold text-zinc-500 hover:text-zinc-900 transition-colors mb-2">
                <i class="ti ti-arrow-left mr-2"></i> Kembali ke Daftar Transaksi
            </a>

            <!-- HEADER -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-zinc-900 tracking-tight">Detail Pesanan</h1>
                    <p class="text-sm text-zinc-500 font-medium">Booking ID: <span class="font-bold text-zinc-900 px-2 py-1 bg-zinc-200 rounded-md">#{{ $rental->id }}</span></p>
                </div>
                <div class="flex gap-2">
                    @if($rental->payment->status_pembayaran == 'paid')
                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-green-100 text-green-800 border border-green-200">
                            <i class="ti ti-check mr-2 text-green-600"></i> Lunas
                        </span>
                    @elseif($rental->payment->status_pembayaran == 'waiting for verification')
                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-amber-100 text-amber-800 border border-amber-200">
                            <span class="w-2 h-2 rounded-full bg-amber-600 mr-2 animate-pulse"></span> Verifikasi Pembayaran
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-rose-100 text-rose-800 border border-rose-200">
                            <i class="ti ti-x mr-2 text-rose-600"></i> {{ ucfirst($rental->payment->status_pembayaran) }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">
                
                <!-- KIRI -->
                <div class="lg:w-2/3 space-y-6">
                    
                    <!-- Customer Info -->
                    <div class="bg-white rounded-3xl p-6 md:p-8 border border-zinc-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
                        <div class="absolute -right-8 -top-8 w-40 h-40 bg-zinc-50 rounded-full blur-3xl z-0"></div>
                        <div class="relative z-10">
                            <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">Informasi Penyewa</h3>
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-zinc-100 rounded-full flex items-center justify-center border border-zinc-200 text-zinc-500 font-bold text-xl">
                                    {{ substr($rental->user->nama, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-zinc-900 text-lg">{{ $rental->user->nama }}</p>
                                    <p class="text-sm text-zinc-500">{{ $rental->user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="relative z-10 flex gap-4 md:text-right">
                            <div class="bg-zinc-50 p-3 rounded-2xl border border-zinc-100">
                                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1">Ambil</p>
                                <p class="font-bold text-zinc-900 text-sm">{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }}</p>
                            </div>
                            <div class="bg-zinc-50 p-3 rounded-2xl border border-zinc-100">
                                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1">Kembali</p>
                                <p class="font-bold text-zinc-900 text-sm">{{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Items -->
                    <div class="bg-white rounded-3xl p-6 md:p-8 border border-zinc-200 shadow-sm">
                        <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-6">Item Disewa</h3>
                        
                        <div class="space-y-4 mb-6">
                            @foreach ($rental->rentalItems as $item)
                                <div class="flex items-center gap-4 p-4 rounded-2xl border border-zinc-100 bg-zinc-50">
                                    <div class="w-16 h-16 rounded-xl bg-white overflow-hidden shrink-0 border border-zinc-200">
                                        @if ($item->product->gambar)
                                            <img src="{{ asset('storage/' . $item->product->gambar) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center"><i class="ti ti-camera text-2xl text-zinc-300"></i></div>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="font-bold text-zinc-900 mb-1">{{ $item->product->nama_produk }}</h4>
                                        <p class="text-sm text-zinc-500">{{ $item->jumlah }} x Rp {{ number_format($item->harga_saat_sewa, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-zinc-900">Rp {{ number_format($item->harga_saat_sewa * $item->jumlah, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="flex justify-between items-center pt-6 border-t border-zinc-200 border-dashed">
                            <span class="font-bold text-zinc-900">Total Biaya Sewa</span>
                            <span class="text-2xl font-bold text-rose-500">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                </div>

                <!-- KANAN -->
                <div class="lg:w-1/3 space-y-6">
                    
                    <!-- Update Status -->
                    <div class="bg-zinc-900 rounded-3xl p-6 md:p-8 text-white relative overflow-hidden shadow-xl">
                        <div class="absolute -right-8 -top-8 w-40 h-40 bg-white opacity-5 rounded-full blur-3xl z-0"></div>
                        <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-6 relative z-10">Manajemen Status</h3>
                        
                        <form action="{{ route('admin.rentals.update-status', $rental->id) }}" method="POST" class="relative z-10 space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-sm font-semibold text-zinc-300 mb-2">Status Pesanan</label>
                                <select name="status" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-rose-500 text-sm font-medium appearance-none">
                                    <option value="pending" {{ $rental->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="ongoing" {{ $rental->status == 'ongoing' ? 'selected' : '' }}>Berlangsung</option>
                                    <option value="completed" {{ $rental->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                    <option value="cancelled" {{ $rental->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full py-3 bg-white text-zinc-900 rounded-xl font-bold hover:bg-zinc-100 transition-colors shadow-lg">
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>

                    <!-- Payment Verification -->
                    @if (isset($rental->payment))
                        <div class="bg-white rounded-3xl p-6 md:p-8 border border-zinc-200 shadow-sm">
                            <h3 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-6">Bukti Pembayaran</h3>
                            
                            @if ($rental->payment->status_pembayaran != 'verified' && $rental->payment->status_pembayaran != 'paid')
                                @if ($rental->payment->bukti_pembayaran)
                                    <div class="rounded-2xl overflow-hidden border border-zinc-200 mb-6 bg-zinc-50">
                                        <a href="{{ asset('storage/' . $rental->payment->bukti_pembayaran) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $rental->payment->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="w-full object-contain max-h-60 hover:opacity-90 transition-opacity">
                                        </a>
                                    </div>
                                    
                                    <form action="{{ route('admin.payments.verify', $rental->payment->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="w-full py-3.5 bg-green-500 text-white rounded-xl font-bold hover:bg-green-600 shadow-lg shadow-green-500/30 transition-all flex items-center justify-center">
                                            <i class="ti ti-check mr-2"></i> Konfirmasi Valid
                                        </button>
                                    </form>
                                @else
                                    <div class="p-8 text-center bg-zinc-50 rounded-2xl border border-zinc-100 border-dashed">
                                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm">
                                            <i class="ti ti-photo-off text-zinc-400 text-xl"></i>
                                        </div>
                                        <p class="text-sm font-bold text-zinc-900">Belum ada bukti</p>
                                        <p class="text-xs text-zinc-500">Penyewa belum mengunggah bukti.</p>
                                    </div>
                                @endif
                            @else
                                <div class="bg-green-50 border border-green-200 rounded-2xl p-6 text-center">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="ti ti-circle-check text-green-600 text-2xl"></i>
                                    </div>
                                    <p class="font-bold text-green-800">Pembayaran Terverifikasi</p>
                                    @if ($rental->payment->bukti_pembayaran)
                                        <a href="{{ asset('storage/' . $rental->payment->bukti_pembayaran) }}" target="_blank" class="inline-block mt-3 text-xs font-bold text-green-700 hover:text-green-900 underline">
                                            Lihat Bukti Foto
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endif

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
