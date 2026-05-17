<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Transaksi – DocuRent</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.30.0/dist/tabler-icons.min.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg: #f2f2f0; --sidebar-bg: #fff; --card-bg: #fff;
      --text-primary: #1a1a1a; --text-secondary: #6b6b6b; --text-muted: #a0a0a0;
      --border: rgba(0,0,0,0.08); --active-bg: #f0f0ee;
      --btn-dark: #1a1a1a; --btn-dark-text: #fff;
      --radius-md: 10px; --radius-lg: 14px; --radius-pill: 999px;
      --font: 'Segoe UI', system-ui, sans-serif;
    }
    body { font-family: var(--font); background: var(--bg); color: var(--text-primary); display: flex; height: 100vh; overflow: hidden; }

    /* ── SIDEBAR ── */
    .sidebar { width: 220px; min-width: 220px; background: var(--sidebar-bg); border-right: 1px solid var(--border); display: flex; flex-direction: column; padding: 20px 0; }
    .logo { display: flex; align-items: center; gap: 10px; padding: 0 20px 28px; }
    .logo-icon { width: 36px; height: 36px; border-radius: 50%; border: 1px solid var(--border); background: #f5f5f3; display: flex; align-items: center; justify-content: center; }
    .logo-icon i { font-size: 18px; color: var(--text-primary); }
    .logo-text { font-size: 15px; font-weight: 600; }
    .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 16px; margin: 2px 10px; border-radius: var(--radius-md); color: var(--text-secondary); font-size: 14px; text-decoration: none; transition: background 0.15s, color 0.15s; }
    .nav-item i { font-size: 19px; }
    .nav-item:hover { background: var(--active-bg); color: var(--text-primary); }
    .nav-item.active { background: var(--active-bg); color: var(--text-primary); font-weight: 600; }
    .sidebar-bottom { margin-top: auto; padding: 16px 20px; border-top: 1px solid var(--border); }
    .admin-row { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; }
    .admin-avatar { width: 32px; height: 32px; border-radius: 50%; background: #f0f0ee; border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; }
    .admin-avatar i { font-size: 16px; color: var(--text-secondary); }
    .admin-name { font-size: 14px; font-weight: 500; }
    .btn-logout { width: 100%; padding: 10px; background: var(--btn-dark); color: var(--btn-dark-text); border: none; border-radius: var(--radius-pill); font-size: 13px; font-weight: 600; cursor: pointer; }
    .btn-logout:hover { opacity: 0.85; }

    /* ── CONTENT ── */
    .content { flex: 1; overflow-y: auto; padding: 28px 32px; }

    /* Search + Sort */
    .top-bar { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
    .search-wrap { flex: 1; display: flex; align-items: center; gap: 10px; background: #fff; border: 1px solid var(--border); border-radius: var(--radius-pill); padding: 9px 18px; }
    .search-wrap i { font-size: 17px; color: var(--text-muted); }
    .search-wrap input { border: none; outline: none; background: transparent; font-size: 14px; color: var(--text-primary); flex: 1; }
    .search-wrap input::placeholder { color: var(--text-muted); }
    .sort-wrap { display: flex; align-items: center; gap: 8px; background: #fff; border: 1px solid var(--border); border-radius: var(--radius-pill); padding: 9px 16px; min-width: 160px; cursor: pointer; }
    .sort-wrap i { font-size: 17px; color: var(--text-muted); }
    .sort-wrap select { border: none; outline: none; background: transparent; font-size: 14px; color: var(--text-primary); cursor: pointer; flex: 1; }

    /* Status Filter */
    .filter-bar { display: flex; align-items: center; gap: 8px; margin-bottom: 24px; flex-wrap: wrap; }
    .filter-label { font-size: 14px; font-weight: 500; color: var(--text-primary); margin-right: 4px; }
    .filter-btn { padding: 7px 18px; border-radius: var(--radius-pill); border: 1.5px solid var(--border); background: #fff; font-size: 13px; color: var(--text-secondary); cursor: pointer; transition: all 0.15s; font-family: var(--font); }
    .filter-btn:hover { border-color: var(--text-primary); color: var(--text-primary); }
    .filter-btn.active { background: #5a6375; color: #fff; border-color: #5a6375; font-weight: 600; }

    /* ── RENTAL CARDS ── */
    .rental-list { display: flex; flex-direction: column; gap: 12px; }

    .rental-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      padding: 16px 20px;
      display: flex;
      align-items: center;
      gap: 20px;
      transition: box-shadow 0.15s;
    }
    .rental-card:hover { box-shadow: 0 2px 12px rgba(0,0,0,0.07); }

    /* Gambar produk */
    .rental-img {
      width: 80px; height: 70px; border-radius: var(--radius-md);
      overflow: hidden; background: #e8e8e6; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center;
    }
    .rental-img img { width: 100%; height: 100%; object-fit: cover; }
    .rental-img i { font-size: 28px; color: #bbb; }

    /* Info produk */
    .rental-product { flex: 1.2; min-width: 0; padding-right: 30px;}
    .rental-product-name { font-size: 14px; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .rental-product-sub { font-size: 12px; color: var(--text-secondary); margin-top: 3px; }
    .rental-product-date { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

    /* Kolom info */
    .rental-col { flex: 1; }
    .rental-col-label { font-size: 11px; color: var(--text-muted); margin-bottom: 3px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.04em; }
    .rental-col-value { font-size: 13px; font-weight: 500; color: var(--text-primary); }

    /* Status badge */
    .status-badge {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 4px 12px; border-radius: var(--radius-pill);
      font-size: 12px; font-weight: 600;
    }
    .status-badge.pending    { background: #fff8e1; color: #f59f00; }
    .status-badge.ongoing    { background: #e3f2fd; color: #1971c2; }
    .status-badge.completed  { background: #ebfbee; color: #2f9e44; }
    .status-badge.cancelled  { background: #fff5f5; color: #d63031; }
    .status-badge.verified   { background: #ebfbee; color: #2f9e44; }
    .status-badge.unverified { background: #fff8e1; color: #f59f00; }

    /* Tombol aksi */
    .rental-actions { display: flex; flex-direction: column; gap: 8px; flex-shrink: 0; }
    .btn-confirm {
      padding: 8px 18px; border-radius: var(--radius-pill);
      background: #5a6375; color: #fff; border: none;
      font-size: 12px; font-weight: 600; cursor: pointer;
      white-space: nowrap; transition: opacity 0.15s; text-decoration: none;
      display: inline-block; text-align: center;
    }
    .btn-confirm:hover { opacity: 0.85; }
    .btn-detail {
      padding: 8px 18px; border-radius: var(--radius-pill);
      background: var(--btn-dark); color: #fff; border: none;
      font-size: 12px; font-weight: 600; cursor: pointer;
      white-space: nowrap; text-decoration: none;
      display: inline-block; text-align: center; transition: opacity 0.15s;
    }
    .btn-detail:hover { opacity: 0.82; }
    .btn-cancel {
      padding: 8px 18px; border-radius: var(--radius-pill);
      background: #fff; color: #d63031; border: 1.5px solid #d63031;
      font-size: 12px; font-weight: 600; cursor: pointer;
      white-space: nowrap; transition: background 0.15s, color 0.15s; text-align: center;
    }
    .btn-cancel:hover { background: #d63031; color: #fff; }

    /* Empty state */
    .empty-state { text-align: center; padding: 60px 0; color: var(--text-muted); }
    .empty-state i { font-size: 48px; display: block; margin-bottom: 12px; }

    /* ── LOGOUT MODAL ── */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 999; align-items: center; justify-content: center; }
    .modal-overlay.show { display: flex; }
    .modal-box { background: #5a5a5a; border-radius: 18px; padding: 32px 28px 24px; width: 340px; text-align: center; animation: popIn 0.18s ease; }
    @keyframes popIn { from { transform: scale(0.92); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .modal-box p { color: #fff; font-size: 16px; font-weight: 600; margin-bottom: 28px; line-height: 1.5; }
    .modal-actions { display: flex; gap: 14px; }
    .btn-modal-no { flex: 1; padding: 12px; background: #d0d0d0; color: #1a1a1a; border: none; border-radius: var(--radius-pill); font-size: 15px; font-weight: 700; cursor: pointer; }
    .btn-modal-no:hover { background: #bbb; }
    .btn-modal-yes { flex: 1; padding: 12px; background: #d63031; color: #fff; border: none; border-radius: var(--radius-pill); font-size: 15px; font-weight: 700; cursor: pointer; }
    .btn-modal-yes:hover { background: #b52828; }
  </style>
</head>
<body>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="logo">
      <div class="logo-icon"><i class="ti ti-camera"></i></div>
      <span class="logo-text">DocuRent</span>
    </div>
    <nav>
      <a href="{{ route('dashboard') }}" class="nav-item">
        <i class="ti ti-layout-dashboard"></i> Dashboard
      </a>
      <a href="{{ route('admin.products.index') }}" class="nav-item">
        <i class="ti ti-package"></i> Manajemen Produk
      </a>
      <a href="{{ route('admin.rentals.index') }}" class="nav-item active">
        <i class="ti ti-file-text"></i> Daftar Transaksi
      </a>
    </nav>
    <div class="sidebar-bottom">
      <div class="admin-row">
        <div class="admin-avatar"><i class="ti ti-user"></i></div>
        <span class="admin-name">Admin</span>
      </div>
      <button class="btn-logout" onclick="openLogout()">Log Out</button>
    </div>
  </aside>

  <!-- CONTENT -->
  <div class="content">

    <!-- Search + Sort -->
    <div class="top-bar">
      <div class="search-wrap">
        <i class="ti ti-search"></i>
        <input type="text" id="searchInput" placeholder="Cari transaksi berdasarkan nama user"
               onkeyup="filterRentals()">
      </div>
      <div class="sort-wrap">
        <i class="ti ti-arrows-sort"></i>
        <select id="sortSelect" onchange="sortRentals()">
          <option value="asc">Ascending</option>
          <option value="desc">Descending</option>
        </select>
      </div>
    </div>

    <!-- Filter Status -->
    <div class="filter-bar">
      <span class="filter-label">Status:</span>
      <button class="filter-btn active" onclick="setFilter('all', this)">Semua</button>
      <button class="filter-btn" onclick="setFilter('pending', this)">Pending</button>
      <button class="filter-btn" onclick="setFilter('ongoing', this)">Berlangsung</button>
      <button class="filter-btn" onclick="setFilter('completed', this)">Selesai</button>
      <button class="filter-btn" onclick="setFilter('cancelled', this)">Dibatalkan</button>
    </div>

    <!-- Daftar Rental -->
    <div class="rental-list" id="rentalList">
      @forelse ($rentals as $rental)

        {{-- Ambil item pertama untuk tampilan gambar & nama produk di kartu --}}
        @php $firstItem = $rental->rentalItems->first(); @endphp

        <div class="rental-card"
             data-status="{{ $rental->status }}"
             data-name="{{ strtolower($rental->user->nama ?? '') }}">

          <!-- Gambar produk pertama -->
          <div class="rental-img">
            @if ($firstItem && $firstItem->product->gambar)
              <img src="{{ asset('storage/' . $firstItem->product->gambar) }}"
                   alt="{{ $firstItem->product->nama_produk }}">
            @else
              <i class="ti ti-camera"></i>
            @endif
          </div>

          <!-- Info produk -->
          <div class="rental-product">
            <div class="rental-product-name">
              {{ $firstItem ? $firstItem->product->nama_produk : '-' }}
              @if ($rental->rentalItems->count() > 1)
                <span style="font-size:11px; color:var(--text-muted);">
                  +{{ $rental->rentalItems->count() - 1 }} item lain
                </span>
              @endif
            </div>
            <div class="rental-product-date">
              Tanggal sewa: {{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d/m/y') }}
              – {{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d/m/y') }}
            </div>
          </div>

          <!-- Penyewa -->
          <div class="rental-col">
            <div class="rental-col-label">Penyewa</div>
            <div class="rental-col-value">{{ $rental->user->nama ?? '-' }}</div>
          </div>

          <!-- Total Biaya -->
          <div class="rental-col">
            <div class="rental-col-label">Total Biaya Sewa</div>
            <div class="rental-col-value">Rp{{ number_format($rental->total_harga) }}</div>
          </div>

          <!-- Status -->
          <div class="rental-col">
            <div class="rental-col-label">Status</div>
            @php
              $statusMap = [
                'pending'   => ['label' => 'Pending',                        'class' => 'pending'],
                'ongoing'   => ['label' => 'Sedang Disewa',                  'class' => 'ongoing'],
                'completed' => ['label' => 'Selesai',                        'class' => 'completed']
              ];
              $s = $statusMap[$rental->status] ?? ['label' => ucfirst($rental->status), 'class' => 'pending'];
            @endphp
            <span class="status-badge {{ $s['class'] }}">{{ $s['label'] }}</span>
          </div>

            <a href="{{ route('admin.rentals.show', $rental->id) }}" class="btn-detail">
              Detail
            </a>
          </div>

      @empty
        <div class="empty-state">
          <i class="ti ti-file-text"></i>
          <p>Belum ada transaksi.</p>
        </div>
      @endforelse
    </div>

  </div>

  <!-- LOGOUT MODAL -->
  <div class="modal-overlay" id="logoutModal">
    <div class="modal-box">
      <p>Apakah Anda ingin keluar dari sesi ini?</p>
      <div class="modal-actions">
        <button class="btn-modal-no" onclick="closeLogout()">Tidak</button>
        <form action="{{ route('logout') }}" method="POST" style="flex:1;">
          @csrf
          <button type="submit" class="btn-modal-yes" style="width:100%;">Ya</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    function openLogout() { document.getElementById('logoutModal').classList.add('show'); }
    function closeLogout() { document.getElementById('logoutModal').classList.remove('show'); }
    document.getElementById('logoutModal').addEventListener('click', function(e) {
      if (e.target === this) closeLogout();
    });

    let activeFilter = 'all';

    function setFilter(status, btn) {
      activeFilter = status;
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      applyFilters();
    }

    function filterRentals() { applyFilters(); }

    function applyFilters() {
      const q = document.getElementById('searchInput').value.toLowerCase();
      document.querySelectorAll('#rentalList .rental-card').forEach(card => {
        const matchStatus = activeFilter === 'all' || card.dataset.status === activeFilter;
        const matchName   = card.dataset.name.includes(q);
        card.style.display = (matchStatus && matchName) ? '' : 'none';
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
</body>
</html>