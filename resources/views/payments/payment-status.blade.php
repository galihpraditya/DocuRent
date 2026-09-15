@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
    
    <div class="max-w-2xl mx-auto">
        
        <div class="bg-white rounded-3xl border border-zinc-200/80 p-8 sm:p-12 shadow-2xs text-center">
            
            @if($payment->status_pembayaran == 'waiting for verification' || $payment->status_pembayaran == 'pending')
                <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-5 text-amber-600 border border-amber-100">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-zinc-900 tracking-tight mb-2">Menunggu Verifikasi</h1>
                <p class="text-zinc-500 text-xs sm:text-sm mb-8 max-w-md mx-auto leading-relaxed">
                    Bukti pembayaran Anda telah kami terima. Tim admin DocuRent sedang memverifikasi transaksi Anda.
                </p>
            @elseif($payment->status_pembayaran == 'paid')
                <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-5 text-emerald-600 border border-emerald-100">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-zinc-900 tracking-tight mb-2">Pembayaran Berhasil</h1>
                <p class="text-zinc-500 text-xs sm:text-sm mb-8 max-w-md mx-auto leading-relaxed">
                    Pembayaran Anda telah terverifikasi lunas. Peralatan siap diambil sesuai jadwal sewa Anda.
                </p>
            @else
                <div class="w-16 h-16 bg-rose-50 rounded-full flex items-center justify-center mx-auto mb-5 text-rose-600 border border-rose-100">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-zinc-900 tracking-tight mb-2">Verifikasi Gagal</h1>
                <p class="text-zinc-500 text-xs sm:text-sm mb-8 max-w-md mx-auto leading-relaxed">
                    Bukti pembayaran tidak dapat diverifikasi atau pesanan ditolak. Silakan hubungi admin kami.
                </p>
            @endif

            <!-- Rincian Transaksi -->
            <div class="bg-zinc-50/70 rounded-2xl p-6 sm:p-7 text-left mb-8 border border-zinc-100">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-xs">
                    <div>
                        <span class="text-zinc-400 block mb-0.5">Nomor Booking</span>
                        <span class="font-mono font-bold text-zinc-900 text-sm">#{{ $payment->rental->id }}</span>
                    </div>
                    
                    <div>
                        <span class="text-zinc-400 block mb-0.5">Status Pembayaran</span>
                        @if($payment->status_pembayaran == 'waiting for verification')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-800 border border-amber-200">Menunggu Verifikasi</span>
                        @elseif($payment->status_pembayaran == 'paid')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-800 border border-emerald-200">Lunas Terverifikasi</span>
                        @elseif($payment->status_pembayaran == 'pending')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-800 border border-amber-200">Pending</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-rose-50 text-rose-800 border border-rose-200">Ditolak</span>
                        @endif
                    </div>
                    
                    <div>
                        <span class="text-zinc-400 block mb-0.5">Metode Bayar</span>
                        <span class="font-semibold text-zinc-900">{{ strtoupper($payment->metode_pembayaran) }}</span>
                    </div>

                    <div>
                        <span class="text-zinc-400 block mb-0.5">Total Bayar</span>
                        <span class="font-bold text-zinc-900 text-sm">Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('rentals.list') }}" class="px-6 py-3 bg-zinc-900 text-white rounded-xl text-xs font-semibold hover:bg-zinc-800 transition-colors shadow-2xs">
                    Lihat Riwayat Pesanan
                </a>
                <a href="{{ route('home') }}" class="px-6 py-3 bg-white text-zinc-800 border border-zinc-200 rounded-xl text-xs font-semibold hover:bg-zinc-50 transition-colors">
                    Kembali ke Beranda
                </a>
            </div>

        </div>

    </div>

</div>
@endsection