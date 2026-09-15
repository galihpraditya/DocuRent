@extends('layouts.app')

@section('content')
<div class="bg-[#FCFCFC] py-10 sm:py-16 min-h-[calc(100vh-5rem)]">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-xs font-medium text-zinc-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-zinc-900">Profil Saya</span>
        </nav>

        <div class="bg-white rounded-3xl border border-zinc-200/80 shadow-2xs overflow-hidden">
            <!-- Header Cover Studio -->
            <div class="h-28 bg-zinc-900 relative">
                <div class="absolute -bottom-10 left-6 sm:left-8">
                    <img 
                        class="h-20 w-20 rounded-full border-4 border-white bg-zinc-100 object-cover shadow-2xs" 
                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&size=120&background=18181b&color=ffffff&bold=true" 
                        alt="{{ auth()->user()->username }}"
                    >
                </div>
            </div>

            <div class="pt-14 pb-8 px-6 sm:px-8">
                <!-- User Info -->
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-bold text-zinc-900 tracking-tight">{{ auth()->user()->nama ?? auth()->user()->username }}</h1>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                            Member Terverifikasi
                        </span>
                    </div>
                    <p class="text-xs text-zinc-500 mt-0.5">{{ auth()->user()->email }} &bull; @<span>{{ auth()->user()->username }}</span></p>
                    
                    @if(auth()->user()->no_hp)
                        <p class="text-xs text-zinc-400 mt-1">WhatsApp: {{ auth()->user()->no_hp }}</p>
                    @endif
                    @if(auth()->user()->alamat)
                        <p class="text-xs text-zinc-400 mt-0.5">Alamat: {{ auth()->user()->alamat }}</p>
                    @endif
                </div>

                <div class="border-t border-zinc-100 my-6"></div>

                <!-- Action Links -->
                <div class="space-y-3">
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" hx-boost="false" class="flex items-center justify-between p-4 rounded-2xl border border-zinc-200/80 hover:bg-zinc-50 transition-all group">
                            <div class="flex items-center gap-3.5">
                                <div class="w-9 h-9 rounded-xl bg-zinc-900 text-white flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-zinc-900 text-xs">Panel Dashboard Admin</h3>
                                    <p class="text-[11px] text-zinc-400">Kelola katalog produk, stok, dan verifikasi transaksi</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-zinc-400 group-hover:text-zinc-900 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    @endif

                    <a href="{{ route('rentals.list') }}" class="flex items-center justify-between p-4 rounded-2xl border border-zinc-200/80 hover:bg-zinc-50 transition-all group">
                        <div class="flex items-center gap-3.5">
                            <div class="w-9 h-9 rounded-xl bg-zinc-100 text-zinc-700 flex items-center justify-center group-hover:bg-zinc-200 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-zinc-900 text-xs">Riwayat Pesanan Saya</h3>
                                <p class="text-[11px] text-zinc-400">Lihat status sewa dan upload bukti transfer</p>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-zinc-400 group-hover:text-zinc-900 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="pt-3">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 rounded-xl border border-zinc-200 text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50 font-medium text-xs transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Keluar dari Akun
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
