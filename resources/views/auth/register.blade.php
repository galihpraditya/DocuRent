@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-5rem)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#FCFCFC]">
    
    <div class="w-full max-w-4xl bg-white rounded-3xl border border-zinc-200/80 overflow-hidden shadow-2xs flex flex-col md:flex-row">
        
        <!-- Image / Brand Side -->
        <div class="hidden md:block w-5/12 relative bg-zinc-950">
            <img src="https://images.unsplash.com/photo-1542044896530-05d85be9b11a?q=80&w=800&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-50" alt="Register DocuRent">
            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/40 to-transparent"></div>
            <div class="absolute bottom-10 left-8 right-8 text-white">
                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block mb-2">DocuRent Membership</span>
                <h3 class="text-2xl font-bold tracking-tight mb-2">Mulai Kreasi Anda</h3>
                <p class="text-zinc-400 text-xs leading-relaxed">Daftarkan akun Anda untuk menyewa kamera, lensa, dan gear dokumentasi profesional dengan mudah.</p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="w-full md:w-7/12 p-8 sm:p-10 flex flex-col justify-center">
            <div class="mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 text-zinc-900 mb-4">
                    <div class="w-7 h-7 bg-zinc-900 text-white rounded-lg flex items-center justify-center">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <span class="font-bold text-sm tracking-tight text-zinc-900">DocuRent<span class="text-zinc-400 font-normal">.</span></span>
                </a>
                <h1 class="text-xl sm:text-2xl font-bold text-zinc-900 tracking-tight">Buat Akun Baru</h1>
                <p class="text-zinc-500 text-xs mt-0.5">Lengkapi identitas untuk memudahkan verifikasi sewa gear</p>
            </div>

            @if ($errors->any())
                <div class="p-3.5 mb-5 text-xs text-rose-800 rounded-xl bg-rose-50 border border-rose-200/80">
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/register" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label for="nama" class="block text-xs font-semibold text-zinc-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs rounded-xl focus:border-zinc-400 focus:bg-white p-2.5 outline-none transition-colors" placeholder="Nama sesuai KTP">
                    </div>
                    <div>
                        <label for="username" class="block text-xs font-semibold text-zinc-700 mb-1">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs rounded-xl focus:border-zinc-400 focus:bg-white p-2.5 outline-none transition-colors" placeholder="username">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label for="email" class="block text-xs font-semibold text-zinc-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs rounded-xl focus:border-zinc-400 focus:bg-white p-2.5 outline-none transition-colors" placeholder="nama@email.com">
                    </div>
                    <div>
                        <label for="no_hp" class="block text-xs font-semibold text-zinc-700 mb-1">No. WhatsApp Aktif</label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs rounded-xl focus:border-zinc-400 focus:bg-white p-2.5 outline-none transition-colors" placeholder="08xxxxxxxxxx">
                    </div>
                </div>

                <div>
                    <label for="alamat" class="block text-xs font-semibold text-zinc-700 mb-1">Alamat Domisili di Malang</label>
                    <textarea name="alamat" id="alamat" rows="2" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs rounded-xl focus:border-zinc-400 focus:bg-white p-2.5 outline-none transition-colors resize-none" placeholder="Alamat jalan, kelurahan, kecamatan...">{{ old('alamat') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label for="password" class="block text-xs font-semibold text-zinc-700 mb-1">Kata Sandi</label>
                        <input type="password" name="password" id="password" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs rounded-xl focus:border-zinc-400 focus:bg-white p-2.5 outline-none transition-colors" placeholder="Minimal 6 karakter">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-zinc-700 mb-1">Konfirmasi Sandi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full bg-zinc-50 border border-zinc-200 text-zinc-900 text-xs rounded-xl focus:border-zinc-400 focus:bg-white p-2.5 outline-none transition-colors" placeholder="Ulangi sandi">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-zinc-900 text-white rounded-xl py-3 text-xs font-semibold hover:bg-zinc-800 transition-colors shadow-2xs cursor-pointer">
                        Daftar Akun
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-xs text-zinc-500">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-semibold text-zinc-900 hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection