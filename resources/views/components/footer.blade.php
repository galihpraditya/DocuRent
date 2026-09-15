<footer class="bg-zinc-50/70 border-t border-zinc-200/70 text-zinc-600 py-16 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <!-- Brand Info -->
            <div class="md:col-span-2 space-y-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-2.5 text-zinc-900 group">
                    <div class="w-8 h-8 bg-zinc-900 text-white rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-lg tracking-tight text-zinc-900">DocuRent<span class="text-zinc-400 font-normal">.</span></span>
                </a>
                <p class="text-sm text-zinc-500 leading-relaxed max-w-sm">
                    Platform persewaan alat fotografi & videografi profesional di Malang. Kami menyediakan kamera, lensa, lighting, drone, dan audio dalam kondisi prima siap produksi.
                </p>
                <div class="pt-2 flex items-center space-x-4 text-xs text-zinc-400 font-medium">
                    <span class="inline-flex items-center">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                        Sensor & Optik Terawat
                    </span>
                    <span class="inline-flex items-center">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                        Baterai & Aksesoris Lengkap
                    </span>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="space-y-3">
                <h6 class="text-xs font-bold text-zinc-900 uppercase tracking-wider">Katalog Gear</h6>
                <ul class="space-y-2 text-sm text-zinc-500">
                    <li><a href="{{ route('home') }}?kategori=kamera#catalog" class="hover:text-zinc-900 transition-colors">Kamera Mirrorless & Cinema</a></li>
                    <li><a href="{{ route('home') }}?kategori=lensa#catalog" class="hover:text-zinc-900 transition-colors">Lensa Prime & Zoom</a></li>
                    <li><a href="{{ route('home') }}?kategori=lighting#catalog" class="hover:text-zinc-900 transition-colors">Lighting & Studio</a></li>
                    <li><a href="{{ route('home') }}?kategori=drone#catalog" class="hover:text-zinc-900 transition-colors">Drone & Gimbal</a></li>
                    <li><a href="{{ route('home') }}?kategori=audio#catalog" class="hover:text-zinc-900 transition-colors">Audio & Mic Wireless</a></li>
                </ul>
            </div>
            
            <!-- Contact & Office -->
            <div class="space-y-3">
                <h6 class="text-xs font-bold text-zinc-900 uppercase tracking-wider">Kontak & Lokasi</h6>
                <ul class="space-y-2.5 text-sm text-zinc-500">
                    <li class="flex items-start space-x-2.5">
                        <svg class="w-4 h-4 text-zinc-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Jl. Ninja No 34, Kel. Ringin, Kec. Sukun, Kota Malang</span>
                    </li>
                    <li class="flex items-center space-x-2.5">
                        <svg class="w-4 h-4 text-zinc-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>0895-6305-82664</span>
                    </li>
                    <li class="flex items-center space-x-2.5">
                        <svg class="w-4 h-4 text-zinc-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>docurent.malang@gmail.com</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-zinc-200/80 mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-zinc-400 gap-3">
            <p>&copy; {{ date('Y') }} DocuRent. Hak Cipta Dilindungi.</p>
            <p class="font-medium text-zinc-500">Peralatan Dokumentasi untuk Kreator & Profesional</p>
        </div>
    </div>
</footer>