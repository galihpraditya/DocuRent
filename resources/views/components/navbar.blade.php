<nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-zinc-200/80 transition-all duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <!-- Logo -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="flex items-center space-x-2.5 text-zinc-900 group">
                    <div class="w-9 h-9 bg-zinc-900 text-white rounded-xl flex items-center justify-center transition-transform duration-200 group-hover:scale-105">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-zinc-900">DocuRent<span class="text-zinc-400 font-normal">.</span></span>
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden lg:flex items-center space-x-6 text-sm font-medium text-zinc-600">
                    <a href="{{ route('home') }}#catalog" class="hover:text-zinc-900 transition-colors">Katalog Gear</a>
                    <a href="{{ route('home') }}#recommendation" class="hover:text-zinc-900 transition-colors">Rekomendasi</a>
                    <a href="{{ route('home') }}#gallery" class="hover:text-zinc-900 transition-colors">Galeri</a>
                </div>
            </div>

            <!-- Search Bar (Desktop) -->
            <form action="{{ route('home') }}#catalog" method="GET" class="hidden md:flex flex-1 max-w-md mx-8 relative group">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400 group-focus-within:text-zinc-900 transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    class="block w-full pl-10 pr-12 py-2 bg-zinc-100/70 hover:bg-zinc-100 border border-transparent focus:border-zinc-300 focus:bg-white rounded-full text-sm text-zinc-900 placeholder-zinc-400 transition-all outline-none focus:ring-2 focus:ring-zinc-900/5" 
                    placeholder="Cari kamera, lensa, audio..."
                >
            </form>

            <!-- Actions -->
            <div class="flex items-center space-x-1.5 sm:space-x-3">
                <!-- WhatsApp Button (Desktop/Tablet) -->
                <a href="https://wa.me/0895630582664" target="_blank" class="hidden sm:inline-flex p-2.5 text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100 rounded-full transition-colors relative" title="Chat WhatsApp Studio">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </a>

                @auth
                    <!-- Cart Button -->
                    <a href="{{ route('cart.index') }}" class="p-2 sm:p-2.5 text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100 rounded-full transition-colors relative" title="Keranjang Sewa">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        @php
                            $cartCount = \App\Models\CartItem::whereHas('cart', function($query) {
                                $query->where('user_id', auth()->id());
                            })->count();
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute top-1 sm:top-1.5 right-1 sm:right-1.5 w-4 h-4 bg-zinc-900 text-white text-[10px] font-semibold flex items-center justify-center rounded-full border border-white">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="relative x-dropdown">
                        <button type="button" class="flex items-center space-x-2 p-1 sm:p-1.5 sm:pl-2.5 rounded-full border border-zinc-200/80 hover:border-zinc-300 hover:bg-zinc-50 transition-all focus:outline-none" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="hidden sm:inline text-xs font-semibold text-zinc-800 tracking-tight">{{ auth()->user()->username }}</span>
                            <img class="h-7 w-7 rounded-full bg-zinc-200 object-cover border border-zinc-200" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&background=18181b&color=ffffff&bold=true" alt="{{ auth()->user()->username }}">
                        </button>

                        <!-- Dropdown panel -->
                        <div class="absolute right-0 mt-2.5 w-56 rounded-2xl shadow-xl bg-white border border-zinc-100 divide-y divide-zinc-100 hidden z-50 transform origin-top-right transition-all" id="user-menu" role="menu">
                            <div class="px-4 py-3">
                                <p class="text-[11px] font-medium text-zinc-400 uppercase tracking-wider">Masuk sebagai</p>
                                <p class="text-sm font-semibold text-zinc-900 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="py-1.5">
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('dashboard') }}" hx-boost="false" class="group flex items-center px-4 py-2 text-xs font-medium text-rose-600 hover:bg-rose-50">
                                        <svg class="w-4 h-4 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                                        Panel Admin
                                    </a>
                                @endif
                                <a href="{{ route('profile') }}" class="group flex items-center px-4 py-2 text-xs font-medium text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900">
                                    <svg class="w-4 h-4 mr-2.5 text-zinc-400 group-hover:text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Profil Saya
                                </a>
                                <a href="{{ route('rentals.list') }}" class="group flex items-center px-4 py-2 text-xs font-medium text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900">
                                    <svg class="w-4 h-4 mr-2.5 text-zinc-400 group-hover:text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    Pesanan Saya
                                </a>
                            </div>
                            <div class="py-1.5">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="group flex w-full items-center px-4 py-2 text-xs font-medium text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50 transition-colors">
                                        <svg class="w-4 h-4 mr-2.5 text-zinc-400 group-hover:text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 rounded-full bg-zinc-900 text-white font-medium text-xs tracking-wide hover:bg-zinc-800 transition-colors shadow-2xs">
                        Masuk
                    </a>
                @endauth

                <!-- Mobile Menu Button -->
                <button type="button" id="mobile-menu-btn" class="lg:hidden p-2 text-zinc-500 hover:text-zinc-900 rounded-lg hover:bg-zinc-100 transition-colors" aria-label="Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer / Search Bar -->
        <div id="mobile-menu" class="hidden lg:hidden pb-4 pt-2 border-t border-zinc-100 space-y-3">
            <form action="{{ route('home') }}#catalog" method="GET" class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    class="block w-full pl-10 pr-4 py-2 bg-zinc-100 border border-transparent rounded-full text-sm text-zinc-900 placeholder-zinc-400 focus:bg-white focus:border-zinc-300 outline-none" 
                    placeholder="Cari kamera, lensa..."
                >
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </form>
            <div class="flex flex-wrap gap-2 text-xs font-medium text-zinc-600">
                <a href="{{ route('home') }}#catalog" class="px-3 py-1.5 rounded-full bg-zinc-100 hover:bg-zinc-200">Katalog Gear</a>
                <a href="{{ route('home') }}#recommendation" class="px-3 py-1.5 rounded-full bg-zinc-100 hover:bg-zinc-200">Rekomendasi</a>
                <a href="{{ route('home') }}#gallery" class="px-3 py-1.5 rounded-full bg-zinc-100 hover:bg-zinc-200">Galeri</a>
            </div>
            <!-- WhatsApp Chat Mobile Link -->
            <div class="pt-2 border-t border-zinc-100 flex items-center justify-between text-xs text-zinc-500">
                <span>Konsultasi sewa gear:</span>
                <a href="https://wa.me/0895630582664" target="_blank" class="inline-flex items-center gap-1.5 font-semibold text-emerald-600 hover:text-emerald-700">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    WhatsApp Studio
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    if (!window.dropdownInitialized) {
        window.dropdownInitialized = true;
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('user-menu-button');
            const menu = document.getElementById('user-menu');
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (btn && menu) {
                if (btn.contains(e.target)) {
                    menu.classList.toggle('hidden');
                } else if (!menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            }

            if (mobileBtn && mobileMenu) {
                if (mobileBtn.contains(e.target)) {
                    mobileMenu.classList.toggle('hidden');
                }
            }
        });
    }
</script>