@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
    
    <!-- Back Button & Breadcrumb -->
    <div class="flex items-center justify-between mb-8">
        <nav class="flex items-center space-x-2 text-xs font-medium text-zinc-400">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('cart.index') }}" class="hover:text-zinc-900 transition-colors">Keranjang</a>
            <span>/</span>
            <span class="text-zinc-900">Konfirmasi Pesanan</span>
        </nav>

        <a href="{{ route('cart.index') }}" class="inline-flex items-center text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors">
            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Ubah Keranjang
        </a>
    </div>

    <!-- Stepper Indicator -->
    <div class="max-w-xl mx-auto mb-12">
        <div class="flex items-center justify-between text-xs font-medium text-zinc-400">
            <div class="flex items-center text-zinc-900">
                <span class="w-5 h-5 rounded-full bg-zinc-900 text-white flex items-center justify-center text-[10px] mr-2">1</span>
                <span>Keranjang</span>
            </div>
            <div class="flex-1 h-[1px] bg-zinc-300 mx-4"></div>
            <div class="flex items-center text-zinc-900 font-semibold">
                <span class="w-5 h-5 rounded-full bg-zinc-900 text-white flex items-center justify-center text-[10px] mr-2">2</span>
                <span>Konfirmasi</span>
            </div>
            <div class="flex-1 h-[1px] bg-zinc-200 mx-4"></div>
            <div class="flex items-center text-zinc-400">
                <span class="w-5 h-5 rounded-full bg-zinc-100 border border-zinc-200 text-zinc-400 flex items-center justify-center text-[10px] mr-2">3</span>
                <span>Pembayaran</span>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-zinc-900 tracking-tight">Konfirmasi Sewa Gear</h1>
        <p class="text-zinc-500 text-xs sm:text-sm mt-1">Periksa kembali detail durasi dan rincian peralatan sebelum melanjutkan.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-10 items-start">

        <!-- Left Column: Details -->
        <div class="lg:w-2/3 w-full space-y-6">

            <!-- Lokasi Pengambilan -->
            <div class="bg-white rounded-3xl border border-zinc-200/80 p-6 sm:p-7 shadow-2xs">
                <span class="text-[10px] font-bold text-zinc-400 tracking-wider uppercase mb-3 block">Lokasi & Pengambilan Unit</span>
                
                <div class="flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-zinc-100 flex items-center justify-center shrink-0 text-zinc-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-zinc-900 text-sm">Studio DocuRent Malang Pusat</p>
                        <p class="text-xs text-zinc-500 leading-relaxed mt-0.5">
                            Jl. Ninja No 34, Kel. Ringin, Kec. Sukun, Kota Malang, Jawa Timur<br>
                            <span class="text-zinc-400">Jam Operasional: 08.00 – 20.00 WIB</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Items Disewa -->
            <div class="bg-white rounded-3xl border border-zinc-200/80 p-6 sm:p-7 shadow-2xs">
                <div class="flex items-center justify-between mb-5">
                    <span class="text-[10px] font-bold text-zinc-400 tracking-wider uppercase">Daftar Peralatan</span>
                    <span class="text-xs font-semibold text-zinc-600">{{ $cart->cartItems->count() }} jenis gear</span>
                </div>

                <div class="divide-y divide-zinc-100">
                    @foreach($cart->cartItems as $item)
                        <div class="py-4 flex items-center gap-4 first:pt-0 last:pb-0">
                            <div class="w-16 h-16 rounded-xl bg-zinc-50 overflow-hidden shrink-0 border border-zinc-200/70">
                                <img src="{{ asset('storage/' . $item->product->gambar) }}" alt="{{ $item->product->nama_produk }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-semibold text-zinc-900 text-sm">{{ $item->product->nama_produk }}</h4>
                                <p class="text-xs text-zinc-500 mt-0.5">Rp {{ number_format($item->product->harga_sewa, 0, ',', '.') }} / hari &times; {{ $item->jumlah }} unit</p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm font-bold text-zinc-900">
                                    Rp {{ number_format($item->product->harga_sewa * $item->jumlah, 0, ',', '.') }}
                                </span>
                                <span class="block text-[10px] text-zinc-400 font-normal">/ hari</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Periode Sewa Badge Box -->
                <div class="mt-6 pt-6 border-t border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-zinc-50/70 -mx-6 sm:-mx-7 -mb-6 sm:-mb-7 p-6 rounded-b-3xl">
                    <div>
                        <span class="text-[10px] font-bold text-zinc-400 tracking-wider uppercase block mb-1">Periode Sewa</span>
                        <div class="flex items-center text-xs font-semibold text-zinc-900">
                            <span>{{ \Carbon\Carbon::parse($tanggalSewa)->translatedFormat('d M Y') }}</span>
                            <span class="mx-2 text-zinc-400">&rarr;</span>
                            <span>{{ \Carbon\Carbon::parse($tanggalKembali)->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="sm:text-right">
                        <span class="text-[10px] font-bold text-zinc-400 tracking-wider uppercase block mb-1">Total Biaya Sewa</span>
                        <span class="text-lg font-bold text-zinc-900">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Payment Method & Submit -->
        <div class="lg:w-1/3 w-full">
            <div class="bg-white rounded-3xl border border-zinc-200/80 p-7 shadow-2xs sticky top-28">
                
                <h3 class="text-base font-bold text-zinc-900 mb-5 pb-3 border-b border-zinc-100">Rincian Pembayaran</h3>

                <div class="space-y-3 mb-6 text-xs text-zinc-500">
                    <div class="flex justify-between items-center">
                        <span>Biaya Sewa Alat</span>
                        <span class="font-medium text-zinc-900">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span>Biaya Layanan & Admin</span>
                        <span class="font-medium text-emerald-600">Gratis (Rp 0)</span>
                    </div>
                    <div class="pt-3 border-t border-zinc-100 flex justify-between items-baseline">
                        <span class="text-sm font-bold text-zinc-900">Total Tagihan</span>
                        <span class="text-xl font-bold text-zinc-900">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <form action="{{ route('rentals.store') }}" method="POST" hx-boost="false">
                    @csrf
                    <input type="hidden" name="tanggal_sewa" value="{{ $tanggalSewa }}">
                    <input type="hidden" name="tanggal_kembali" value="{{ $tanggalKembali }}">
                    <input type="hidden" name="total_harga" value="{{ $totalHarga }}">

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-zinc-900 uppercase tracking-wider mb-2.5">Metode Pembayaran</label>
                        <div class="space-y-2">
                            <label class="flex items-center p-3.5 border border-zinc-200 rounded-xl cursor-pointer hover:bg-zinc-50 transition-colors [&:has(input:checked)]:border-zinc-900 [&:has(input:checked)]:bg-zinc-50">
                                <input type="radio" name="metode_pembayaran" value="Transfer" class="w-4 h-4 text-zinc-900 border-zinc-300 focus:ring-zinc-900" required checked>
                                <span class="ml-3 text-xs font-medium text-zinc-900 flex-grow">Transfer Bank BCA</span>
                                <span class="text-[10px] font-bold text-zinc-400 bg-zinc-100 px-1.5 py-0.5 rounded">BCA</span>
                            </label>
                            
                            <label class="flex items-center p-3.5 border border-zinc-200 rounded-xl cursor-pointer hover:bg-zinc-50 transition-colors [&:has(input:checked)]:border-zinc-900 [&:has(input:checked)]:bg-zinc-50">
                                <input type="radio" name="metode_pembayaran" value="E-Wallet" class="w-4 h-4 text-zinc-900 border-zinc-300 focus:ring-zinc-900" required>
                                <span class="ml-3 text-xs font-medium text-zinc-900 flex-grow">E-Wallet (GoPay/OVO/Dana)</span>
                                <span class="text-[10px] font-bold text-zinc-400 bg-zinc-100 px-1.5 py-0.5 rounded">E-PAY</span>
                            </label>

                            <label class="flex items-center p-3.5 border border-zinc-200 rounded-xl cursor-pointer hover:bg-zinc-50 transition-colors [&:has(input:checked)]:border-zinc-900 [&:has(input:checked)]:bg-zinc-50">
                                <input type="radio" name="metode_pembayaran" value="QRIS" class="w-4 h-4 text-zinc-900 border-zinc-300 focus:ring-zinc-900" required>
                                <span class="ml-3 text-xs font-medium text-zinc-900 flex-grow">QRIS All Payment</span>
                                <span class="text-[10px] font-bold text-zinc-400 bg-zinc-100 px-1.5 py-0.5 rounded">QRIS</span>
                            </label>
                        </div>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-zinc-900 text-white rounded-xl py-3.5 text-xs font-semibold hover:bg-zinc-800 transition-colors shadow-2xs flex justify-center items-center cursor-pointer"
                    >
                        Konfirmasi & Lanjut Bayar
                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    
                    <p class="text-[11px] text-center text-zinc-400 mt-3.5 leading-relaxed">
                        Dengan menekan tombol, Anda menyetujui kebijakan dan syarat sewa DocuRent.
                    </p>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
