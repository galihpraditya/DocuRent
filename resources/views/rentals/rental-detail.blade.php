@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-8">
            <a href="{{ route('rentals.list') }}" class="inline-flex items-center text-sm font-semibold text-zinc-500 hover:text-zinc-900 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Pesanan
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-zinc-200 overflow-hidden shadow-sm">
            
            <!-- Header -->
            <div class="p-8 border-b border-zinc-100 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-zinc-50/50">
                <div>
                    <h2 class="text-2xl font-bold text-zinc-900 tracking-tight mb-1">Detail Pesanan</h2>
                    <p class="text-zinc-500 text-sm">No. Invoice: <span class="font-bold text-zinc-900">INV-RNT-{{ $rental->id }}</span></p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    @if($rental->payment->status_pembayaran == 'paid')
                        <div class="inline-flex items-center px-4 py-2 rounded-xl bg-green-100 border border-green-200">
                            <span class="w-2 h-2 rounded-full bg-green-600 mr-2"></span>
                            <span class="text-sm font-bold text-green-800">Pembayaran Lunas</span>
                        </div>
                    @else
                        <div class="inline-flex items-center px-4 py-2 rounded-xl bg-amber-100 border border-amber-200">
                            <span class="w-2 h-2 rounded-full bg-amber-600 mr-2 animate-pulse"></span>
                            <span class="text-sm font-bold text-amber-800">Menunggu Verifikasi</span>
                        </div>
                    @endif

                    <div class="inline-flex items-center px-4 py-2 rounded-xl bg-blue-100 border border-blue-200">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                        <span class="text-sm font-bold text-blue-800">{{ ucfirst($rental->status) }}</span>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="p-8">
                
                <!-- Dates -->
                <div class="bg-zinc-900 rounded-2xl p-6 mb-10 text-white flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl"></div>
                    <div class="text-center md:text-left z-10 w-full md:w-auto">
                        <p class="text-xs text-zinc-400 font-semibold tracking-wider uppercase mb-1">Tanggal Pengambilan</p>
                        <p class="text-xl font-bold">{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }}</p>
                    </div>
                    <div class="z-10 hidden md:block">
                        <svg class="w-8 h-8 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                    <div class="text-center md:text-right z-10 w-full md:w-auto">
                        <p class="text-xs text-zinc-400 font-semibold tracking-wider uppercase mb-1">Tanggal Pengembalian</p>
                        <p class="text-xl font-bold">{{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}</p>
                    </div>
                </div>

                <!-- Items -->
                <h3 class="text-lg font-bold text-zinc-900 mb-6">Item Disewa</h3>
                <div class="space-y-4 mb-10">
                    @foreach($rental->rentalItems as $item)
                        @php
                            $subtotal = $item->harga_saat_sewa * $item->jumlah;
                        @endphp
                        <div class="flex items-center gap-4 p-4 rounded-2xl border border-zinc-100 bg-zinc-50 hover:bg-white hover:border-zinc-200 transition-colors">
                            <div class="w-16 h-16 rounded-xl bg-white border border-zinc-200 overflow-hidden shrink-0">
                                <img src="{{ asset('storage/' . $item->product->gambar) }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-grow">
                                <h6 class="font-bold text-zinc-900">{{ $item->product->nama_produk }}</h6>
                                <p class="text-sm text-zinc-500">{{ $item->jumlah }} x Rp {{ number_format($item->harga_saat_sewa, 0, ',', '.') }} / hari</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-zinc-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Payment Details -->
                <h3 class="text-lg font-bold text-zinc-900 mb-6">Rincian Pembayaran</h3>
                <div class="bg-zinc-50 rounded-2xl p-6 border border-zinc-100 mb-8">
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-zinc-500">Durasi Sewa</span>
                            <span class="font-medium text-zinc-900">{{ $hari ?? 1 }} Hari</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-zinc-500">Metode Pembayaran</span>
                            <span class="font-bold text-zinc-900 uppercase">{{ $rental->payment->metode_pembayaran }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-zinc-500">Total Harga Sewa</span>
                            <span class="font-medium text-zinc-900">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="pt-6 border-t border-zinc-200 border-dashed flex justify-between items-end">
                        <span class="font-bold text-zinc-900 text-lg">Total Tagihan</span>
                        <span class="text-2xl font-bold text-rose-500">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($rental->payment->bukti_pembayaran)
                    <div class="flex justify-end">
                        <a href="{{ asset('storage/' . $rental->payment->bukti_pembayaran) }}" target="_blank" class="inline-flex items-center px-6 py-2.5 bg-white border border-zinc-200 rounded-xl text-sm font-semibold text-zinc-900 hover:bg-zinc-50 transition-colors shadow-sm">
                            <svg class="w-4 h-4 mr-2 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            Lihat Bukti Pembayaran
                        </a>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection
