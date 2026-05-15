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
      --bg: #f2f2f0; --sidebar-bg: #fff; --sub-bg: #c8c8c8;
      --text-primary: #1a1a1a; --text-secondary: #6b6b6b; --text-muted: #a0a0a0;
      --border: rgba(0,0,0,0.08); --active-bg: #f0f0ee;
      --btn-dark: #1a1a1a; --btn-dark-text: #fff;
      --radius-md: 10px; --radius-lg: 14px; --radius-pill: 999px;
      --font: 'Segoe UI', system-ui, sans-serif;
    }
    body { font-family: var(--font); background: var(--bg); color: var(--text-primary); display: flex; height: 100vh; overflow: hidden; }

    /* SIDEBAR */
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

    /* SUB SIDEBAR */
    .sub-sidebar { width: 170px; min-width: 170px; background: var(--sub-bg); display: flex; flex-direction: column; padding: 20px 0; }
    .sub-item { display: flex; align-items: center; gap: 10px; padding: 12px 20px; color: #444; font-size: 14px; text-decoration: none; transition: background 0.12s; }
    .sub-item i { font-size: 18px; }
    .sub-item:hover { background: rgba(255,255,255,0.35); color: #1a1a1a; }
    .sub-item.active { background: rgba(255,255,255,0.45); color: #1a1a1a; font-weight: 600; }

    /* CONTENT */
    .content { flex: 1; overflow-y: auto; padding: 28px 32px; }

    .search-wrap { display: flex; align-items: center; gap: 10px; background: #fff; border: 1px solid var(--border); border-radius: var(--radius-pill); padding: 9px 18px; margin-bottom: 24px; }
    .search-wrap i { font-size: 17px; color: var(--text-muted); }
    .search-wrap input { border: none; outline: none; background: transparent; font-size: 14px; color: var(--text-primary); flex: 1; }
    .search-wrap input::placeholder { color: var(--text-muted); }

    .product-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
    .product-card { background: #e4e4e2; border-radius: var(--radius-md); aspect-ratio: 3/4; position: relative; overflow: hidden; }
    .product-thumb { width: 100%; height: 65%; overflow: hidden; background: #d0cbc3; display: flex; align-items: center; justify-content: center; }
    .product-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .product-thumb i { font-size: 36px; color: #aaa; }
    .product-info { padding: 8px 10px; }
    .product-name { font-size: 12px; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .product-price { font-size: 11px; color: var(--text-secondary); }
    .product-stok { font-size: 11px; color: var(--text-muted); }
    .edit-btn { position: absolute; bottom: 8px; right: 8px; width: 28px; height: 28px; border-radius: 50%; background: var(--btn-dark); color: #fff; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 14px; }
    .edit-btn:hover { opacity: 0.8; }
    .delete-btn { position: absolute; bottom: 8px; right: 42px; width: 28px; height: 28px; border-radius: 50%; background: #d63031; color: #fff; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 14px; }
    .delete-btn:hover { background: #b52828; }

    /* LOGOUT MODAL */
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

  <!-- SUB SIDEBAR -->
  <div class="sub-sidebar">
    <a href="{{ route('products.create') }}" class="sub-item">
      <i class="ti ti-plus"></i> Tambah
    </a>
    <a href="{{ route('products.index') }}" class="sub-item active">
      <i class="ti ti-edit"></i> Edit
    </a>
    <a href="#" class="sub-item">
      <i class="ti ti-eye"></i> Lihat
    </a>
    <a href="#" class="sub-item">
      <i class="ti ti-trash"></i> Hapus
    </a>
    <a href="#" class="sub-item">
      <i class="ti ti-arrow-back"></i> Pengembalian
    </a>
  </div>

  <!-- CONTENT -->
  <div class="content">
    <div class="search-wrap">
      <i class="ti ti-search"></i>
      <input type="text" id="searchInput" placeholder="Cari alat berdasarkan nama"
        onkeyup="filterProducts()">
    </div>

    <div class="product-grid" id="productGrid">
      @foreach ($products as $product)
        <div class="product-card" data-name="{{ strtolower($product->nama_produk) }}">
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
            <div class="product-price">Rp{{ number_format($product->harga_sewa) }}/hari</div>
            <div class="product-stok">Stok: {{ $product->stok }}</div>
          </div>

          <!-- Tombol Edit -->
          <a href="{{ route('products.edit', $product->id) }}" class="edit-btn" title="Edit">
            <i class="ti ti-pencil"></i>
          </a>

          <!-- Tombol Hapus -->
          <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                style="display:inline;" onsubmit="return confirm('Hapus produk ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn" title="Hapus">
              <i class="ti ti-trash"></i>
            </button>
          </form>
        </div>
      @endforeach
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