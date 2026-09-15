@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
    
    <div class="max-w-3xl mx-auto">
        
        <div class="mb-8 flex items-center justify-between">
            <nav class="flex items-center space-x-2 text-xs font-medium text-zinc-400">
                <a href="{{ route('home') }}" class="hover:text-zinc-900 transition-colors">Beranda</a>
                <span>/</span>
                <a href="{{ route('rentals.list') }}" class="hover:text-zinc-900 transition-colors">Pesanan</a>
                <span>/</span>
                <span class="text-zinc-900">#{{ $rental->id }}</span>
            </nav>

            <a href="{{ route('rentals.list') }}" class="inline-flex items-center text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-zinc-200/80 overflow-hidden shadow-2xs">
            
            <!-- Header -->
            <div class="p-6 sm:p-8 border-b border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-zinc-50/50">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-zinc-900 tracking-tight">Rincian Sewa #{{ $rental->id }}</h1>
                    <p class="text-zinc-400 text-xs mt-0.5">Dibuat pada {{ \Carbon\Carbon::parse($rental->created_at)->translatedFormat('d M Y, H:i') }} WIB</p>
                </div>
                
                <div class="flex items-center gap-2">
                    @if($rental->payment && $rental->payment->status_pembayaran == 'paid')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-800 border border-emerald-200/80">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                            Pembayaran Lunas
                        </span>
                    @elseif($rental->payment && $rental->payment->status_pembayaran == 'waiting for verification')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-800 border border-amber-200/80">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                            Verifikasi Pembayaran
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-zinc-100 text-zinc-700 border border-zinc-200/80">
                            {{ ucfirst($rental->status) }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Body -->
            <div class="p-6 sm:p-8 space-y-8">
                
                <!-- Dates Card (Clean Minimalist Studio) -->
                <div class="bg-zinc-50 rounded-2xl p-5 sm:p-6 border border-zinc-200/70 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <span class="text-[10px] text-zinc-400 font-bold uppercase tracking-wider block mb-1">Tanggal Ambil</span>
                        <p class="text-sm font-bold text-zinc-900">{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->translatedFormat('l, d F Y') }}</p>
                        <span class="text-[11px] text-zinc-400">Pukul 08.00 – 20.00 WIB</span>
                    </div>

                    <div class="hidden sm:block text-zinc-300">
                        &rarr;
                    </div>

                    <div class="sm:text-right">
                        <span class="text-[10px] text-zinc-400 font-bold uppercase tracking-wider block mb-1">Tanggal Kembali</span>
                        <p class="text-sm font-bold text-zinc-900">{{ \Carbon\Carbon::parse($rental->tanggal_kembali)->translatedFormat('l, d F Y') }}</p>
                        <span class="text-[11px] text-zinc-400">Sebelum pukul 20.00 WIB</span>
                    </div>
                </div>

                <!-- Items Disewa -->
                <div>
                    <h3 class="text-xs font-bold text-zinc-900 uppercase tracking-wider mb-4">Peralatan yang Disewa</h3>
                    <div class="divide-y divide-zinc-100 border-t border-b border-zinc-100">
                        @foreach($rental->rentalItems as $item)
                            @php
                                $subtotal = $item->harga_saat_sewa * $item->jumlah;
                            @endphp
                            <div class="py-4 flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-zinc-50 border border-zinc-200/70 overflow-hidden shrink-0">
                                    @if($item->product && $item->product->gambar)
                                        <img src="{{ asset('storage/' . $item->product->gambar) }}" alt="{{ $item->product->nama_produk }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-zinc-100 text-zinc-400 text-xs">Gear</div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <h4 class="font-semibold text-zinc-900 text-sm">{{ $item->product->nama_produk ?? 'Alat Dokumentasi' }}</h4>
                                    <p class="text-xs text-zinc-400 mt-0.5">{{ $item->jumlah }} unit &times; Rp {{ number_format($item->harga_saat_sewa, 0, ',', '.') }} / hari</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-bold text-zinc-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                    <span class="block text-[10px] text-zinc-400 font-normal">/ hari</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="bg-zinc-50/70 rounded-2xl p-6 border border-zinc-200/70 space-y-3 text-xs">
                    <h4 class="text-xs font-bold text-zinc-900 uppercase tracking-wider mb-3">Rincian Transaksi</h4>
                    
                    <div class="flex justify-between items-center text-zinc-500">
                        <span>Metode Pembayaran</span>
                        <span class="font-medium text-zinc-900">{{ strtoupper($rental->payment->metode_pembayaran ?? 'TRANSFER') }}</span>
                    </div>

                    <div class="flex justify-between items-center text-zinc-500">
                        <span>Status Verifikasi</span>
                        <span class="font-medium text-zinc-900 capitalize">{{ $rental->payment->status_pembayaran ?? '-' }}</span>
                    </div>

                    <div class="pt-3 border-t border-zinc-200 flex justify-between items-baseline">
                        <span class="text-sm font-bold text-zinc-900">Total Biaya Sewa</span>
                        <span class="text-xl font-bold text-zinc-900">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Actions: View Payment Proof or Upload -->
                <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                    <div class="text-xs text-zinc-400">
                        Lokasi: Studio DocuRent Malang Pusat
                    </div>

                    <div class="flex items-center gap-2">
                        @if($rental->payment && $rental->payment->bukti_pembayaran)
                            <a href="{{ asset('storage/' . $rental->payment->bukti_pembayaran) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white border border-zinc-200 rounded-xl text-xs font-semibold text-zinc-700 hover:bg-zinc-50 transition-colors shadow-2xs">
                                <svg class="w-3.5 h-3.5 mr-1.5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Lihat Bukti Transfer
                            </a>
                        @endif

                        @if($rental->status == 'pending' && $rental->payment && $rental->payment->status_pembayaran == 'pending')
                            <a href="{{ route('payments.paymentPage', $rental->payment->id) }}" class="inline-flex items-center px-4 py-2 bg-zinc-900 text-white rounded-xl text-xs font-semibold hover:bg-zinc-800 transition-colors shadow-2xs">
                                Unggah Bukti Bayar
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
