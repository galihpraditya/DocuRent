@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="mb-10">
        <h2 class="text-3xl font-bold text-zinc-900 tracking-tight">Ringkasan Pesanan</h2>
        <p class="text-zinc-500 mt-2">Periksa kembali detail pesanan Anda sebelum melanjutkan ke pembayaran.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">

        <!-- LEFT -->
        <div class="lg:w-2/3 space-y-6">

            <!-- Alamat Pengambilan -->
            <div class="bg-white rounded-3xl border border-zinc-200 p-8 shadow-sm">
                <h6 class="text-xs font-bold text-zinc-400 tracking-widest uppercase mb-6">Lokasi Pengambilan</h6>
                
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-zinc-900 text-lg mb-1">DocuRent Malang Pusat</p>
                        <p class="text-zinc-500 leading-relaxed">Jl. Ninja No 34, Kel. Ringin, Kec. Sukun<br>Kota Malang, Jawa Timur</p>
                    </div>
                </div>
            </div>

            <!-- Items -->
            <div class="bg-white rounded-3xl border border-zinc-200 p-8 shadow-sm">
                <h6 class="text-xs font-bold text-zinc-400 tracking-widest uppercase mb-6">Item Disewa</h6>

                <div class="space-y-6">
                    @foreach($cart->cartItems as $item)
                        <div class="flex items-center gap-6 p-4 rounded-2xl border border-zinc-100 hover:border-zinc-200 transition-colors bg-zinc-50/50">
                            <div class="w-24 h-24 rounded-xl bg-white overflow-hidden shrink-0 border border-zinc-200">
                                <img src="{{ asset('storage/' . $item->product->gambar) }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-grow">
                                <h6 class="font-bold text-zinc-900 text-lg mb-1">{{ $item->product->nama_produk }}</h6>
                                <p class="text-zinc-500 text-sm mb-3">Rp {{ number_format($item->product->harga_sewa, 0, ',', '.') }} / hari</p>
                                <div class="inline-flex items-center px-3 py-1 rounded-full bg-white border border-zinc-200 text-sm font-medium text-zinc-700">
                                    Jumlah: {{ $item->jumlah }}
                                </div>
                            </div>
                            <div class="text-right hidden sm:block">
                                <p class="text-zinc-900 font-bold">Rp {{ number_format($item->product->harga_sewa * $item->jumlah, 0, ',', '.') }}</p>
                                <p class="text-xs text-zinc-500">Subtotal/hari</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 pt-8 border-t border-zinc-200">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <h6 class="text-xs font-bold text-zinc-400 tracking-widest uppercase mb-2">Periode Sewa</h6>
                            <p class="font-medium text-zinc-900 bg-zinc-50 inline-block px-4 py-2 rounded-lg border border-zinc-100">
                                {{ \Carbon\Carbon::parse($tanggalSewa)->format('d M Y') }} &rarr; {{ \Carbon\Carbon::parse($tanggalKembali)->format('d M Y') }}
                            </p>
                        </div>
                        <div class="sm:text-right">
                            <h6 class="text-xs font-bold text-zinc-400 tracking-widest uppercase mb-2">Total Harga Sewa</h6>
                            <p class="text-2xl font-bold text-rose-500">Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-3xl border border-zinc-200 p-8 shadow-sm sticky top-28">
                
                <h5 class="text-xl font-bold text-zinc-900 mb-6">Detail Pembayaran</h5>

                <div class="space-y-4 mb-6 text-sm">
                    <div class="flex justify-between items-center text-zinc-600">
                        <span>Total Harga Barang</span>
                        <span class="font-medium text-zinc-900">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-zinc-600">
                        <span>Biaya Layanan</span>
                        <span class="font-medium text-green-600">Gratis</span>
                    </div>
                </div>

                <div class="pt-6 border-t border-zinc-200 border-dashed mb-8">
                    <div class="flex justify-between items-end">
                        <span class="text-zinc-900 font-bold text-lg">Total Tagihan</span>
                        <span class="text-2xl font-bold text-rose-500">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <form action="{{ route('rentals.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tanggal_sewa" value="{{ $tanggalSewa }}">
                    <input type="hidden" name="tanggal_kembali" value="{{ $tanggalKembali }}">
                    <input type="hidden" name="total_harga" value="{{ $totalHarga }}">

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-zinc-900 mb-3">Pilih Metode Pembayaran</label>
                        <div class="space-y-3">
                            <label class="flex items-center p-4 border border-zinc-200 rounded-xl cursor-pointer hover:bg-zinc-50 transition-colors [&:has(input:checked)]:border-zinc-900 [&:has(input:checked)]:bg-zinc-50/50">
                                <input type="radio" name="metode_pembayaran" value="Transfer" class="w-4 h-4 text-zinc-900 border-zinc-300 focus:ring-zinc-900" required checked>
                                <span class="ml-3 font-medium text-zinc-900 flex-grow">Transfer Bank (BCA)</span>
                                <svg class="w-6 h-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            </label>
                            
                            <label class="flex items-center p-4 border border-zinc-200 rounded-xl cursor-pointer hover:bg-zinc-50 transition-colors [&:has(input:checked)]:border-zinc-900 [&:has(input:checked)]:bg-zinc-50/50">
                                <input type="radio" name="metode_pembayaran" value="E-Wallet" class="w-4 h-4 text-zinc-900 border-zinc-300 focus:ring-zinc-900" required>
                                <span class="ml-3 font-medium text-zinc-900 flex-grow">E-Wallet (GoPay/OVO)</span>
                                <svg class="w-6 h-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </label>

                            <label class="flex items-center p-4 border border-zinc-200 rounded-xl cursor-pointer hover:bg-zinc-50 transition-colors [&:has(input:checked)]:border-zinc-900 [&:has(input:checked)]:bg-zinc-50/50">
                                <input type="radio" name="metode_pembayaran" value="QRIS" class="w-4 h-4 text-zinc-900 border-zinc-300 focus:ring-zinc-900" required>
                                <span class="ml-3 font-medium text-zinc-900 flex-grow">QRIS</span>
                                <svg class="w-6 h-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-zinc-900 text-white rounded-xl py-4 font-semibold hover:bg-zinc-800 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex justify-center items-center">
                        Proses Pembayaran
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                    
                    <p class="text-xs text-center text-zinc-500 mt-4">Dengan menekan tombol ini, Anda menyetujui Syarat & Ketentuan yang berlaku.</p>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
