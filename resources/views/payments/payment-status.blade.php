@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    
    <div class="max-w-3xl mx-auto">
        
        <div class="bg-white rounded-3xl border border-zinc-200 p-8 sm:p-12 shadow-sm text-center">
            
            @if($payment->status_pembayaran == 'waiting for verification' || $payment->status_pembayaran == 'pending')
                <div class="w-20 h-20 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h2 class="text-3xl font-bold text-zinc-900 mb-2">Menunggu Verifikasi</h2>
                <p class="text-zinc-500 mb-8 max-w-md mx-auto">Terima kasih! Bukti pembayaran Anda telah kami terima dan sedang dalam proses pengecekan oleh tim kami.</p>
            @elseif($payment->status_pembayaran == 'paid')
                <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h2 class="text-3xl font-bold text-zinc-900 mb-2">Pembayaran Berhasil</h2>
                <p class="text-zinc-500 mb-8 max-w-md mx-auto">Terima kasih! Pembayaran Anda telah terverifikasi. Pesanan Anda akan segera kami proses.</p>
            @else
                <div class="w-20 h-20 bg-rose-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h2 class="text-3xl font-bold text-zinc-900 mb-2">Pembayaran Gagal</h2>
                <p class="text-zinc-500 mb-8 max-w-md mx-auto">Mohon maaf, terjadi kesalahan atau pembayaran ditolak. Silahkan hubungi admin untuk bantuan lebih lanjut.</p>
            @endif

            <div class="bg-zinc-50 rounded-2xl p-6 sm:p-8 text-left mb-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-4">
                    
                    <div>
                        <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-1">Booking ID</p>
                        <p class="font-bold text-zinc-900">#{{ $payment->rental->id }}</p>
                    </div>
                    
                    <div>
                        <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-1">Status</p>
                        @if($payment->status_pembayaran == 'waiting for verification')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Menunggu Verifikasi</span>
                        @elseif($payment->status_pembayaran == 'paid')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Lunas</span>
                        @elseif($payment->status_pembayaran == 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">Gagal</span>
                        @endif
                    </div>
                    
                    <div>
                        <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-1">Metode Pembayaran</p>
                        <p class="font-bold text-zinc-900">{{ strtoupper($payment->metode_pembayaran) }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-1">Total Pembayaran</p>
                        <p class="font-bold text-rose-500 text-lg">Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</p>
                    </div>

                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('rentals.list') }}" class="px-8 py-3.5 bg-zinc-900 text-white rounded-xl font-semibold hover:bg-zinc-800 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Lihat Daftar Pesanan
                </a>
                <a href="{{ route('home') }}" class="px-8 py-3.5 bg-white text-zinc-900 border-2 border-zinc-200 rounded-xl font-semibold hover:bg-zinc-50 hover:border-zinc-300 transition-all">
                    Kembali ke Beranda
                </a>
            </div>

        </div>

    </div>

</div>
@endsection