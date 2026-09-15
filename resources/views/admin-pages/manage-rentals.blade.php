@extends('layouts.admin')

@section('title', 'Daftar Transaksi')
@section('header_title', 'Daftar Transaksi')
@section('header_subtitle', 'Kelola dan pantau seluruh transaksi rental.')

@section('content')
        <div class="max-w-7xl mx-auto space-y-6">
            
            <!-- SEARCH & SORT -->
            <div class="bg-white p-3 sm:p-4 rounded-2xl border border-zinc-200/80 shadow-2xs flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                        <i class="ti ti-search text-base"></i>
                    </div>
                    <input 
                        type="text" 
                        id="searchInput" 
                        onkeyup="filterRentals()" 
                        class="w-full pl-10 pr-4 py-2 bg-zinc-50 border border-zinc-200/80 rounded-xl focus:bg-white focus:outline-none focus:border-zinc-400 focus:ring-2 focus:ring-zinc-900/5 transition-all text-xs sm:text-sm font-medium" 
                        placeholder="Cari berdasarkan nama penyewa atau booking ID..."
                    >
                </div>

                <div class="flex items-center gap-2 self-end sm:self-auto shrink-0">
                    <label for="sortSelect" class="text-xs font-semibold text-zinc-400 whitespace-nowrap">Urutkan:</label>
                    <select 
                        id="sortSelect" 
                        onchange="sortRentals()" 
                        class="px-3 py-2 bg-zinc-50 border border-zinc-200/80 rounded-xl focus:bg-white focus:outline-none focus:border-zinc-400 text-xs font-semibold text-zinc-700 cursor-pointer transition-colors shadow-2xs"
                    >
                        <option value="desc">Terbaru Ditambahkan</option>
                        <option value="asc">A - Z (Nama Penyewa)</option>
                        <option value="desc_name">Z - A (Nama Penyewa)</option>
                    </select>
                </div>
            </div>

            <!-- STATUS FILTER PILLS -->
            <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-1">
                <button class="filter-btn active whitespace-nowrap px-4 py-2 rounded-full text-xs font-semibold transition-all bg-zinc-900 text-white shadow-2xs cursor-pointer" onclick="setFilter('all', this)">
                    Semua Transaksi ({{ $rentals->count() }})
                </button>
                <button class="filter-btn whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium transition-all bg-white text-zinc-600 border border-zinc-200/90 hover:bg-zinc-50 hover:text-zinc-900 cursor-pointer" onclick="setFilter('pending', this)">
                    Pending ({{ $rentals->where('status', 'pending')->count() }})
                </button>
                <button class="filter-btn whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium transition-all bg-white text-zinc-600 border border-zinc-200/90 hover:bg-zinc-50 hover:text-zinc-900 cursor-pointer" onclick="setFilter('ongoing', this)">
                    Sedang Disewa ({{ $rentals->where('status', 'ongoing')->count() }})
                </button>
                <button class="filter-btn whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium transition-all bg-white text-zinc-600 border border-zinc-200/90 hover:bg-zinc-50 hover:text-zinc-900 cursor-pointer" onclick="setFilter('completed', this)">
                    Selesai ({{ $rentals->where('status', 'completed')->count() }})
                </button>
                <button class="filter-btn whitespace-nowrap px-4 py-2 rounded-full text-xs font-medium transition-all bg-white text-zinc-600 border border-zinc-200/90 hover:bg-zinc-50 hover:text-zinc-900 cursor-pointer" onclick="setFilter('cancelled', this)">
                    Dibatalkan ({{ $rentals->where('status', 'cancelled')->count() }})
                </button>
            </div>

            <!-- RENTAL LIST -->
            <div class="space-y-3.5" id="rentalList">
                @forelse ($rentals as $rental)
                    @php $firstItem = $rental->rentalItems->first(); @endphp
                    
                    <div class="rental-card group bg-white rounded-2xl border border-zinc-200/80 p-5 sm:p-6 flex flex-col md:flex-row md:items-center justify-between gap-5 hover:border-zinc-300 hover:shadow-xs transition-all"
                         data-status="{{ $rental->status }}"
                         data-name="{{ strtolower($rental->user->nama ?? '') }}"
                         data-id="{{ $rental->id }}">
                        
                        <!-- Gambar & Info Produk -->
                        <div class="flex items-center gap-4 w-full md:w-5/12">
                            <div class="w-16 h-16 rounded-xl bg-zinc-100 flex items-center justify-center shrink-0 border border-zinc-200/70 overflow-hidden">
                                @if ($firstItem && $firstItem->product->gambar)
                                    <img src="{{ asset('storage/' . $firstItem->product->gambar) }}" alt="{{ $firstItem->product->nama_produk }}" class="w-full h-full object-cover">
                                @else
                                    <i class="ti ti-camera text-2xl text-zinc-300"></i>
                                @endif
                            </div>
                            <div class="overflow-hidden">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <span class="font-mono text-[11px] font-bold text-zinc-400">#{{ $rental->id }}</span>
                                    @if ($rental->rentalItems->count() > 1)
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-zinc-100 text-zinc-600">
                                            +{{ $rental->rentalItems->count() - 1 }} item lain
                                        </span>
                                    @endif
                                </div>
                                <h3 class="font-semibold text-zinc-900 text-sm truncate leading-snug" title="{{ $firstItem ? $firstItem->product->nama_produk : '-' }}">
                                    {{ $firstItem ? $firstItem->product->nama_produk : '-' }}
                                </h3>
                                <div class="text-[11px] text-zinc-400 font-medium flex items-center gap-1 mt-1">
                                    <i class="ti ti-calendar text-xs"></i>
                                    <span>{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }} – {{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Info Grid (Penyewa, Biaya, Status, Aksi) -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 w-full md:w-7/12 items-center">
                            <!-- Penyewa -->
                            <div>
                                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Penyewa</span>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="w-6 h-6 rounded-full bg-zinc-100 text-zinc-700 font-bold text-[10px] flex items-center justify-center border border-zinc-200/70 shrink-0">
                                        {{ substr($rental->user->nama ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="text-xs font-semibold text-zinc-800 truncate" title="{{ $rental->user->nama }}">
                                        {{ $rental->user->nama ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Total Biaya -->
                            <div>
                                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Total Tagihan</span>
                                <p class="text-xs sm:text-sm font-bold text-zinc-900 font-mono tabular-nums mt-1">
                                    Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Status Rental -->
                            <div>
                                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Status</span>
                                <div class="mt-1">
                                    @if($rental->status == 'pending')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @elseif($rental->status == 'ongoing')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-zinc-900 text-white gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                                            Sedang Disewa
                                        </span>
                                    @elseif($rental->status == 'completed')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200/80 gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-zinc-100 text-zinc-600 border border-zinc-200/80 gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span>
                                            Dibatalkan
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Aksi -->
                            <div class="text-right sm:text-right">
                                <a href="{{ route('admin.rentals.show', $rental->id) }}" class="inline-flex items-center gap-1 px-3.5 py-2 bg-zinc-900 hover:bg-zinc-800 text-white rounded-xl text-xs font-semibold transition-all shadow-2xs whitespace-nowrap">
                                    <span>Detail</span>
                                    <span class="text-zinc-400">&rarr;</span>
                                </a>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="bg-white rounded-3xl border border-zinc-200/80 border-dashed p-12 sm:p-16 flex flex-col items-center justify-center text-center shadow-2xs">
                        <div class="w-14 h-14 bg-zinc-100 rounded-2xl flex items-center justify-center mb-3 text-zinc-400 text-2xl shadow-2xs">
                            <i class="ti ti-file-text"></i>
                        </div>
                        <h3 class="text-base font-bold text-zinc-900 mb-1">Belum Ada Transaksi</h3>
                        <p class="text-xs text-zinc-400">Belum ada pesanan penyewaan yang masuk ke sistem.</p>
                    </div>
                @endforelse
            </div>

            <!-- Empty Search State -->
            <div id="noRentalMatch" class="hidden bg-white rounded-3xl border border-zinc-200/80 border-dashed p-12 text-center shadow-2xs">
                <div class="w-12 h-12 bg-zinc-100 rounded-2xl flex items-center justify-center mx-auto mb-3 text-zinc-400 text-xl">
                    <i class="ti ti-search"></i>
                </div>
                <h4 class="text-sm font-bold text-zinc-900 mb-1">Transaksi Tidak Ditemukan</h4>
                <p class="text-xs text-zinc-400 mb-4">Tidak ada transaksi yang cocok dengan filter atau kata kunci pencarian Anda.</p>
                <button onclick="document.getElementById('searchInput').value = ''; setFilter('all', document.querySelector('.filter-btn'));" class="px-4 py-2 bg-zinc-100 hover:bg-zinc-200 text-zinc-700 rounded-xl text-xs font-semibold transition-colors cursor-pointer">
                    Reset Filter & Pencarian
                </button>
            </div>

        </div>

<script>
    let activeFilter = 'all';

    function setFilter(status, btn) {
        activeFilter = status;
        
        // Update button styles
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('bg-zinc-900', 'text-white', 'shadow-2xs', 'font-semibold');
            b.classList.add('bg-white', 'text-zinc-600', 'border', 'border-zinc-200/90', 'hover:bg-zinc-50', 'hover:text-zinc-900', 'font-medium');
        });
        btn.classList.remove('bg-white', 'text-zinc-600', 'border', 'border-zinc-200/90', 'hover:bg-zinc-50', 'hover:text-zinc-900', 'font-medium');
        btn.classList.add('bg-zinc-900', 'text-white', 'shadow-2xs', 'font-semibold');
        
        applyFilters();
    }

    function filterRentals() { applyFilters(); }

    function applyFilters() {
        const q = document.getElementById('searchInput').value.toLowerCase().trim();
        const cards = document.querySelectorAll('#rentalList .rental-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const matchStatus = activeFilter === 'all' || card.dataset.status === activeFilter;
            const name = card.dataset.name || '';
            const id = card.dataset.id || '';
            const matchQuery = name.includes(q) || id.includes(q);

            if (matchStatus && matchQuery) {
                card.classList.remove('hidden');
                card.classList.add('flex');
                visibleCount++;
            } else {
                card.classList.add('hidden');
                card.classList.remove('flex');
            }
        });

        const noMatch = document.getElementById('noRentalMatch');
        if (noMatch) {
            if (visibleCount === 0 && cards.length > 0) {
                noMatch.classList.remove('hidden');
            } else {
                noMatch.classList.add('hidden');
            }
        }
    }

    function sortRentals() {
        const list = document.getElementById('rentalList');
        const cards = [...list.querySelectorAll('.rental-card')];
        const val = document.getElementById('sortSelect').value;
        
        cards.sort((a, b) => {
            if (val === 'asc') {
                return (a.dataset.name || '').localeCompare(b.dataset.name || '');
            } else if (val === 'desc_name') {
                return (b.dataset.name || '').localeCompare(a.dataset.name || '');
            } else {
                // By ID descending (newest)
                return parseInt(b.dataset.id || 0) - parseInt(a.dataset.id || 0);
            }
        });
        
        cards.forEach(c => list.appendChild(c));
    }
</script>
@endsection
