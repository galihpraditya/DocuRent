@extends('layouts.app')

@section('content')
<div class="bg-zinc-50 py-12 md:py-24 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-zinc-500 mb-8 font-medium">
            <a href="{{ route('home') }}" class="hover:text-zinc-900 transition-colors">Beranda</a>
            <span class="mx-3 text-zinc-300">/</span>
            <span class="text-zinc-900">Profil Saya</span>
        </nav>

        <div class="bg-white rounded-[2rem] border border-zinc-200 shadow-sm overflow-hidden">
            <!-- Header Cover -->
            <div class="h-32 bg-gradient-to-r from-zinc-800 to-zinc-900 relative">
                <div class="absolute -bottom-12 left-8">
                    <img 
                        class="h-24 w-24 rounded-full border-4 border-white bg-white object-cover shadow-md" 
                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&size=150&background=0D8ABC&color=fff" 
                        alt="Avatar"
                    >
                </div>
            </div>

            <div class="pt-16 pb-8 px-8">
                <!-- User Info -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-zinc-900 tracking-tight">{{ auth()->user()->nama ?? auth()->user()->username }}</h1>
                    <p class="text-zinc-500 font-medium">{{ auth()->user()->email }}</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-zinc-100 text-zinc-700 border border-zinc-200">
                            Member DocuRent
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                            Akun Aktif
                        </span>
                    </div>
                </div>

                <div class="border-t border-zinc-100 my-6"></div>

                <!-- Menu Links -->
                <div class="space-y-3">
                    <a href="{{ route('rentals.list') }}" class="flex items-center justify-between p-4 rounded-xl border border-zinc-200 hover:border-zinc-300 hover:bg-zinc-50 transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-zinc-100 text-zinc-600 flex items-center justify-center group-hover:bg-zinc-200 group-hover:text-zinc-900 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-zinc-900">Daftar Pesanan Saya</h3>
                                <p class="text-sm text-zinc-500">Lihat riwayat dan status penyewaan Anda</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-zinc-400 group-hover:text-zinc-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="mt-6">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 p-4 rounded-xl border-2 border-rose-100 bg-rose-50 text-rose-600 font-bold hover:bg-rose-100 hover:border-rose-200 transition-all focus:outline-none focus:ring-4 focus:ring-rose-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Keluar dari Akun (Logout)
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
