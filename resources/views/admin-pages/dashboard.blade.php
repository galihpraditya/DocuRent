@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Ikhtisar Dashboard')
@section('header_subtitle', 'Selamat datang kembali, pantau kinerja penyewaan hari ini.')

@section('content')
<!-- STATS CARDS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 border border-zinc-200 shadow-sm relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-rose-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-zinc-500 mb-1">Total Produk</p>
                <h3 class="text-3xl font-black text-zinc-900 tracking-tight">{{ $totalProduk }} <span class="text-lg font-medium text-zinc-400">Unit</span></h3>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center shadow-inner">
                <i class="ti ti-camera text-3xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-zinc-200 shadow-sm relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-zinc-500 mb-1">Pelanggan Aktif</p>
                <h3 class="text-3xl font-black text-zinc-900 tracking-tight">{{ $totalPelangganAktif }} <span class="text-lg font-medium text-zinc-400">Orang</span></h3>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center shadow-inner">
                <i class="ti ti-users text-3xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-zinc-900 rounded-2xl p-6 shadow-lg relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/10 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-zinc-400 mb-1">Menunggu Verifikasi</p>
                <h3 class="text-3xl font-black text-white tracking-tight">{{ $rentalsPaymentPending->count() }} <span class="text-lg font-medium text-zinc-500">Trx</span></h3>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-white/20 text-white flex items-center justify-center backdrop-blur-md">
                <i class="ti ti-clock-hour-4 text-3xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- LATEST TRANSACTIONS -->
<div class="bg-white rounded-2xl border border-zinc-200 shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-zinc-100 flex items-center justify-between">
        <h2 class="text-lg font-bold text-zinc-900">Perlu Verifikasi Pembayaran</h2>
        <a href="{{ route('admin.rentals.index') }}" class="text-sm font-semibold text-rose-600 hover:text-rose-700">Lihat Semua &rarr;</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[600px]">
            <thead>
                <tr class="bg-zinc-50/50">
                    <th class="py-4 px-6 text-xs font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-100">ID TRX</th>
                    <th class="py-4 px-6 text-xs font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-100">Pelanggan</th>
                    <th class="py-4 px-6 text-xs font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-100">Total Harga</th>
                    <th class="py-4 px-6 text-xs font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-100">Status Pembayaran</th>
                    <th class="py-4 px-6 text-xs font-bold text-zinc-400 uppercase tracking-wider border-b border-zinc-100 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100">
                @forelse($rentalsPaymentPending as $rental)
                <tr class="hover:bg-zinc-50 transition-colors group">
                    <td class="py-4 px-6 font-semibold text-zinc-900 whitespace-nowrap">
                        #{{ $rental->id }}
                        <div class="text-xs font-medium text-zinc-400 mt-0.5">{{ $rental->created_at->format('d M Y') }}</div>
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        <div class="font-semibold text-zinc-900">{{ $rental->user->nama }}</div>
                        <div class="text-sm text-zinc-500">{{ $rental->user->email }}</div>
                    </td>
                    <td class="py-4 px-6 font-bold text-zinc-900 whitespace-nowrap">
                        Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-2 animate-pulse"></span>
                            {{ $rental->payment->status_pembayaran ?? '-' }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-right whitespace-nowrap">
                        <a href="{{ route('admin.rentals.show', $rental->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-zinc-200 rounded-xl text-sm font-semibold text-zinc-700 hover:text-rose-600 hover:border-rose-200 hover:bg-rose-50 transition-all shadow-sm group-hover:shadow">
                            Periksa
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 px-6 text-center">
                        <div class="w-16 h-16 rounded-full bg-zinc-50 flex items-center justify-center mx-auto mb-3">
                            <i class="ti ti-check text-2xl text-zinc-400"></i>
                        </div>
                        <h3 class="text-sm font-bold text-zinc-900 mb-1">Semua Selesai!</h3>
                        <p class="text-sm text-zinc-500">Tidak ada transaksi yang menunggu verifikasi saat ini.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
