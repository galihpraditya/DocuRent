<div>
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
        <div>
            <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Hasil Karya</span>
            <h3 class="text-2xl sm:text-3xl font-bold text-zinc-900 tracking-tight mt-1">Dokumentasi & Portofolio</h3>
            <p class="text-zinc-500 text-sm mt-1">Berbagai produksi video, komersial, dan foto yang direkam menggunakan unit DocuRent.</p>
        </div>
    </div>
    
    <!-- Gallery Grid -->
    <div class="mb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-zinc-100 border border-zinc-200/80">
                <img src="{{ asset('images/gallery-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=800&auto=format&fit=crop'" alt="Behind the Scene" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-103">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/70 via-zinc-900/10 to-transparent flex items-end p-6">
                    <div>
                        <span class="text-[10px] font-semibold text-white/80 uppercase tracking-wider">Sinematografi</span>
                        <p class="text-white text-sm font-semibold mt-0.5">Behind the Scene Shoot</p>
                    </div>
                </div>
            </div>
            <div class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-zinc-100 border border-zinc-200/80">
                <img src="{{ asset('images/gallery-2.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1542044896530-05d85be9b11a?q=80&w=800&auto=format&fit=crop'" alt="Wedding Event" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-103">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/70 via-zinc-900/10 to-transparent flex items-end p-6">
                    <div>
                        <span class="text-[10px] font-semibold text-white/80 uppercase tracking-wider">Dokumentasi Acara</span>
                        <p class="text-white text-sm font-semibold mt-0.5">Wedding & Event Shoot</p>
                    </div>
                </div>
            </div>
            <div class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-zinc-100 border border-zinc-200/80">
                <img src="{{ asset('images/gallery-3.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1620021308343-982da94086e4?q=80&w=800&auto=format&fit=crop'" alt="Produksi Film" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-103">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/70 via-zinc-900/10 to-transparent flex items-end p-6">
                    <div>
                        <span class="text-[10px] font-semibold text-white/80 uppercase tracking-wider">Produksi Komersial</span>
                        <p class="text-white text-sm font-semibold mt-0.5">Iklan & Film Pendek</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimoni Bersih & Elegan -->
    <div>
        <div class="mb-8">
            <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Ulasan Kreator</span>
            <h4 class="text-xl sm:text-2xl font-bold text-zinc-900 tracking-tight mt-1">Pengalaman Penyewa</h4>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Testimoni 1 -->
            <div class="bg-white p-7 rounded-2xl border border-zinc-200/80 flex flex-col justify-between hover:border-zinc-300 transition-all">
                <div>
                    <div class="flex text-zinc-900 text-xs mb-4 gap-1">
                        ★★★★★
                    </div>
                    <p class="text-sm text-zinc-600 leading-relaxed font-normal">
                        "Kondisi kamera dan lensanya sangat bersih, sensor bebas debu. Sangat memudahkan saat jadwal syuting komersial mendadak di Malang."
                    </p>
                </div>
                <div class="flex items-center mt-6 pt-5 border-t border-zinc-100">
                    <img src="https://ui-avatars.com/api/?name=Rizky+Pratama&background=f4f4f5&color=18181b&bold=true" class="w-9 h-9 rounded-full mr-3 border border-zinc-200/60" alt="Rizky Pratama">
                    <div>
                        <h6 class="font-semibold text-zinc-900 text-xs">Rizky Pratama</h6>
                        <p class="text-[11px] text-zinc-400">Content Creator & Videographer</p>
                    </div>
                </div>
            </div>

            <!-- Testimoni 2 -->
            <div class="bg-white p-7 rounded-2xl border border-zinc-200/80 flex flex-col justify-between hover:border-zinc-300 transition-all">
                <div>
                    <div class="flex text-zinc-900 text-xs mb-4 gap-1">
                        ★★★★★
                    </div>
                    <p class="text-sm text-zinc-600 leading-relaxed font-normal">
                        "Sangat membantu untuk proyek tugas akhir dokumenter kampus. Baterai cadangan dan tas bawaan lengkap, tinggal pakai langsung."
                    </p>
                </div>
                <div class="flex items-center mt-6 pt-5 border-t border-zinc-100">
                    <img src="https://ui-avatars.com/api/?name=Amanda+Putri&background=f4f4f5&color=18181b&bold=true" class="w-9 h-9 rounded-full mr-3 border border-zinc-200/60" alt="Amanda Putri">
                    <div>
                        <h6 class="font-semibold text-zinc-900 text-xs">Amanda Putri</h6>
                        <p class="text-[11px] text-zinc-400">Mahasiswa Desain & Film</p>
                    </div>
                </div>
            </div>

            <!-- Testimoni 3 -->
            <div class="bg-white p-7 rounded-2xl border border-zinc-200/80 flex flex-col justify-between hover:border-zinc-300 transition-all">
                <div>
                    <div class="flex text-zinc-900 text-xs mb-4 gap-1">
                        ★★★★★
                    </div>
                    <p class="text-sm text-zinc-600 leading-relaxed font-normal">
                        "Pilihan lensa Sony dan lighting Aputure lengkap. Pelayanan admin ramah dan proses verifikasi pembayaran cepat tanpa ribet."
                    </p>
                </div>
                <div class="flex items-center mt-6 pt-5 border-t border-zinc-100">
                    <img src="https://ui-avatars.com/api/?name=Fajar+Nugroho&background=f4f4f5&color=18181b&bold=true" class="w-9 h-9 rounded-full mr-3 border border-zinc-200/60" alt="Fajar Nugroho">
                    <div>
                        <h6 class="font-semibold text-zinc-900 text-xs">Fajar Nugroho</h6>
                        <p class="text-[11px] text-zinc-400">Director of Photography (DP)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>