<div>
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
        <div>
            <h3 class="text-2xl font-bold text-zinc-900 tracking-tight">Galeri & Testimoni</h3>
            <p class="text-zinc-500 mt-1">Lihat keseruan dan hasil karya menggunakan peralatan kami.</p>
        </div>
    </div>
    
    <!-- Dokumentasi Alat & Event -->
    <div class="mb-16">
        <h5 class="text-xl font-semibold text-zinc-900 mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Dokumentasi Alat & Event
        </h5>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-zinc-100">
                <img src="{{ asset('images/gallery-1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=800&auto=format&fit=crop'" alt="Galeri 1" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <span class="text-white font-medium">Behind the Scene</span>
                </div>
            </div>
            <div class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-zinc-100">
                <img src="{{ asset('images/gallery-2.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1542044896530-05d85be9b11a?q=80&w=800&auto=format&fit=crop'" alt="Galeri 2" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <span class="text-white font-medium">Wedding Event</span>
                </div>
            </div>
            <div class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-zinc-100">
                <img src="{{ asset('images/gallery-3.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1620021308343-982da94086e4?q=80&w=800&auto=format&fit=crop'" alt="Galeri 3" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <span class="text-white font-medium">Produksi Film</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimoni -->
    <div>
        <h5 class="text-xl font-semibold text-zinc-900 mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            Apa Kata Mereka?
        </h5>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Testimoni 1 -->
            <div class="bg-white p-6 rounded-2xl border border-zinc-200 hover:shadow-lg transition-shadow relative">
                <svg class="absolute top-6 right-6 w-8 h-8 text-zinc-100" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                <div class="flex items-center mb-4 relative z-10">
                    <img src="https://ui-avatars.com/api/?name=Rizky+Pratama&background=f43f5e&color=fff" class="w-10 h-10 rounded-full mr-3" alt="Rizky Pratama">
                    <div>
                        <h6 class="font-bold text-zinc-900 text-sm">Rizky Pratama</h6>
                        <p class="text-xs text-zinc-500">Content Creator</p>
                    </div>
                </div>
                <p class="text-sm text-zinc-600 italic relative z-10 leading-relaxed">
                    "Kameranya bersih dan hasilnya bagus banget. Proses sewa juga cepat, cocok buat kebutuhan shooting mendadak."
                </p>
            </div>

            <!-- Testimoni 2 -->
            <div class="bg-white p-6 rounded-2xl border border-zinc-200 hover:shadow-lg transition-shadow relative">
                <svg class="absolute top-6 right-6 w-8 h-8 text-zinc-100" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                <div class="flex items-center mb-4 relative z-10">
                    <img src="https://ui-avatars.com/api/?name=Amanda+Putri&background=8b5cf6&color=fff" class="w-10 h-10 rounded-full mr-3" alt="Amanda Putri">
                    <div>
                        <h6 class="font-bold text-zinc-900 text-sm">Amanda Putri</h6>
                        <p class="text-xs text-zinc-500">Mahasiswa</p>
                    </div>
                </div>
                <p class="text-sm text-zinc-600 italic relative z-10 leading-relaxed">
                    "Sangat membantu buat tugas dokumentasi kampus. Adminnya ramah dan alat yang disewa sesuai deskripsi."
                </p>
            </div>

            <!-- Testimoni 3 -->
            <div class="bg-white p-6 rounded-2xl border border-zinc-200 hover:shadow-lg transition-shadow relative">
                <svg class="absolute top-6 right-6 w-8 h-8 text-zinc-100" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                <div class="flex items-center mb-4 relative z-10">
                    <img src="https://ui-avatars.com/api/?name=Fajar+Nugroho&background=10b981&color=fff" class="w-10 h-10 rounded-full mr-3" alt="Fajar Nugroho">
                    <div>
                        <h6 class="font-bold text-zinc-900 text-sm">Fajar Nugroho</h6>
                        <p class="text-xs text-zinc-500">Videographer</p>
                    </div>
                </div>
                <p class="text-sm text-zinc-600 italic relative z-10 leading-relaxed">
                    "Pilihan alat lengkap dan harga masih masuk akal. Sudah beberapa kali rental di sini dan selalu puas."
                </p>
            </div>
        </div>
    </div>

</div>