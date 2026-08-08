<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-zinc-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2 text-zinc-900 group">
                <div class="w-10 h-10 bg-zinc-900 text-white rounded-xl flex items-center justify-center transform transition-transform group-hover:scale-105 group-hover:rotate-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <span class="font-bold text-xl tracking-tight">DocuRent</span>
            </a>

            <!-- Search Bar (Desktop) -->
            <form action="{{ route('products.search') }}#catalog" method="GET" class="hidden md:flex flex-1 max-w-lg mx-8 relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-zinc-400 group-focus-within:text-zinc-900 transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search" class="block w-full pl-10 pr-4 py-2.5 bg-zinc-100 border-transparent rounded-full text-zinc-900 placeholder-zinc-500 focus:bg-white focus:border-zinc-300 focus:ring-4 focus:ring-zinc-100 transition-all outline-none" placeholder="Temukan gear terbaik untukmu...">
            </form>

            <!-- Actions -->
            <div class="flex items-center space-x-2 sm:space-x-4">
                @auth
                    <!-- WhatsApp Button -->
                    <a href="https://wa.me/0895630582664" target="_blank" class="p-2.5 text-zinc-600 hover:text-green-600 hover:bg-green-50 rounded-full transition-colors relative group" title="Chat WhatsApp">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>

                    <!-- Cart Button -->
                    <a href="{{ route('cart.index') }}" class="p-2.5 text-zinc-600 hover:text-zinc-900 hover:bg-zinc-100 rounded-full transition-colors relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        @php
                            $cartCount = \App\Models\CartItem::whereHas('cart', function($query) {
                                $query->where('user_id', auth()->id());
                            })->count();
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute top-0 right-0 w-4 h-4 bg-rose-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full border-2 border-white transform translate-x-1/4 -translate-y-1/4">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="relative x-dropdown">
                        <button type="button" class="flex items-center space-x-2 p-2 rounded-full hover:bg-zinc-100 transition-colors focus:outline-none focus:ring-2 focus:ring-zinc-200" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <img class="h-8 w-8 rounded-full bg-zinc-200 object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&background=0D8ABC&color=fff" alt="">
                            <span class="hidden md:block text-sm font-medium text-zinc-700">{{ auth()->user()->username }}</span>
                            <svg class="hidden md:block w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <!-- Dropdown panel -->
                        <div class="absolute right-0 mt-2 w-48 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-zinc-100 hidden z-50 transform origin-top-right transition-all" id="user-menu" role="menu">
                            <div class="px-4 py-3">
                                <p class="text-sm">Logged in as</p>
                                <p class="text-sm font-medium text-zinc-900 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile') }}" class="group flex items-center px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900">Profil Saya</a>
                                <a href="{{ route('rentals.list') }}" class="group flex items-center px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900">Daftar pesanan</a>
                            </div>
                            <div class="py-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="group flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full bg-zinc-900 text-white font-medium text-sm hover:bg-zinc-800 transition-colors shadow-sm">
                        Login
                    </a>
                @endauth
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
            
            if (!btn || !menu) return;

            if (btn.contains(e.target)) {
                // If clicked on button, toggle the menu
                menu.classList.toggle('hidden');
            } else if (!menu.contains(e.target)) {
                // If clicked outside button AND menu, close the menu
                menu.classList.add('hidden');
            }
        });
    }
</script>