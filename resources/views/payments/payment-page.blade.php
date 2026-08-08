@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-bold text-zinc-900 tracking-tight">Selesaikan Pembayaran</h2>
        <p class="text-zinc-500 mt-2">Segera lakukan pembayaran untuk mengamankan pesanan Anda.</p>
    </div>

    <form action="{{ route('payments.upload-proof', $payment->id) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto">
        @csrf

        <div class="flex flex-col md:flex-row gap-8">
            
            <!-- LEFT -->
            <div class="md:w-1/2">
                <div class="bg-white rounded-3xl border border-zinc-200 p-8 shadow-sm h-full">
                    
                    <h4 class="font-bold text-xl text-zinc-900 mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-full bg-zinc-900 text-white flex items-center justify-center text-sm mr-3">1</span>
                        Instruksi Pembayaran
                    </h4>

                    <div class="bg-zinc-50 rounded-2xl p-6 border border-zinc-100 mb-8">
                        <h6 class="text-xs font-bold text-zinc-400 tracking-widest uppercase mb-4">Tujuan Pembayaran</h6>
                        
                        @if($payment->metode_pembayaran == 'Transfer')
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                                    <span class="font-bold text-blue-800 text-sm">BCA</span>
                                </div>
                                <div>
                                    <p class="text-zinc-500 text-sm mb-1">Bank Central Asia</p>
                                    <p class="font-bold text-xl text-zinc-900 tracking-wider">123 456 7890</p>
                                    <p class="text-sm font-medium text-zinc-600 mt-1">a.n DocuRent Malang</p>
                                </div>
                            </div>
                        @elseif($payment->metode_pembayaran == 'E-Wallet')
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shrink-0 shadow-sm">
                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-zinc-500 text-sm mb-1">GoPay / OVO / Dana</p>
                                    <p class="font-bold text-xl text-zinc-900 tracking-wider">0812 3456 7890</p>
                                    <p class="text-sm font-medium text-zinc-600 mt-1">a.n DocuRent Malang</p>
                                </div>
                            </div>
                        @elseif($payment->metode_pembayaran == 'QRIS')
                            <div class="flex flex-col items-center">
                                <p class="text-zinc-500 text-sm mb-4">Scan kode QRIS di bawah ini dengan aplikasi m-Banking atau e-Wallet Anda</p>
                                <div class="p-4 bg-white rounded-2xl shadow-sm inline-block border border-zinc-200">
                                    <img src="{{ asset('images/qris.jpg') }}" alt="QRIS DocuRent" class="w-48 h-48 object-cover rounded-xl" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg'">
                                </div>
                            </div>
                        @endif
                    </div>

                    <h4 class="font-bold text-xl text-zinc-900 mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-full bg-zinc-900 text-white flex items-center justify-center text-sm mr-3">2</span>
                        Upload Bukti
                    </h4>
                    
                    <div class="mb-4">
                        <p class="text-sm text-zinc-500 mb-4">Setelah melakukan pembayaran, mohon upload foto atau screenshot bukti transfer agar dapat kami verifikasi.</p>
                        
                        <div class="relative group">
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/jpeg, image/png, image/jpg">
                            <div class="bg-zinc-50 border-2 border-dashed border-zinc-300 rounded-2xl p-8 text-center group-hover:border-zinc-500 group-hover:bg-zinc-100 transition-colors">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm text-zinc-400 group-hover:text-zinc-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-sm font-semibold text-zinc-900 mb-1">Pilih File Bukti Pembayaran</p>
                                <p class="text-xs text-zinc-500">Maks. 2MB (JPG, JPEG, PNG)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="md:w-1/2">
                <div class="bg-white rounded-3xl border border-zinc-200 p-8 shadow-sm h-full flex flex-col">
                    
                    <h5 class="text-xl font-bold text-zinc-900 mb-8">Ringkasan Pembayaran</h5>

                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between items-center pb-4 border-b border-zinc-100">
                            <span class="text-zinc-500 text-sm">Booking ID</span>
                            <span class="font-medium text-zinc-900">#{{ $payment->rental_id }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-4 border-b border-zinc-100">
                            <span class="text-zinc-500 text-sm">Metode Pembayaran</span>
                            <span class="font-medium text-zinc-900">{{ $payment->metode_pembayaran }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-4 border-b border-zinc-100">
                            <span class="text-zinc-500 text-sm">Total Belanja</span>
                            <span class="font-medium text-zinc-900">Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="p-6 bg-zinc-900 rounded-2xl mb-8 mt-auto">
                        <p class="text-zinc-400 text-sm mb-1">Total yang harus dibayar</p>
                        <p class="text-3xl font-bold text-white">Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</p>
                    </div>

                    <button type="submit" class="w-full bg-rose-500 text-white rounded-xl py-4 font-semibold hover:bg-rose-600 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex justify-center items-center">
                        Konfirmasi Pembayaran
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>

                </div>
            </div>

        </div>
    </form>
</div>

<script>
    document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
        if(this.files && this.files[0]) {
            const fileName = this.files[0].name;
            const textEl = this.parentElement.querySelector('p.text-sm');
            if(textEl) textEl.textContent = fileName;
        }
    });
</script>
@endsection
