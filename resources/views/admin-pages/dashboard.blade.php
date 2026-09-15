@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Ikhtisar Dashboard')
@section('header_subtitle', 'Selamat datang kembali, pantau operasional dan verifikasi rental hari ini.')

@section('header_actions')
<form id="reset-demo-form" action="{{ route('admin.demo.reset') }}" method="POST">
    @csrf
    <button 
        type="button" 
        onclick="confirmResetDemo()" 
        class="inline-flex items-center justify-center gap-1.5 h-9 px-2.5 sm:px-3.5 bg-white hover:bg-zinc-50 text-zinc-700 hover:text-zinc-900 border border-zinc-200/90 rounded-xl text-xs font-semibold transition-all shadow-2xs cursor-pointer shrink-0" 
        title="Reset dan segarkan seluruh data demo"
    >
        <i class="ti ti-refresh text-sm"></i>
        <span class="hidden sm:inline">Reset Data Demo</span>
    </button>
</form>

<a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center gap-1.5 h-9 px-2.5 sm:px-3.5 bg-zinc-900 text-white rounded-xl text-xs font-semibold hover:bg-zinc-800 transition-all shadow-2xs cursor-pointer shrink-0" title="Tambah Produk">
    <i class="ti ti-plus text-sm"></i>
    <span class="hidden sm:inline">Tambah Produk</span>
</a>
@endsection

@section('content')
<div class="space-y-8">
    
    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        
        <!-- CARD 1: TOTAL PRODUK -->
        <div class="bg-white rounded-3xl p-6 border border-zinc-200/80 shadow-2xs hover:border-zinc-300 transition-all flex flex-col justify-between group">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Inventaris Kamera & Gear</span>
                    <h3 class="text-3xl font-bold text-zinc-900 tracking-tight mt-1.5 tabular-nums">
                        {{ $totalProduk }} <span class="text-sm font-normal text-zinc-400">Unit</span>
                    </h3>
                </div>
                <div class="w-11 h-11 rounded-2xl bg-zinc-100 text-zinc-700 flex items-center justify-center text-lg border border-zinc-200/60 shadow-2xs group-hover:bg-zinc-900 group-hover:text-white transition-colors">
                    <i class="ti ti-camera"></i>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-zinc-100 flex items-center justify-between text-xs">
                <span class="text-zinc-500 font-medium">Peralatan siap disewa</span>
                <a href="{{ route('admin.products.index') }}" class="font-semibold text-zinc-900 hover:text-zinc-600 transition-colors inline-flex items-center gap-1">
                    Kelola <span class="text-zinc-400">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- CARD 2: PELANGGAN AKTIF -->
        <div class="bg-white rounded-3xl p-6 border border-zinc-200/80 shadow-2xs hover:border-zinc-300 transition-all flex flex-col justify-between group">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Penyewa Aktif</span>
                    <h3 class="text-3xl font-bold text-zinc-900 tracking-tight mt-1.5 tabular-nums">
                        {{ $totalPelangganAktif }} <span class="text-sm font-normal text-zinc-400">User</span>
                    </h3>
                </div>
                <div class="w-11 h-11 rounded-2xl bg-zinc-100 text-zinc-700 flex items-center justify-center text-lg border border-zinc-200/60 shadow-2xs group-hover:bg-zinc-900 group-hover:text-white transition-colors">
                    <i class="ti ti-users"></i>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-zinc-100 flex items-center justify-between text-xs">
                <span class="text-zinc-500 font-medium">Masa rental berlangsung</span>
                <a href="{{ route('admin.rentals.index') }}" class="font-semibold text-zinc-900 hover:text-zinc-600 transition-colors inline-flex items-center gap-1">
                    Daftar <span class="text-zinc-400">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- CARD 3: MENUNGGU VERIFIKASI -->
        <div class="bg-white rounded-3xl p-6 border {{ $rentalsPaymentPending->count() > 0 ? 'border-amber-200/80 bg-amber-50/10' : 'border-zinc-200/80' }} shadow-2xs hover:border-zinc-300 transition-all flex flex-col justify-between group">
            <div class="flex items-start justify-between">
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Verifikasi Pembayaran</span>
                        @if($rentalsPaymentPending->count() > 0)
                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        @endif
                    </div>
                    <h3 class="text-3xl font-bold text-zinc-900 tracking-tight mt-1.5 tabular-nums">
                        {{ $rentalsPaymentPending->count() }} <span class="text-sm font-normal text-zinc-400">Transaksi</span>
                    </h3>
                </div>
                <div class="w-11 h-11 rounded-2xl {{ $rentalsPaymentPending->count() > 0 ? 'bg-amber-100 text-amber-800 border-amber-200' : 'bg-zinc-100 text-zinc-700 border-zinc-200/60' }} flex items-center justify-center text-lg border shadow-2xs transition-colors">
                    <i class="ti ti-receipt-2"></i>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-zinc-100 flex items-center justify-between text-xs">
                <span class="text-zinc-500 font-medium">
                    @if($rentalsPaymentPending->count() > 0)
                        <span class="text-amber-700 font-semibold">Perlu tindakan verifikasi</span>
                    @else
                        Semua bukti telah terverifikasi
                    @endif
                </span>
                <a href="{{ route('admin.rentals.index') }}" class="font-semibold text-zinc-900 hover:text-zinc-600 transition-colors inline-flex items-center gap-1">
                    Tinjau <span class="text-zinc-400">&rarr;</span>
                </a>
            </div>
        </div>

    </div>

    <!-- LATEST TRANSACTIONS NEEDING VERIFICATION -->
    <div class="bg-white rounded-3xl border border-zinc-200/80 shadow-2xs overflow-hidden">
        <div class="px-6 py-5 border-b border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-2.5 h-2.5 rounded-full bg-amber-500"></div>
                <div>
                    <h2 class="text-base font-bold text-zinc-900 tracking-tight">Perlu Verifikasi Pembayaran</h2>
                    <p class="text-xs text-zinc-400 mt-0.5">Bukti transfer yang menunggu persetujuan admin</p>
                </div>
            </div>
            <a href="{{ route('admin.rentals.index') }}" class="text-xs font-semibold text-zinc-600 hover:text-zinc-900 flex items-center gap-1 transition-colors self-start sm:self-auto">
                Lihat Semua Transaksi <span class="text-zinc-400">&rarr;</span>
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[650px]">
                <thead>
                    <tr class="bg-zinc-50/60 border-b border-zinc-100 text-[10px] font-bold text-zinc-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6">ID & Waktu</th>
                        <th class="py-3.5 px-6">Penyewa</th>
                        <th class="py-3.5 px-6">Total Tagihan</th>
                        <th class="py-3.5 px-6">Status Pembayaran</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 text-xs">
                    @forelse($rentalsPaymentPending as $rental)
                    <tr class="hover:bg-zinc-50/70 transition-colors group">
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="font-mono font-bold text-zinc-900">#{{ $rental->id }}</span>
                            <div class="text-[11px] text-zinc-400 mt-0.5">{{ $rental->created_at->format('d M Y • H:i') }}</div>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-zinc-100 text-zinc-700 font-bold text-[11px] flex items-center justify-center border border-zinc-200/70 shrink-0">
                                    {{ substr($rental->user->nama ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-zinc-900 leading-tight">{{ $rental->user->nama ?? '-' }}</p>
                                    <p class="text-[11px] text-zinc-400 mt-0.5">{{ $rental->user->email ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="font-mono font-bold text-zinc-900 tabular-nums">
                                Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Menunggu Verifikasi
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <a href="{{ route('admin.rentals.show', $rental->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-zinc-900 hover:bg-zinc-800 text-white rounded-xl text-xs font-medium transition-all shadow-2xs">
                                <span>Periksa Bukti</span>
                                <span class="text-zinc-400">&rarr;</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 px-6 text-center">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200/60 flex items-center justify-center mx-auto mb-3 shadow-2xs">
                                <i class="ti ti-check text-xl"></i>
                            </div>
                            <h3 class="text-sm font-bold text-zinc-900">Semua Pembayaran Beres!</h3>
                            <p class="text-xs text-zinc-400 mt-0.5">Tidak ada transaksi yang menunggu verifikasi saat ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    function confirmResetDemo() {
        openConfirmModal({
            title: 'Reset Seluruh Data Demo?',
            message: 'Apakah Anda yakin ingin menyegarkan data website ke kondisi awal demo? Seluruh produk, kuota stok perangkat, dan simulasi transaksi akan <strong>dikembalikan ke pengaturan awal pabrikan</strong>.',
            confirmText: 'Ya, Reset Data Demo',
            isDanger: false,
            onConfirm: function() {
                const form = document.getElementById('reset-demo-form');
                if (form) form.submit();
            }
        });
    }
</script>
@endsection
