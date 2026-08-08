@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="max-w-4xl mx-auto">
        
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-zinc-900 tracking-tight">Pesanan Saya</h2>
                <p class="text-zinc-500 mt-2">Pantau dan kelola riwayat pesanan rental Anda di sini.</p>
            </div>
        </div>

        <!-- Filter Nav -->
        <div class="flex overflow-x-auto no-scrollbar gap-2 mb-8 pb-2">
            <a href="{{ route('rentals.list') }}" class="whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold transition-colors {{ !request()->segment(3) ? 'bg-zinc-900 text-white shadow-md' : 'bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50' }}">
                Semua Pesanan
            </a>
            <a href="{{ route('rentals.filter', 'pending') }}" class="whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold transition-colors {{ request()->segment(3) == 'pending' ? 'bg-zinc-900 text-white shadow-md' : 'bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50' }}">
                Pending
            </a>
            <a href="{{ route('rentals.filter', 'ongoing') }}" class="whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold transition-colors {{ request()->segment(3) == 'ongoing' ? 'bg-zinc-900 text-white shadow-md' : 'bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50' }}">
                Berlangsung
            </a>
            <a href="{{ route('rentals.filter', 'completed') }}" class="whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold transition-colors {{ request()->segment(3) == 'completed' ? 'bg-zinc-900 text-white shadow-md' : 'bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50' }}">
                Selesai
            </a>
            <a href="{{ route('rentals.filter', 'canceled') }}" class="whitespace-nowrap px-6 py-2.5 rounded-full text-sm font-semibold transition-colors {{ request()->segment(3) == 'canceled' ? 'bg-zinc-900 text-white shadow-md' : 'bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50' }}">
                Dibatalkan
            </a>
        </div>

        <!-- Order List -->
        <div class="space-y-6">
            @forelse($rentals as $rental)
                <div class="bg-white rounded-3xl border border-zinc-200 overflow-hidden hover:shadow-lg transition-all duration-300">
                    
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-zinc-100 bg-zinc-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white border border-zinc-200 flex items-center justify-center shrink-0 shadow-sm text-zinc-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <div>
                                <h6 class="font-bold text-zinc-900">Booking #{{ $rental->id }}</h6>
                                <p class="text-xs text-zinc-500">{{ \Carbon\Carbon::parse($rental->created_at)->format('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>

                        <div>
                            @if($rental->status == 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600 mr-1.5 animate-pulse"></span>
                                    Pending
                                </span>
                            @elseif($rental->status == 'ongoing')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 mr-1.5 animate-pulse"></span>
                                    Berlangsung
                                </span>
                            @elseif($rental->status == 'completed')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-600 mr-1.5"></span>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600 mr-1.5"></span>
                                    Dibatalkan
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-2">Periode Sewa</p>
                                <div class="flex items-center text-sm font-medium text-zinc-900 bg-zinc-50 rounded-lg p-3 border border-zinc-100 w-fit">
                                    {{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M') }} 
                                    <svg class="w-4 h-4 mx-2 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    {{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}
                                </div>
                            </div>
                            <div class="sm:text-right flex flex-col justify-center">
                                <p class="text-xs font-bold text-zinc-400 uppercase tracking-wider mb-1">Total Biaya</p>
                                <p class="text-xl font-bold text-rose-500">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-6 py-4 bg-white border-t border-zinc-100 flex justify-end">
                        <a href="{{ route('rentals.show', $rental->id) }}" class="px-6 py-2.5 bg-white border-2 border-zinc-200 text-zinc-900 rounded-xl text-sm font-bold hover:bg-zinc-50 hover:border-zinc-300 transition-colors shadow-sm">
                            Lihat Detail Pesanan
                        </a>
                    </div>

                </div>
            @empty
                <div class="bg-white rounded-3xl border border-zinc-200 border-dashed p-16 flex flex-col items-center justify-center text-center">
                    <div class="w-24 h-24 bg-zinc-50 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-2">Tidak Ada Pesanan</h3>
                    <p class="text-zinc-500 mb-8 max-w-md">Anda belum memiliki riwayat pesanan dengan status ini.</p>
                    <a href="{{ route('home') }}#catalog" class="px-8 py-3 bg-zinc-900 text-white rounded-xl font-semibold hover:bg-zinc-800 transition-colors shadow-lg">
                        Sewa Sekarang
                    </a>
                </div>
            @endforelse
        </div>

    </div>

</div>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection