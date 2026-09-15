@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
    
    <!-- Back Button & Breadcrumbs -->
    <div class="flex items-center justify-between mb-8">
        <nav class="flex items-center space-x-2 text-xs font-medium text-zinc-400">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('rentals.list') }}" class="hover:text-zinc-900 transition-colors">Pesanan</a>
            <span>/</span>
            <span class="text-zinc-900">Pembayaran</span>
        </nav>

        <a href="javascript:history.back()" class="inline-flex items-center text-xs font-semibold text-zinc-500 hover:text-zinc-900 transition-colors">
            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <!-- Stepper Indicator -->
    <div class="max-w-xl mx-auto mb-12">
        <div class="flex items-center justify-between text-xs font-medium text-zinc-400">
            <div class="flex items-center text-zinc-900">
                <span class="w-5 h-5 rounded-full bg-zinc-900 text-white flex items-center justify-center text-[10px] mr-2">✓</span>
                <span>Keranjang</span>
            </div>
            <div class="flex-1 h-[1px] bg-zinc-300 mx-4"></div>
            <div class="flex items-center text-zinc-900">
                <span class="w-5 h-5 rounded-full bg-zinc-900 text-white flex items-center justify-center text-[10px] mr-2">✓</span>
                <span>Konfirmasi</span>
            </div>
            <div class="flex-1 h-[1px] bg-zinc-300 mx-4"></div>
            <div class="flex items-center text-zinc-900 font-semibold">
                <span class="w-5 h-5 rounded-full bg-zinc-900 text-white flex items-center justify-center text-[10px] mr-2">3</span>
                <span>Pembayaran</span>
            </div>
        </div>
    </div>

    <div class="text-center max-w-lg mx-auto mb-10">
        <h1 class="text-2xl sm:text-3xl font-bold text-zinc-900 tracking-tight">Selesaikan Pembayaran</h1>
        <p class="text-zinc-500 text-xs sm:text-sm mt-1">Lakukan transfer sesuai rincian berikut dan unggah bukti transfer Anda.</p>
    </div>

    <form action="{{ route('payments.upload-proof', $payment->id) }}" method="POST" enctype="multipart/form-data" hx-boost="false" class="max-w-4xl mx-auto">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Payment Destination & Upload (col 12 -> 7) -->
            <div class="md:col-span-7 space-y-6">
                
                <!-- Destination Info Card -->
                <div class="bg-white rounded-3xl border border-zinc-200/80 p-6 sm:p-7 shadow-2xs">
                    <span class="text-[10px] font-bold text-zinc-400 tracking-wider uppercase mb-4 block">1. Tujuan Pembayaran</span>

                    @if($payment->metode_pembayaran == 'Transfer')
                        <div class="p-5 rounded-2xl bg-zinc-50 border border-zinc-100 flex flex-col gap-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-white border border-zinc-200 flex items-center justify-center font-black text-xs text-blue-900 shadow-2xs">
                                        BCA
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-zinc-900">Bank Central Asia</p>
                                        <p class="text-[11px] text-zinc-400">a.n PT DocuRent Kreatif Studio</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-50 text-blue-800 border border-blue-100">Transfer Bank</span>
                            </div>

                            <div class="pt-3 border-t border-zinc-200/70 flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] text-zinc-400 uppercase tracking-wider block">Nomor Rekening</span>
                                    <span class="font-mono text-base font-bold text-zinc-900 tracking-wider" id="rekeningNumber">1234567890</span>
                                </div>
                                <button 
                                    type="button" 
                                    onclick="copyToClipboard('1234567890', this)"
                                    class="inline-flex items-center px-3 py-1.5 rounded-lg bg-white border border-zinc-200 text-xs font-semibold text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 transition-colors shadow-2xs cursor-pointer"
                                >
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    <span>Salin</span>
                                </button>
                            </div>
                        </div>

                    @elseif($payment->metode_pembayaran == 'E-Wallet')
                        <div class="p-5 rounded-2xl bg-zinc-50 border border-zinc-100 flex flex-col gap-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-white border border-zinc-200 flex items-center justify-center font-bold text-xs text-emerald-800 shadow-2xs">
                                        E-PAY
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-zinc-900">GoPay / OVO / Dana</p>
                                        <p class="text-[11px] text-zinc-400">a.n DocuRent Studio</p>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-800 border border-emerald-100">E-Wallet</span>
                            </div>

                            <div class="pt-3 border-t border-zinc-200/70 flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] text-zinc-400 uppercase tracking-wider block">Nomor Akun E-Wallet</span>
                                    <span class="font-mono text-base font-bold text-zinc-900 tracking-wider" id="ewalletNumber">081234567890</span>
                                </div>
                                <button 
                                    type="button" 
                                    onclick="copyToClipboard('081234567890', this)"
                                    class="inline-flex items-center px-3 py-1.5 rounded-lg bg-white border border-zinc-200 text-xs font-semibold text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 transition-colors shadow-2xs cursor-pointer"
                                >
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    <span>Salin</span>
                                </button>
                            </div>
                        </div>

                    @elseif($payment->metode_pembayaran == 'QRIS')
                        <div class="p-6 rounded-2xl bg-zinc-50 border border-zinc-100 flex flex-col items-center text-center">
                            <p class="text-xs text-zinc-500 mb-4">Buka aplikasi m-Banking atau e-Wallet favorit Anda, lalu pindai kode QRIS berikut:</p>
                            <div class="p-3 bg-white rounded-2xl border border-zinc-200 shadow-2xs inline-block">
                                <img src="{{ asset('images/qris.jpg') }}" alt="QRIS DocuRent" class="w-44 h-44 object-cover rounded-xl" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg'">
                            </div>
                            <span class="text-[11px] font-medium text-zinc-400 mt-3">NMID: ID1020030040 • DocuRent Malang</span>
                        </div>
                    @endif
                </div>

                <!-- Proof of Payment Upload Card with Live Preview -->
                <div class="bg-white rounded-3xl border border-zinc-200/80 p-6 sm:p-7 shadow-2xs">
                    <span class="text-[10px] font-bold text-zinc-400 tracking-wider uppercase mb-2 block">2. Unggah Bukti Pembayaran</span>
                    <p class="text-xs text-zinc-500 mb-4 leading-relaxed">
                        Lampirkan tangkapan layar (screenshot) atau foto struk bukti transaksi Anda. Format yang didukung: JPG, PNG (maksimal 2MB).
                    </p>

                    <div class="relative">
                        <input 
                            type="file" 
                            name="bukti_pembayaran" 
                            id="bukti_pembayaran" 
                            required 
                            accept="image/jpeg,image/png,image/jpg" 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20"
                            onchange="handleReceiptPreview(event)"
                        >
                        
                        <!-- Empty Dropzone State -->
                        <div id="dropzone-empty" class="rounded-2xl border-2 border-dashed border-zinc-200 bg-zinc-50/70 p-8 text-center hover:bg-zinc-100/60 hover:border-zinc-300 transition-all">
                            <div class="w-10 h-10 rounded-full bg-white border border-zinc-200 flex items-center justify-center mx-auto mb-3 text-zinc-400 shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-xs font-semibold text-zinc-800">Klik untuk memilih file bukti transfer</p>
                            <p class="text-[11px] text-zinc-400 mt-0.5">atau seret file ke sini</p>
                        </div>

                        <!-- Live Preview State (Initially Hidden) -->
                        <div id="dropzone-preview" class="hidden rounded-2xl border border-zinc-200 bg-zinc-50 p-4 flex items-center gap-4">
                            <img id="preview-img" src="" alt="Pratinjau Bukti" class="w-20 h-20 object-cover rounded-xl border border-zinc-200 shrink-0 bg-white">
                            <div class="flex-grow overflow-hidden">
                                <p class="text-xs font-semibold text-zinc-900 truncate" id="preview-filename">bukti-transfer.jpg</p>
                                <p class="text-[11px] text-zinc-400 mt-0.5" id="preview-filesize">Ukuran file</p>
                                <span class="inline-flex items-center text-[10px] font-semibold text-emerald-600 mt-1">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    File siap diunggah
                                </span>
                            </div>
                            <span class="text-xs text-zinc-500 font-medium hover:text-zinc-900 underline shrink-0 cursor-pointer">Ganti</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Summary Card (col 12 -> 5) -->
            <div class="md:col-span-5">
                <div class="bg-white rounded-3xl border border-zinc-200/80 p-6 sm:p-7 shadow-2xs sticky top-28">
                    <h3 class="text-base font-bold text-zinc-900 mb-5 pb-3 border-b border-zinc-100">Ringkasan Tagihan</h3>

                    <div class="space-y-3 mb-6 text-xs">
                        <div class="flex justify-between items-center text-zinc-500">
                            <span>ID Transaksi / Booking</span>
                            <span class="font-mono font-medium text-zinc-900">#{{ $payment->rental_id }}</span>
                        </div>
                        <div class="flex justify-between items-center text-zinc-500">
                            <span>Metode Pembayaran</span>
                            <span class="font-medium text-zinc-900">{{ $payment->metode_pembayaran }}</span>
                        </div>
                        <div class="flex justify-between items-center text-zinc-500">
                            <span>Status</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-amber-50 text-amber-800 border border-amber-200/60">
                                Menunggu Bukti
                            </span>
                        </div>
                    </div>

                    <!-- Total Amount Callout -->
                    <div class="p-5 bg-zinc-900 text-white rounded-2xl mb-6">
                        <span class="text-[11px] text-zinc-400 uppercase tracking-wider block">Total yang Harus Ditransfer</span>
                        <p class="text-2xl sm:text-3xl font-bold tracking-tight mt-1 text-white">
                            Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}
                        </p>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-zinc-900 text-white rounded-xl py-3.5 text-xs font-semibold hover:bg-zinc-800 transition-all shadow-2xs flex justify-center items-center cursor-pointer"
                    >
                        Kirim Bukti Pembayaran
                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                    
                    <p class="text-[11px] text-center text-zinc-400 mt-3.5 leading-relaxed">
                        Tim admin kami akan memverifikasi pembayaran Anda dalam kurun waktu 10-30 menit pada jam kerja.
                    </p>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    // 1-Click Copy with feedback
    function copyToClipboard(text, buttonEl) {
        if (!navigator.clipboard) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy");
            document.body.removeChild(textArea);
            showCopiedState(buttonEl);
            return;
        }

        navigator.clipboard.writeText(text).then(() => {
            showCopiedState(buttonEl);
        });
    }

    function showCopiedState(buttonEl) {
        const originalHtml = buttonEl.innerHTML;
        buttonEl.innerHTML = `<svg class="w-3.5 h-3.5 mr-1.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg><span class="text-emerald-700">Tersalin!</span>`;
        setTimeout(() => {
            buttonEl.innerHTML = originalHtml;
        }, 2000);
    }

    // Live Thumbnail Preview
    function handleReceiptPreview(e) {
        const file = e.target.files[0];
        if (!file) return;

        const emptyBox = document.getElementById('dropzone-empty');
        const previewBox = document.getElementById('dropzone-preview');
        const previewImg = document.getElementById('preview-img');
        const filenameEl = document.getElementById('preview-filename');
        const filesizeEl = document.getElementById('preview-filesize');

        filenameEl.textContent = file.name;
        filesizeEl.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';

        const reader = new FileReader();
        reader.onload = function(evt) {
            previewImg.src = evt.target.result;
            emptyBox.classList.add('hidden');
            previewBox.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
</script>
@endsection
