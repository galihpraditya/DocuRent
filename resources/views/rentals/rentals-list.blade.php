@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
    
    <div class="max-w-4xl mx-auto">
        
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Aktivitas Rental</span>
                <h1 class="text-2xl sm:text-3xl font-bold text-zinc-900 tracking-tight mt-1">Pesanan Saya</h1>
                <p class="text-zinc-500 text-xs sm:text-sm mt-1">Pantau status verifikasi pembayaran dan jadwal pengembalian alat Anda.</p>
            </div>
            <a href="{{ route('home') }}#catalog" class="px-5 py-2.5 rounded-full bg-zinc-900 text-white text-xs font-semibold hover:bg-zinc-800 transition-colors shadow-2xs self-start sm:self-auto">
                + Sewa Gear Baru
            </a>
        </div>

        <!-- Filter Navigation Pills -->
        <div class="flex overflow-x-auto no-scrollbar gap-2 mb-8 pb-1">
            <a href="{{ route('rentals.list') }}" class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium transition-all {{ !request()->segment(3) ? 'bg-zinc-900 text-white shadow-2xs' : 'bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50' }}">
                Semua Pesanan
            </a>
            <a href="{{ route('rentals.filter', 'pending') }}" class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium transition-all {{ request()->segment(3) == 'pending' ? 'bg-zinc-900 text-white shadow-2xs' : 'bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50' }}">
                Menunggu
            </a>
            <a href="{{ route('rentals.filter', 'ongoing') }}" class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium transition-all {{ request()->segment(3) == 'ongoing' ? 'bg-zinc-900 text-white shadow-2xs' : 'bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50' }}">
                Sedang Disewa
            </a>
            <a href="{{ route('rentals.filter', 'completed') }}" class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium transition-all {{ request()->segment(3) == 'completed' ? 'bg-zinc-900 text-white shadow-2xs' : 'bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50' }}">
                Selesai
            </a>
            <a href="{{ route('rentals.filter', 'cancelled') }}" class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium transition-all {{ (request()->segment(3) == 'canceled' || request()->segment(3) == 'cancelled') ? 'bg-zinc-900 text-white shadow-2xs' : 'bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50' }}">
                Dibatalkan
            </a>
        </div>

        <!-- Order Cards List -->
        <div class="space-y-5">
            @forelse($rentals as $rental)
                <div class="bg-white rounded-3xl border border-zinc-200/80 overflow-hidden hover:border-zinc-300 shadow-2xs transition-all">
                    
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-zinc-100 bg-zinc-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white border border-zinc-200 flex items-center justify-center text-zinc-700 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-xs text-zinc-900">Booking #{{ $rental->id }}</h3>
                                <p class="text-[11px] text-zinc-400">{{ \Carbon\Carbon::parse($rental->created_at)->translatedFormat('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>

                        <div>
                            @if($rental->status == 'pending')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium bg-amber-50 text-amber-800 border border-amber-200/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                                    Menunggu Verifikasi
                                </span>
                            @elseif($rental->status == 'ongoing')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium bg-blue-50 text-blue-800 border border-blue-200/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-1.5"></span>
                                    Sedang Disewa
                                </span>
                            @elseif($rental->status == 'completed')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-800 border border-emerald-200/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium bg-rose-50 text-rose-800 border border-rose-200/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                    Dibatalkan
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Body: Items Preview & Period -->
                    <div class="p-6">
                        <!-- Items Preview List -->
                        @if($rental->rentalItems && $rental->rentalItems->count() > 0)
                            <div class="space-y-3 mb-5">
                                @foreach($rental->rentalItems as $item)
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-12 h-12 rounded-xl bg-zinc-50 border border-zinc-200/70 overflow-hidden shrink-0">
                                            @if($item->product && $item->product->gambar)
                                                <img src="{{ asset('storage/' . $item->product->gambar) }}" alt="{{ $item->product->nama_produk }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-zinc-100 text-zinc-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow">
                                            <h4 class="font-semibold text-zinc-900 text-xs">{{ $item->product->nama_produk ?? 'Alat Dokumentasi' }}</h4>
                                            <p class="text-[11px] text-zinc-400">{{ $item->jumlah }} unit &bull; Rp {{ number_format($item->harga_saat_sewa, 0, ',', '.') }} / hari</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="pt-4 border-t border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block mb-1">Jadwal Sewa</span>
                                <div class="flex items-center text-xs font-medium text-zinc-800">
                                    <span>{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->translatedFormat('d M') }}</span>
                                    <span class="mx-2 text-zinc-400">&rarr;</span>
                                    <span>{{ \Carbon\Carbon::parse($rental->tanggal_kembali)->translatedFormat('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="sm:text-right">
                                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block mb-0.5">Total Biaya</span>
                                <span class="text-base font-bold text-zinc-900">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="px-6 py-3.5 bg-zinc-50/70 border-t border-zinc-100 flex justify-end gap-2">
                        @if($rental->status == 'pending' && $rental->payment && $rental->payment->status_pembayaran == 'pending')
                            <a href="{{ route('payments.paymentPage', $rental->payment->id) }}" class="px-4 py-2 bg-zinc-900 text-white rounded-xl text-xs font-semibold hover:bg-zinc-800 transition-colors shadow-2xs">
                                Upload Bukti Pembayaran
                            </a>
                        @endif
                        <a href="{{ route('rentals.show', $rental->id) }}" class="px-4 py-2 bg-white border border-zinc-200 text-zinc-700 rounded-xl text-xs font-semibold hover:bg-zinc-50 transition-colors">
                            Rincian Lengkap &rarr;
                        </a>
                    </div>

                </div>
            @empty
                <div class="bg-white rounded-3xl border border-zinc-200/80 border-dashed p-16 text-center">
                    <div class="w-14 h-14 bg-zinc-50 rounded-full flex items-center justify-center mx-auto mb-4 text-zinc-400 border border-zinc-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <h3 class="text-sm font-bold text-zinc-900 mb-1">Belum Ada Riwayat Pesanan</h3>
                    <p class="text-zinc-500 text-xs max-w-sm mx-auto mb-6">Anda belum pernah melakukan penyewaan alat di DocuRent.</p>
                    <a href="{{ route('home') }}#catalog" class="px-5 py-2.5 rounded-full bg-zinc-900 text-white text-xs font-semibold hover:bg-zinc-800 transition-colors shadow-2xs">
                        Lihat Katalog Peralatan
                    </a>
                </div>
            @endforelse
        </div>

    </div>

</div>
@endsection