@extends('layouts.app') 

@section('content')
<div class="min-h-[calc(100vh-5rem)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden bg-zinc-50">
    <!-- Background Decor -->
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-rose-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    
    <div class="w-full max-w-[900px] bg-white rounded-3xl shadow-2xl overflow-hidden relative z-10 flex flex-col md:flex-row">
        
        <!-- Image Section -->
        <div class="hidden md:block w-1/2 relative bg-zinc-900">
            <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=800&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-60" alt="Login">
            <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/90 to-transparent"></div>
            <div class="absolute bottom-12 left-10 right-10 text-white">
                <h3 class="text-3xl font-bold mb-3">Selamat Datang Kembali!</h3>
                <p class="text-zinc-300 text-sm leading-relaxed">Masuk ke akun Anda untuk mulai menyewa perlengkapan dokumentasi terbaik untuk projek Anda selanjutnya.</p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-10 sm:p-14 flex flex-col justify-center">
            <div class="text-center mb-10">
                <div class="w-12 h-12 bg-zinc-900 text-white rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-zinc-900">Login ke Akun</h2>
                <p class="text-zinc-500 text-sm mt-2">Masukkan detail login Anda di bawah</p>
            </div>

            @if(session('success'))
                <div class="p-4 mb-6 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 mb-6 text-sm text-rose-800 rounded-xl bg-rose-50 border border-rose-200">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                @csrf 
                
                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" required autofocus class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-3.5 outline-none transition-colors">
                </div>
                
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-sm font-medium text-zinc-700">Password</label>
                        <a href="#" class="text-xs font-medium text-rose-600 hover:text-rose-500">Lupa password?</a>
                    </div>
                    <input type="password" name="password" id="password" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-3.5 outline-none transition-colors">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-zinc-900 text-white rounded-xl py-3.5 font-semibold hover:bg-zinc-800 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <p class="mt-8 text-center text-sm text-zinc-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-zinc-900 hover:text-rose-600 transition-colors">Daftar gratis</a>
            </p>
        </div>
    </div>
</div>
@endsection