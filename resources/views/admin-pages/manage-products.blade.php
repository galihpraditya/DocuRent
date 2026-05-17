<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Produk – DocuRent</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.30.0/dist/tabler-icons.min.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg: #f2f2f0; --sidebar-bg: #fff;
      --text-primary: #1a1a1a; --text-secondary: #6b6b6b; --text-muted: #a0a0a0;
      --border: rgba(0,0,0,0.08); --active-bg: #f0f0ee;
      --btn-dark: #1a1a1a; --btn-dark-text: #fff;
      --radius-sm: 6px; --radius-md: 10px; --radius-lg: 14px; --radius-pill: 999px;
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

    /* Search + Tambah sejajar */
    .top-bar { display: flex; align-items: center; gap: 12px; margin-bottom: 24px; }
    .search-wrap { flex: 1; display: flex; align-items: center; gap: 10px; background: #fff; border: 1px solid var(--border); border-radius: var(--radius-pill); padding: 9px 18px; }
    .search-wrap i { font-size: 17px; color: var(--text-muted); }
    .search-wrap input { border: none; outline: none; background: transparent; font-size: 14px; color: var(--text-primary); flex: 1; }
    .search-wrap input::placeholder { color: var(--text-muted); }
    .btn-tambah { display: flex; align-items: center; gap: 6px; background: var(--btn-dark); color: var(--btn-dark-text); text-decoration: none; padding: 10px 20px; border-radius: var(--radius-pill); font-size: 13px; font-weight: 600; white-space: nowrap; transition: opacity 0.15s; }
    .btn-tambah:hover { opacity: 0.82; }

    /* ── PRODUCT GRID ── */
    .product-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; }

    /* Card: gambar bisa diklik ke detail, tombol aksi di bawah */
    .product-card { background: #fff; border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border); display: flex; flex-direction: column; transition: box-shadow 0.15s, transform 0.15s; }
    .product-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.10); transform: translateY(-2px); }

    /* Area klik menuju detail */
    .product-link { display: block; text-decoration: none; color: inherit; }
    .product-thumb { width: 100%; aspect-ratio: 1/1; overflow: hidden; background: #e8e8e6; display: flex; align-items: center; justify-content: center; }
    .product-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.2s; }
    .product-link:hover .product-thumb img { transform: scale(1.04); }
    .product-thumb i { font-size: 36px; color: #bbb; }
    .product-info { padding: 10px 10px 4px; }
    .product-name { font-size: 13px; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .product-sub { font-size: 11px; color: var(--text-secondary); margin-top: 2px; }
    .product-hint { font-size: 10px; color: var(--text-muted); margin-top: 3px; }

    /* Tombol Edit & Hapus di bawah, TIDAK ikut klik ke detail */
    .product-actions { display: flex; gap: 6px; padding: 8px 10px 12px; }
    .btn-edit { flex: 1; display: flex; align-items: center; justify-content: center; gap: 4px; background: var(--btn-dark); color: #fff; text-decoration: none; padding: 7px 0; border-radius: var(--radius-sm); font-size: 12px; font-weight: 500; transition: opacity 0.15s; }
    .btn-edit:hover { opacity: 0.8; }
    .btn-edit i { font-size: 13px; }
    .btn-hapus { flex: 1; display: flex; align-items: center; justify-content: center; gap: 4px; background: #d63031; color: #fff; border: none; padding: 7px 0; border-radius: var(--radius-sm); font-size: 12px; font-weight: 500; cursor: pointer; width: 100%; transition: background 0.15s; }
    .btn-hapus:hover { background: #b52828; }
    .btn-hapus i { font-size: 13px; }

    /* Empty state */
    .empty-state { grid-column: 1 / -1; text-align: center; padding: 60px 0; color: var(--text-muted); }
    .empty-state i { font-size: 48px; display: block; margin-bottom: 12px; }
    .empty-state a { color: var(--text-primary); font-weight: 600; }

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
      <a href="{{ route('products.index') }}" class="nav-item active">
        <i class="ti ti-package"></i> Manajemen Produk
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

    <!-- Search + Tambah sejajar -->
    <div class="top-bar">
      <div class="search-wrap">
        <i class="ti ti-search"></i>
        <input type="text" id="searchInput" placeholder="Cari alat berdasarkan nama"
               onkeyup="filterProducts()">
      </div>
      <a href="{{ route('products.create') }}" class="btn-tambah">
        <i class="ti ti-plus"></i> Tambah Produk
      </a>
    </div>

    <!-- Grid produk -->
    <div class="product-grid" id="productGrid">
      @forelse ($products as $product)
        <div class="product-card" data-name="{{ strtolower($product->nama_produk) }}">

          {{-- Klik gambar/nama → ke halaman detail --}}
          <a href="{{ route('products.show', $product->id) }}" class="product-link">
            <div class="product-thumb">
              @if ($product->gambar)
                <img src="{{ asset('storage/' . $product->gambar) }}"
                     alt="{{ $product->nama_produk }}">
              @else
                <i class="ti ti-camera"></i>
              @endif
            </div>
            <div class="product-info">
              <div class="product-name">{{ $product->nama_produk }}</div>
              <div class="product-sub">Rp{{ number_format($product->harga_sewa) }}/hari &bull; Stok: {{ $product->stok }}</div>
              <div class="product-hint">Klik untuk lihat detail</div>
            </div>
          </a>

          {{-- Tombol Edit & Hapus — tidak ikut link ke detail --}}
          <div class="product-actions">
            <a href="{{ route('products.edit', $product->id) }}" class="btn-edit">
              <i class="ti ti-pencil"></i> Edit
            </a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')" style="flex:1; display:flex;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-hapus" style="flex:1;">
                <i class="ti ti-trash"></i> Hapus
              </button>
            </form>
          </div>

        </div>
      @empty
        <div class="empty-state">
          <i class="ti ti-package"></i>
          <p>Belum ada produk. <a href="{{ route('products.create') }}">Tambah sekarang</a></p>
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
    function filterProducts() {
      const q = document.getElementById('searchInput').value.toLowerCase();
      document.querySelectorAll('#productGrid .product-card').forEach(card => {
        card.style.display = card.dataset.name.includes(q) ? '' : 'none';
      });
    }
  </script>
</body>
</html>