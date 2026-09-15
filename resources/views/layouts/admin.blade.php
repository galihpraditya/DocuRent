<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') – DocuRent</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <!-- NProgress CSS -->
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- HTMX for Instant Navigation -->
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
    
    <!-- NProgress JS -->
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>

    <script>
        // HTMX NProgress Integration
        document.addEventListener('htmx:beforeRequest', function() {
            NProgress.start();
        });
        document.addEventListener('htmx:afterRequest', function() {
            NProgress.done();
        });
        document.addEventListener('htmx:beforeHistorySave', function() {
            const np = document.getElementById('nprogress');
            if (np) np.remove();
        });
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', 'Outfit', sans-serif; }
        
        /* Minimalist NProgress Colors */
        #nprogress .bar {
            background: #18181b !important;
            height: 3px !important;
        }
        #nprogress .peg {
            box-shadow: 0 0 8px #18181b, 0 0 4px #18181b !important;
        }
        #nprogress .spinner-icon {
            border-top-color: #18181b !important;
            border-left-color: #18181b !important;
        }
    </style>
</head>
<body hx-boost="true" class="bg-zinc-50/50 text-zinc-900 h-screen overflow-hidden flex selection:bg-zinc-900 selection:text-white">

    <!-- OVERLAY (For Mobile) -->
    <div id="mobile-overlay" class="fixed inset-0 bg-zinc-950/40 backdrop-blur-xs z-40 hidden md:hidden transition-opacity opacity-0" onclick="toggleSidebar()"></div>

    <!-- SIDEBAR -->
    <aside id="admin-sidebar" class="w-64 bg-white border-r border-zinc-200/80 flex flex-col justify-between h-full shrink-0 shadow-2xs z-50 fixed md:static transform -translate-x-full md:translate-x-0 transition-transform duration-300">
        <div>
            <!-- LOGO BRANDING -->
            <div class="h-16 sm:h-20 flex items-center px-5 sm:px-6 border-b border-zinc-100 justify-between">
                <a href="{{ route('home') }}" hx-boost="false" class="flex items-center gap-2.5 group">
                    <div class="w-8 h-8 rounded-xl bg-zinc-900 text-white flex items-center justify-center font-bold text-xs tracking-tighter shadow-2xs group-hover:scale-105 transition-transform">
                        DR
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-base font-bold tracking-tight text-zinc-900">DocuRent<span class="text-zinc-400 font-normal">.</span></span>
                        <span class="px-1.5 py-0.5 rounded-md bg-zinc-100 text-zinc-600 text-[9px] font-bold uppercase tracking-wider border border-zinc-200/70">Admin</span>
                    </div>
                </a>
                <!-- Close Button (Mobile Only) -->
                <button onclick="toggleSidebar()" class="md:hidden w-8 h-8 flex items-center justify-center rounded-xl bg-zinc-100 text-zinc-500 hover:text-zinc-900 hover:bg-zinc-200 transition-colors cursor-pointer" aria-label="Tutup Menu">
                    <i class="ti ti-x text-base"></i>
                </button>
            </div>
            
            <!-- NAV -->
            <nav class="p-4 space-y-1.5 mt-2">
                <p class="px-3 text-[10px] font-bold text-zinc-400 tracking-wider uppercase mb-2.5">Menu Utama</p>
                
                <a href="{{ route('dashboard') }}" class="flex items-center justify-between px-3.5 py-2.5 {{ Request::is('admin') ? 'bg-zinc-900 text-white shadow-2xs font-semibold' : 'text-zinc-600 hover:text-zinc-900 hover:bg-zinc-100/80 font-medium' }} rounded-xl text-xs transition-all group" onclick="if(window.innerWidth < 768) toggleSidebar()">
                    <div class="flex items-center">
                        <i class="ti ti-layout-dashboard text-base mr-2.5 {{ Request::is('admin') ? 'text-white' : 'text-zinc-400 group-hover:text-zinc-900 transition-colors' }}"></i> 
                        <span>Dashboard</span>
                    </div>
                    @if(Request::is('admin'))
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    @endif
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="flex items-center justify-between px-3.5 py-2.5 {{ Request::is('admin/products*') ? 'bg-zinc-900 text-white shadow-2xs font-semibold' : 'text-zinc-600 hover:text-zinc-900 hover:bg-zinc-100/80 font-medium' }} rounded-xl text-xs transition-all group" onclick="if(window.innerWidth < 768) toggleSidebar()">
                    <div class="flex items-center">
                        <i class="ti ti-package text-base mr-2.5 {{ Request::is('admin/products*') ? 'text-white' : 'text-zinc-400 group-hover:text-zinc-900 transition-colors' }}"></i> 
                        <span>Manajemen Produk</span>
                    </div>
                </a>
                
                <a href="{{ route('admin.rentals.index') }}" class="flex items-center justify-between px-3.5 py-2.5 {{ Request::is('admin/rentals*') ? 'bg-zinc-900 text-white shadow-2xs font-semibold' : 'text-zinc-600 hover:text-zinc-900 hover:bg-zinc-100/80 font-medium' }} rounded-xl text-xs transition-all group" onclick="if(window.innerWidth < 768) toggleSidebar()">
                    <div class="flex items-center">
                        <i class="ti ti-file-text text-base mr-2.5 {{ Request::is('admin/rentals*') ? 'text-white' : 'text-zinc-400 group-hover:text-zinc-900 transition-colors' }}"></i> 
                        <span>Daftar Transaksi</span>
                    </div>
                </a>
            </nav>
        </div>

        <!-- SIDEBAR BOTTOM -->
        <div class="p-4 border-t border-zinc-100 bg-zinc-50/40">
            <div class="flex items-center p-2.5 bg-white border border-zinc-200/80 rounded-xl mb-3 shadow-2xs">
                <div class="w-8 h-8 rounded-full bg-zinc-900 text-white flex items-center justify-center mr-2.5 font-bold text-[11px] shadow-2xs shrink-0">
                    AD
                </div>
                <div class="overflow-hidden min-w-0 flex-1">
                    <p class="text-xs font-bold text-zinc-900 truncate leading-tight">{{ auth()->user()->nama ?? 'Administrator' }}</p>
                    <p class="text-[10px] text-zinc-400 truncate mt-0.5">{{ auth()->user()->email ?? 'admin@gmail.com' }}</p>
                </div>
            </div>
            
            <div class="space-y-1.5">
                <a href="{{ route('home') }}" hx-boost="false" class="w-full flex items-center justify-center px-3 py-2 border border-zinc-200/90 bg-white text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900 rounded-xl text-xs font-medium transition-all shadow-2xs">
                    <i class="ti ti-external-link text-sm mr-1.5 text-zinc-400"></i> Ke Website Utama
                </a>

                <form action="{{ route('logout') }}" method="POST" hx-boost="false" id="logout-form">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-3 py-2 border border-transparent text-zinc-500 hover:text-rose-600 hover:bg-rose-50/50 rounded-xl text-xs font-medium transition-colors cursor-pointer">
                        <i class="ti ti-logout text-sm mr-1.5"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 h-full overflow-y-auto bg-[#FCFCFC] relative">
        <!-- TOPBAR -->
        <header class="h-16 sm:h-20 bg-white/90 backdrop-blur-md border-b border-zinc-200/80 flex items-center justify-between px-3.5 sm:px-6 md:px-8 sticky top-0 z-20 shrink-0">
            <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0 flex-1 mr-2">
                <!-- Hamburger Menu (Mobile) -->
                <button onclick="toggleSidebar()" class="md:hidden w-9 h-9 rounded-xl border border-zinc-200 bg-white text-zinc-700 flex items-center justify-center hover:bg-zinc-50 hover:text-zinc-900 transition-colors shadow-2xs shrink-0 cursor-pointer" aria-label="Buka Menu">
                    <i class="ti ti-menu-2 text-lg"></i>
                </button>
                
                <div class="min-w-0">
                    <h1 class="text-sm sm:text-base md:text-lg font-bold text-zinc-900 tracking-tight leading-snug truncate">@yield('header_title')</h1>
                    <p class="text-xs text-zinc-500 font-normal mt-0.5 truncate hidden sm:block">@yield('header_subtitle')</p>
                </div>
            </div>
            <div class="flex items-center gap-1.5 sm:gap-2.5 shrink-0">
                @yield('header_actions')
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <div class="p-4 md:p-8 max-w-7xl space-y-6">
            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-semibold flex items-center justify-between shadow-2xs">
                    <div class="flex items-center gap-2">
                        <i class="ti ti-circle-check text-base text-emerald-600"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 cursor-pointer">
                        <i class="ti ti-x text-sm"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200/80 text-rose-800 text-xs font-semibold flex items-center justify-between shadow-2xs">
                    <div class="flex items-center gap-2">
                        <i class="ti ti-alert-circle text-base text-rose-600"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-900 cursor-pointer">
                        <i class="ti ti-x text-sm"></i>
                    </button>
                </div>
            @endif

            @yield('content')
        </div>
        
    </main>

    <script>
        // Mobile Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('mobile-overlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }
    </script>

    @include('components.confirm-modal')
</body>
</html>
