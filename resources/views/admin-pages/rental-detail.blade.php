@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $rental->id)
@section('header_title', 'Detail Pesanan')
@section('header_subtitle', 'Tinjau pesanan dan verifikasi bukti pembayaran')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- TOP ACTION / BREADCRUMB -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.rentals.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-zinc-500 hover:text-zinc-900 transition-colors">
            <i class="ti ti-arrow-left text-base"></i>
            <span>Kembali ke Daftar Transaksi</span>
        </a>
    </div>

    <!-- ORDER HERO HEADER -->
    <div class="bg-white rounded-3xl p-6 md:p-8 border border-zinc-200/80 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-5">
        <div class="space-y-1.5">
            <div class="flex items-center gap-3 flex-wrap">
                <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Pesanan #{{ $rental->id }}</h1>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-zinc-100 text-zinc-700 border border-zinc-200/80">
                    ID: {{ $rental->id }}
                </span>
                
                @if($rental->status == 'pending')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200/80">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        Pending
                    </span>
                @elseif($rental->status == 'ongoing')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-zinc-900 text-white border border-zinc-800">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                        Sedang Berlangsung
                    </span>
                @elseif($rental->status == 'completed')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200/80">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                        Selesai
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-zinc-100 text-zinc-600 border border-zinc-200/80">
                        <span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span>
                        Dibatalkan
                    </span>
                @endif
            </div>
            <p class="text-xs text-zinc-500 flex items-center gap-2">
                <span>Dibuat pada {{ \Carbon\Carbon::parse($rental->created_at)->format('d F Y • H:i') }} WIB</span>
            </p>
        </div>

        <div class="flex items-center gap-3">
            @if(isset($rental->payment))
                @if($rental->payment->status_pembayaran == 'paid' || $rental->payment->status_pembayaran == 'verified')
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200/80">
                        <i class="ti ti-check text-base text-emerald-600"></i>
                        <span>Pembayaran Lunas</span>
                    </div>
                @elseif($rental->payment->status_pembayaran == 'waiting for verification')
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200/80">
                        <span class="w-2 h-2 rounded-full bg-amber-600 animate-pulse"></span>
                        <span>Menunggu Verifikasi</span>
                    </div>
                @elseif($rental->payment->status_pembayaran == 'failed')
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200/80">
                        <i class="ti ti-x text-base text-rose-600"></i>
                        <span>Pembayaran Ditolak</span>
                    </div>
                @else
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-xs font-bold bg-zinc-100 text-zinc-700 border border-zinc-200/80">
                        <i class="ti ti-clock text-base text-zinc-500"></i>
                        <span>{{ ucfirst($rental->payment->status_pembayaran) }}</span>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <!-- MAIN TWO-COLUMN CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT COLUMN: Customer & Order Breakdown (2 cols) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Customer & Rental Schedule Card -->
            <div class="bg-white rounded-3xl p-6 md:p-8 border border-zinc-200/80 shadow-2xs">
                <div class="flex items-center justify-between mb-5">
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Informasi Penyewa</span>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-zinc-100 text-zinc-600 border border-zinc-200/60">
                        {{ \Carbon\Carbon::parse($rental->tanggal_sewa)->diffInDays(\Carbon\Carbon::parse($rental->tanggal_kembali)) ?: 1 }} Hari Sewa
                    </span>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-13 h-13 rounded-2xl bg-zinc-900 text-white font-bold text-lg flex items-center justify-center shrink-0 shadow-2xs">
                            {{ strtoupper(substr($rental->user->nama, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-zinc-900">{{ $rental->user->nama }}</h3>
                            <p class="text-xs text-zinc-500 mt-0.5 flex items-center gap-1.5">
                                <i class="ti ti-mail text-zinc-400"></i>
                                {{ $rental->user->email }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 sm:text-right">
                        <div class="bg-zinc-50/90 p-3 rounded-2xl border border-zinc-200/70 text-left">
                            <span class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-0.5">Tanggal Ambil</span>
                            <span class="block text-xs font-bold text-zinc-900 font-mono tabular-nums">
                                {{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }}
                            </span>
                        </div>
                        <div class="bg-zinc-50/90 p-3 rounded-2xl border border-zinc-200/70 text-left">
                            <span class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-0.5">Tanggal Kembali</span>
                            <span class="block text-xs font-bold text-zinc-900 font-mono tabular-nums">
                                {{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rental Items Card -->
            <div class="bg-white rounded-3xl p-6 md:p-8 border border-zinc-200/80 shadow-2xs">
                <div class="flex items-center justify-between mb-5">
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Rincian Perangkat</span>
                    <span class="text-xs font-medium text-zinc-500">{{ $rental->rentalItems->count() }} item</span>
                </div>

                <div class="divide-y divide-zinc-100">
                    @foreach ($rental->rentalItems as $item)
                        <div class="py-4 first:pt-0 last:pb-0 flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-zinc-100 overflow-hidden shrink-0 border border-zinc-200/80">
                                @if ($item->product && $item->product->gambar)
                                    <img src="{{ asset('storage/' . $item->product->gambar) }}" alt="{{ $item->product->nama_produk }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-zinc-300">
                                        <i class="ti ti-camera text-2xl"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-grow min-w-0">
                                <h4 class="text-sm font-bold text-zinc-900 truncate">
                                    {{ $item->product ? $item->product->nama_produk : 'Produk Tidak Ditemukan' }}
                                </h4>
                                <p class="text-xs text-zinc-500 mt-0.5 font-mono tabular-nums">
                                    {{ $item->jumlah }} unit × Rp {{ number_format($item->harga_saat_sewa, 0, ',', '.') }} / hari
                                </p>
                            </div>

                            <div class="text-right shrink-0">
                                <span class="block text-xs font-bold text-zinc-400 uppercase tracking-wider mb-0.5">Subtotal</span>
                                <span class="text-sm font-bold text-zinc-900 font-mono tabular-nums">
                                    Rp {{ number_format($item->harga_saat_sewa * $item->jumlah, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Total Row -->
                <div class="mt-6 pt-6 border-t border-zinc-200/80 flex items-baseline justify-between">
                    <div>
                        <span class="block text-xs font-bold text-zinc-900">Total Biaya Sewa</span>
                        <span class="text-[11px] text-zinc-400">Termasuk seluruh unit & durasi hari</span>
                    </div>
                    <div class="text-right">
                        <span class="text-2xl font-bold font-mono tabular-nums text-zinc-900">
                            Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: Status Manager & Payment Proof (1 col) -->
        <div class="space-y-6">

            <!-- Order Status Management Card -->
            <div class="bg-zinc-900 rounded-3xl p-6 text-white border border-zinc-800 shadow-xl relative overflow-hidden">
                <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Status Pesanan</span>
                        <span class="w-2 h-2 rounded-full bg-zinc-600"></span>
                    </div>

                    <form action="{{ route('admin.rentals.update-status', $rental->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-semibold text-zinc-300 mb-1.5">Perbarui Tahapan</label>
                            <div class="relative">
                                <select name="status" class="w-full bg-zinc-800/90 border border-zinc-700/80 text-white rounded-xl px-4 py-3 text-xs font-medium focus:outline-none focus:ring-1 focus:ring-zinc-400 appearance-none cursor-pointer">
                                    <option value="pending" {{ $rental->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                    <option value="ongoing" {{ $rental->status == 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung (Diambil)</option>
                                    <option value="completed" {{ $rental->status == 'completed' ? 'selected' : '' }}>Selesai (Sudah Kembali)</option>
                                    <option value="cancelled" {{ $rental->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                <i class="ti ti-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-zinc-400 pointer-events-none text-sm"></i>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-2.5 bg-white hover:bg-zinc-100 text-zinc-900 rounded-xl text-xs font-bold transition-colors cursor-pointer shadow-sm">
                            Simpan Perubahan Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Payment Proof & Verification -->
            @if (isset($rental->payment))
                <div class="bg-white rounded-3xl p-6 border border-zinc-200/80 shadow-2xs space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">Bukti Pembayaran</span>
                        <span class="text-xs font-mono text-zinc-400">#PAY-{{ $rental->payment->id }}</span>
                    </div>

                    @if ($rental->payment->status_pembayaran != 'verified' && $rental->payment->status_pembayaran != 'paid' && $rental->payment->status_pembayaran != 'failed')
                        @if ($rental->payment->bukti_pembayaran)
                            <div class="rounded-2xl overflow-hidden border border-zinc-200/80 bg-zinc-50 group relative">
                                <img src="{{ asset('storage/' . $rental->payment->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="w-full max-h-64 object-contain mx-auto transition-transform duration-300 group-hover:scale-105">
                                <a href="{{ asset('storage/' . $rental->payment->bukti_pembayaran) }}" target="_blank" class="absolute inset-0 bg-zinc-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold gap-2">
                                    <i class="ti ti-zoom-in text-base"></i>
                                    <span>Buka Gambar Penuh</span>
                                </a>
                            </div>

                            <div class="space-y-2 pt-2">
                                <form action="{{ route('admin.payments.verify', $rental->payment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 cursor-pointer shadow-2xs">
                                        <i class="ti ti-check text-sm"></i>
                                        <span>Konfirmasi Valid</span>
                                    </button>
                                </form>

                                <form id="reject-payment-form" action="{{ route('admin.payments.reject', $rental->payment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button 
                                        type="button" 
                                        onclick="confirmRejectPayment()"
                                        class="w-full py-2 bg-white hover:bg-rose-50/60 text-rose-600 border border-rose-200/80 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5 cursor-pointer"
                                    >
                                        <i class="ti ti-x text-sm"></i>
                                        <span>Tolak Bukti Pembayaran</span>
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="p-8 text-center bg-zinc-50/80 rounded-2xl border border-zinc-200/70 border-dashed">
                                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center mx-auto mb-2 text-zinc-400 border border-zinc-200/80 shadow-2xs">
                                    <i class="ti ti-photo-off text-lg"></i>
                                </div>
                                <p class="text-xs font-bold text-zinc-800">Belum Ada Bukti</p>
                                <p class="text-[11px] text-zinc-500 mt-0.5">Penyewa belum mengunggah struk transfer.</p>
                            </div>
                        @endif
                    @elseif ($rental->payment->status_pembayaran == 'failed')
                        <div class="bg-rose-50/80 border border-rose-200/80 rounded-2xl p-5 text-center space-y-2">
                            <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center mx-auto">
                                <i class="ti ti-circle-x text-xl"></i>
                            </div>
                            <h4 class="text-xs font-bold text-rose-900">Pembayaran Ditolak</h4>
                            <p class="text-[11px] text-rose-600">Pesanan otomatis dibatalkan dan kuota stok telah dikembalikan ke inventaris.</p>
                            @if ($rental->payment->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $rental->payment->bukti_pembayaran) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-rose-700 hover:text-rose-900 underline pt-1">
                                    <i class="ti ti-eye text-sm"></i>
                                    <span>Tinjau Bukti Foto</span>
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="bg-emerald-50/80 border border-emerald-200/80 rounded-2xl p-5 text-center space-y-2">
                            <div class="w-10 h-10 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center mx-auto">
                                <i class="ti ti-circle-check text-xl"></i>
                            </div>
                            <h4 class="text-xs font-bold text-emerald-900">Pembayaran Terverifikasi</h4>
                            <p class="text-[11px] text-emerald-700">Bukti pembayaran valid dan transaksi telah dikonfirmasi lunas.</p>
                            @if ($rental->payment->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $rental->payment->bukti_pembayaran) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-800 hover:text-emerald-950 underline pt-1">
                                    <i class="ti ti-eye text-sm"></i>
                                    <span>Tinjau Bukti Foto</span>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endif

        </div>

    </div>

</div>

<script>
    function confirmRejectPayment() {
        openConfirmModal({
            title: 'Tolak Bukti Pembayaran?',
            message: 'Apakah Anda yakin ingin menolak bukti transfer ini? Pesanan rental akan <strong>otomatis dibatalkan</strong> dan kuota stok perangkat akan segera dikembalikan ke inventaris.',
            confirmText: 'Ya, Tolak Bukti',
            isDanger: true,
            onConfirm: function() {
                const form = document.getElementById('reject-payment-form');
                if (form) form.submit();
            }
        });
    }
</script>
@endsection
