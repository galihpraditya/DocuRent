@extends('layouts.admin')

@section('title', 'Daftar Transaksi')
@section('header_title', 'Daftar Transaksi')
@section('header_subtitle', 'Kelola dan pantau seluruh transaksi rental.')

@section('content')
        <div class="max-w-7xl mx-auto space-y-6">
            
            <!-- SEARCH & SORT -->
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1 bg-white p-2 rounded-3xl border border-zinc-200 shadow-sm flex items-center gap-2">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="ti ti-search text-zinc-400 text-lg"></i>
                        </div>
                        <input type="text" id="searchInput" onkeyup="filterRentals()" class="w-full pl-12 pr-4 py-2.5 bg-transparent border-none focus:outline-none transition-all text-sm font-medium" placeholder="Cari berdasarkan nama penyewa...">
                    </div>
                </div>
                <div class="bg-white p-2 rounded-3xl border border-zinc-200 shadow-sm flex items-center pr-4">
                    <div class="pl-4 flex items-center pointer-events-none">
                        <i class="ti ti-arrows-sort text-zinc-400 text-lg"></i>
                    </div>
                    <select id="sortSelect" onchange="sortRentals()" class="pl-2 pr-4 py-2.5 bg-transparent border-none focus:outline-none text-sm font-medium text-zinc-700 cursor-pointer">
                        <option value="asc">A - Z (Nama)</option>
                        <option value="desc">Z - A (Nama)</option>
                    </select>
                </div>
            </div>

            <!-- STATUS FILTER -->
            <div class="flex overflow-x-auto no-scrollbar gap-2 pb-2">
                <span class="flex items-center text-sm font-bold text-zinc-400 uppercase tracking-widest mr-2">Filter:</span>
                <button class="filter-btn active whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold transition-all bg-zinc-900 text-white shadow-md" onclick="setFilter('all', this)">Semua Transaksi</button>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold transition-all bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50" onclick="setFilter('pending', this)">Pending</button>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold transition-all bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50" onclick="setFilter('ongoing', this)">Berlangsung</button>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold transition-all bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50" onclick="setFilter('completed', this)">Selesai</button>
                <button class="filter-btn whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold transition-all bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50" onclick="setFilter('cancelled', this)">Dibatalkan</button>
            </div>

            <!-- RENTAL LIST -->
            <div class="space-y-4" id="rentalList">
                @forelse ($rentals as $rental)
                    @php $firstItem = $rental->rentalItems->first(); @endphp
                    
                    <div class="rental-card group bg-white rounded-3xl border border-zinc-200 p-6 flex flex-col md:flex-row md:items-center gap-6 hover:shadow-lg transition-all duration-300"
                         data-status="{{ $rental->status }}"
                         data-name="{{ strtolower($rental->user->nama ?? '') }}">
                        
                        <!-- Gambar & Info Produk -->
                        <div class="flex items-center gap-5 w-full md:w-2/5">
                            <div class="w-20 h-20 rounded-2xl bg-zinc-100 flex items-center justify-center shrink-0 border border-zinc-200 overflow-hidden">
                                @if ($firstItem && $firstItem->product->gambar)
                                    <img src="{{ asset('storage/' . $firstItem->product->gambar) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="ti ti-camera text-3xl text-zinc-300"></i>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-zinc-900 text-lg leading-tight mb-1">
                                    {{ $firstItem ? $firstItem->product->nama_produk : '-' }}
                                </h3>
                                @if ($rental->rentalItems->count() > 1)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-zinc-100 text-zinc-600 mb-2">
                                        +{{ $rental->rentalItems->count() - 1 }} item lainnya
                                    </span>
                                @endif
                                <div class="text-xs text-zinc-500 font-medium flex items-center">
                                    <i class="ti ti-calendar mr-1"></i>
                                    {{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d/m/y') }} – {{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d/m/y') }}
                                </div>
                            </div>
                        </div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 w-full md:w-3/5 items-center">
                            <div>
                                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1">Penyewa</p>
                                <p class="font-semibold text-zinc-900 flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center text-xs shrink-0">
                                        {{ substr($rental->user->nama, 0, 1) }}
                                    </span>
                                    {{ $rental->user->nama ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1">Total Biaya</p>
                                <p class="font-bold text-rose-500">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</p>
                            </div>

                            <div class="col-span-2 md:col-span-1 flex flex-col sm:flex-row md:flex-col lg:flex-row gap-3 items-start sm:items-center justify-between">
                                <div>
                                    <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mb-1 md:hidden lg:block">Status</p>
                                    @if($rental->status == 'pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600 mr-1.5 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @elseif($rental->status == 'ongoing')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600 mr-1.5"></span>
                                            Sedang Disewa
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
                                <a href="{{ route('admin.rentals.show', $rental->id) }}" class="px-5 py-2.5 bg-zinc-900 text-white rounded-xl text-xs font-bold hover:bg-zinc-800 transition-colors shadow-sm whitespace-nowrap">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="bg-white rounded-3xl border border-zinc-200 border-dashed p-16 flex flex-col items-center justify-center text-center shadow-sm">
                        <div class="w-20 h-20 bg-zinc-50 rounded-full flex items-center justify-center mb-6">
                            <i class="ti ti-file-text text-3xl text-zinc-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-900 mb-2">Tidak Ada Transaksi</h3>
                        <p class="text-zinc-500">Belum ada transaksi penyewaan yang sesuai dengan kriteria saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
@endsection

<script>
    let activeFilter = 'all';

    function setFilter(status, btn) {
        activeFilter = status;
        
        // Update button styles
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('bg-zinc-900', 'text-white', 'shadow-md');
            b.classList.add('bg-white', 'text-zinc-600', 'border', 'border-zinc-200', 'hover:bg-zinc-50');
        });
        btn.classList.remove('bg-white', 'text-zinc-600', 'border', 'border-zinc-200', 'hover:bg-zinc-50');
        btn.classList.add('bg-zinc-900', 'text-white', 'shadow-md');
        
        applyFilters();
    }

    function filterRentals() { applyFilters(); }

    function applyFilters() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('#rentalList .rental-card').forEach(card => {
            const matchStatus = activeFilter === 'all' || card.dataset.status === activeFilter;
            const matchName   = card.dataset.name.includes(q);
            if (matchStatus && matchName) {
                card.classList.remove('hidden');
                card.classList.add('flex');
            } else {
                card.classList.add('hidden');
                card.classList.remove('flex');
            }
        });
    }

    function sortRentals() {
        const list = document.getElementById('rentalList');
        const cards = [...list.querySelectorAll('.rental-card')];
        const asc = document.getElementById('sortSelect').value === 'asc';
        
        cards.sort((a, b) => {
            const na = a.dataset.name, nb = b.dataset.name;
            return asc ? na.localeCompare(nb) : nb.localeCompare(na);
        });
        
        cards.forEach(c => list.appendChild(c));
    }
</script>
