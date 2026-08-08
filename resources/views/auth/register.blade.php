@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-5rem)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden bg-zinc-50">
    <!-- Background Decor -->
    <div class="absolute -top-40 -left-40 w-80 h-80 bg-rose-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute -bottom-40 -right-40 w-80 h-80 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    
    <div class="w-full max-w-[1000px] bg-white rounded-3xl shadow-2xl overflow-hidden relative z-10 flex flex-col md:flex-row">
        
        <!-- Image Section -->
        <div class="hidden md:block w-5/12 relative bg-zinc-900">
            <img src="https://images.unsplash.com/photo-1542044896530-05d85be9b11a?q=80&w=800&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-60" alt="Register">
            <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/90 to-transparent"></div>
            <div class="absolute bottom-12 left-10 right-10 text-white">
                <h3 class="text-3xl font-bold mb-3">Mulai Perjalanan Anda</h3>
                <p class="text-zinc-300 text-sm leading-relaxed">Bergabung dengan DocuRent dan nikmati kemudahan menyewa alat dokumentasi kelas profesional untuk setiap kebutuhan visual Anda.</p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-7/12 p-8 sm:p-12">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-zinc-900">Buat Akun Baru</h2>
                <p class="text-zinc-500 text-sm mt-1">Lengkapi data diri Anda di bawah ini</p>
            </div>

            @if ($errors->any())
                <div class="p-4 mb-6 text-sm text-rose-800 rounded-xl bg-rose-50 border border-rose-200">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/register" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-zinc-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-3 outline-none transition-colors">
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-medium text-zinc-700 mb-1">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-3 outline-none transition-colors">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-zinc-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-3 outline-none transition-colors">
                    </div>
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-zinc-700 mb-1">No. WhatsApp</label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-3 outline-none transition-colors">
                    </div>
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-medium text-zinc-700 mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" rows="2" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-3 outline-none transition-colors resize-none">{{ old('alamat') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="password" class="block text-sm font-medium text-zinc-700 mb-1">Password</label>
                        <input type="password" name="password" id="password" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-3 outline-none transition-colors">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-sm rounded-xl focus:ring-zinc-900 focus:border-zinc-900 block p-3 outline-none transition-colors">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-zinc-900 text-white rounded-xl py-3.5 font-semibold hover:bg-zinc-800 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <p class="mt-8 text-center text-sm text-zinc-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-zinc-900 hover:text-rose-600 transition-colors">Login di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection