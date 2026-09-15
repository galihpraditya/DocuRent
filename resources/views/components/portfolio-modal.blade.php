<!-- Floating Question Mark (?) Button -->
<div class="fixed bottom-6 right-6 z-40 group">
    <!-- Tooltip -->
    <div class="absolute right-full mr-3 top-1/2 -translate-y-1/2 hidden sm:block opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap">
        <div class="px-3 py-1.5 rounded-xl bg-zinc-900/90 text-white text-[11px] font-medium backdrop-blur-xs shadow-lg border border-zinc-700/50">
            Pemberitahuan Portofolio &bull; Akun Demo
        </div>
    </div>

    <!-- The Circular Floating Button -->
    <button 
        type="button" 
        id="portfolio-help-btn"
        onclick="openPortfolioModal()"
        class="w-11 h-11 rounded-full bg-zinc-900 text-white flex items-center justify-center shadow-xl hover:bg-zinc-800 hover:scale-105 active:scale-95 transition-all border border-zinc-700/60 focus:outline-none relative cursor-pointer"
        aria-label="Pemberitahuan Portofolio"
        title="Pemberitahuan Portofolio"
    >
        <!-- Soft Pulse Ring -->
        <span class="absolute -inset-1 rounded-full bg-zinc-900/20 animate-ping pointer-events-none"></span>
        
        <!-- Question Mark Icon -->
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </button>
</div>

<!-- Portfolio & Demo Access Modal -->
<div id="portfolio-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-zinc-950/60 backdrop-blur-xs transition-opacity duration-200">
    <div class="relative w-full max-w-md bg-white rounded-3xl border border-zinc-200/80 shadow-2xl overflow-hidden transform transition-all p-6 sm:p-7">
        
        <!-- Header -->
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-zinc-900 text-white flex items-center justify-center text-xs font-bold shadow-2xs">
                    ?
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Portofolio Showcase</span>
                    <h3 class="text-base font-bold text-zinc-900 tracking-tight">Website Portofolio & Demo</h3>
                </div>
            </div>
            
            <button 
                type="button" 
                onclick="closePortfolioModal()"
                class="w-8 h-8 rounded-full bg-zinc-100 text-zinc-400 hover:text-zinc-900 hover:bg-zinc-200 flex items-center justify-center transition-colors cursor-pointer"
                aria-label="Tutup"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Description -->
        <p class="text-xs text-zinc-600 leading-relaxed mb-6 font-normal">
            DocuRent adalah proyek showcase portofolio website rental alat fotografi, sinematografi, dan perlengkapan produksi kreatif modern.
        </p>

        <!-- Demo Access Cards / Buttons -->
        <div class="space-y-3 mb-4">
            <div class="flex items-center justify-between px-1">
                <span class="text-[11px] font-bold text-zinc-900 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Pilih Akses Akun Demo
                </span>
                <span class="text-[10px] font-medium text-zinc-400">Otomatis Terisi</span>
            </div>

            <!-- Admin Demo Button -->
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a 
                    href="{{ route('dashboard') }}" 
                    hx-boost="false"
                    class="flex items-center justify-between w-full p-3.5 bg-zinc-900 text-white rounded-2xl text-xs font-semibold hover:bg-zinc-800 transition-all shadow-2xs group"
                >
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-xl bg-white/10 flex items-center justify-center text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                        </div>
                        <div class="text-left">
                            <span class="block font-bold">Buka Panel Admin</span>
                            <span class="block text-[10px] text-zinc-400 font-normal">Anda sudah login sebagai Admin</span>
                        </div>
                    </div>
                    <span class="text-zinc-400 group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                </a>
            @else
                <a 
                    href="{{ route('login') }}?demo=admin" 
                    hx-boost="false"
                    class="flex items-center justify-between w-full p-3.5 bg-zinc-900 text-white rounded-2xl text-xs font-semibold hover:bg-zinc-800 transition-all shadow-2xs group"
                >
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-xl bg-white/10 flex items-center justify-center text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        </div>
                        <div class="text-left">
                            <span class="block font-bold">Masuk sebagai Admin Demo</span>
                            <span class="block text-[10px] text-zinc-400 font-normal">Kelola produk, transaksi & verifikasi bayar</span>
                        </div>
                    </div>
                    <span class="text-zinc-400 group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                </a>
            @endif

            <!-- User / Customer Demo Button -->
            @if(auth()->check() && auth()->user()->role !== 'admin')
                <a 
                    href="{{ route('home') }}#catalog" 
                    hx-boost="false"
                    class="flex items-center justify-between w-full p-3.5 bg-zinc-50 hover:bg-zinc-100 text-zinc-800 border border-zinc-200/80 rounded-2xl text-xs font-semibold transition-all shadow-2xs group"
                >
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-xl bg-zinc-200 text-zinc-700 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div class="text-left">
                            <span class="block font-bold">Eksplorasi sebagai Penyewa</span>
                            <span class="block text-[10px] text-zinc-500 font-normal">Anda sedang login sebagai {{ auth()->user()->nama }}</span>
                        </div>
                    </div>
                    <span class="text-zinc-400 group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                </a>
            @else
                <a 
                    href="{{ route('login') }}?demo=user" 
                    hx-boost="false"
                    class="flex items-center justify-between w-full p-3.5 bg-zinc-50 hover:bg-zinc-100 text-zinc-800 border border-zinc-200/80 rounded-2xl text-xs font-semibold transition-all shadow-2xs group"
                >
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-xl bg-zinc-200 text-zinc-700 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div class="text-left">
                            <span class="block font-bold">Masuk sebagai Pelanggan Demo</span>
                            <span class="block text-[10px] text-zinc-500 font-normal">Uji alur sewa, keranjang & pembayaran</span>
                        </div>
                    </div>
                    <span class="text-zinc-400 group-hover:translate-x-0.5 transition-transform">&rarr;</span>
                </a>
            @endif
        </div>

        <p class="text-[11px] text-zinc-400 text-center leading-relaxed">
            Form login akan terisi secara otomatis tanpa perlu mengetik manual.
        </p>

    </div>
</div>

<script>
    function openPortfolioModal() {
        const modal = document.getElementById('portfolio-modal');
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    function closePortfolioModal() {
        const modal = document.getElementById('portfolio-modal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    // Close on backdrop click
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('portfolio-modal');
        if (modal && !modal.classList.contains('hidden')) {
            if (e.target === modal) {
                closePortfolioModal();
            }
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePortfolioModal();
        }
    });
</script>
