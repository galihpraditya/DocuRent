@extends('layouts.app') 

@section('content')
<div class="min-h-[calc(100vh-5rem)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#FCFCFC]">
    
    <div class="w-full max-w-4xl bg-white rounded-3xl border border-zinc-200/80 overflow-hidden shadow-2xs flex flex-col md:flex-row">
        
        <!-- Image / Brand Side -->
        <div class="hidden md:block w-1/2 relative bg-zinc-950">
            <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=800&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-50" alt="Login DocuRent">
            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/40 to-transparent"></div>
            <div class="absolute bottom-10 left-8 right-8 text-white">
                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block mb-2">DocuRent Studio</span>
                <h3 class="text-2xl font-bold tracking-tight mb-2">Selamat Datang Kembali</h3>
                <p class="text-zinc-400 text-xs leading-relaxed">Masuk ke akun Anda untuk melanjutkan penyewaan gear kamera dan alat dokumentasi.</p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
            <div class="mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 text-zinc-900 mb-6">
                    <div class="w-8 h-8 bg-zinc-900 text-white rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <span class="font-bold text-base tracking-tight text-zinc-900">DocuRent<span class="text-zinc-400 font-normal">.</span></span>
                </a>
                <h1 class="text-xl sm:text-2xl font-bold text-zinc-900 tracking-tight">Masuk ke Akun</h1>
                <p class="text-zinc-500 text-xs mt-1">Masukkan alamat email dan kata sandi Anda</p>
            </div>

            @if(session('success'))
                <div class="p-3.5 mb-5 text-xs text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200/80">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="p-3.5 mb-5 text-xs text-rose-800 rounded-xl bg-rose-50 border border-rose-200/80">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST" hx-boost="false" class="space-y-4">
                @csrf 
                
                <div>
                    <label for="email" class="block text-xs font-semibold text-zinc-700 mb-1.5">Alamat Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}"
                        required 
                        autofocus 
                        class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs rounded-xl focus:border-zinc-400 focus:bg-white block p-3 outline-none transition-colors"
                        placeholder="nama@email.com"
                    >
                </div>
                
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-semibold text-zinc-700">Kata Sandi</label>
                        <a href="https://wa.me/0895630582664" target="_blank" class="text-[11px] font-medium text-zinc-400 hover:text-zinc-900">Bantuan lupa password?</a>
                    </div>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs rounded-xl focus:border-zinc-400 focus:bg-white block p-3 outline-none transition-colors"
                        placeholder="••••••••"
                    >
                </div>

                <div class="pt-2">
                    <button 
                        type="submit" 
                        class="w-full bg-zinc-900 text-white rounded-xl py-3 text-xs font-semibold hover:bg-zinc-800 transition-colors shadow-2xs cursor-pointer"
                    >
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <p class="mt-8 text-center text-xs text-zinc-500">
                Belum memiliki akun? 
                <a href="{{ route('register') }}" class="font-semibold text-zinc-900 hover:underline">Daftar akun gratis</a>
            </p>
        </div>
    </div>
</div>
@endsection