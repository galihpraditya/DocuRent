<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Produk – DocuRent</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.30.0/dist/tabler-icons.min.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg: #f2f2f0; --sidebar-bg: #fff; --card-bg: #fff;
      --text-primary: #1a1a1a; --text-secondary: #6b6b6b; --text-muted: #a0a0a0;
      --border: rgba(0,0,0,0.08); --active-bg: #f0f0ee; --input-bg: #e8e8e6;
      --btn-dark: #1a1a1a; --btn-dark-text: #fff;
      --radius-md: 10px; --radius-lg: 14px; --radius-xl: 20px; --radius-pill: 999px;
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
    .content { flex: 1; overflow-y: auto; padding: 36px 48px; }

    /* Tombol kembali */
    .btn-back { display: inline-flex; align-items: center; gap: 6px; color: var(--text-secondary); font-size: 13px; text-decoration: none; margin-bottom: 24px; transition: color 0.15s; }
    .btn-back:hover { color: var(--text-primary); }
    .btn-back i { font-size: 17px; }

    /* Card detail */
    .detail-card {
      background: var(--card-bg);
      border-radius: var(--radius-xl);
      border: 1px solid var(--border);
      overflow: hidden;
      max-width: 860px;
      margin: 0 auto;
      display: flex;
      gap: 0;
    }

    /* Sisi kiri: gambar */
    .detail-img-side {
      width: 340px;
      min-width: 340px;
      background: #e8e8e6;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    .detail-img-side img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .detail-img-side i { font-size: 64px; color: #bbb; }

    /* Sisi kanan: info */
    .detail-info-side {
      flex: 1;
      padding: 36px 40px;
      display: flex;
      flex-direction: column;
      gap: 0;
    }

    .detail-title {
      font-size: 22px;
      font-weight: 700;
      color: var(--text-primary);
      margin-bottom: 6px;
    }

    /* Badge stok */
    .stok-badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      background: var(--input-bg);
      border-radius: var(--radius-pill);
      padding: 4px 12px;
      font-size: 12px;
      color: var(--text-secondary);
      font-weight: 500;
      margin-bottom: 20px;
      width: fit-content;
    }
    .stok-badge i { font-size: 14px; }
    .stok-badge.low { background: #fdecea; color: #d63031; }

    /* Harga */
    .harga-box {
      background: #5a6375;
      border-radius: var(--radius-lg);
      padding: 16px 20px;
      margin-bottom: 24px;
      display: flex;
      align-items: baseline;
      gap: 6px;
    }
    .harga-label { font-size: 12px; color: rgba(255,255,255,0.7); }
    .harga-value { font-size: 24px; font-weight: 700; color: #fff; }
    .harga-unit { font-size: 13px; color: rgba(255,255,255,0.7); }

    /* Divider */
    .divider { height: 1px; background: var(--border); margin: 0 0 20px; }

    /* Deskripsi */
    .desc-label { font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; }
    .desc-text { font-size: 14px; color: var(--text-secondary); line-height: 1.7; flex: 1; }
    .desc-empty { font-size: 14px; color: var(--text-muted); font-style: italic; }

    /* Tombol aksi bawah */
    .detail-actions {
      display: flex;
      gap: 10px;
      margin-top: 28px;
    }
    .btn-edit-detail {
      flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
      background: var(--btn-dark); color: #fff; text-decoration: none;
      padding: 11px 0; border-radius: var(--radius-pill);
      font-size: 13px; font-weight: 600; transition: opacity 0.15s;
    }
    .btn-edit-detail:hover { opacity: 0.82; }
    .btn-hapus-detail {
      flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
      background: #fff; color: #d63031;
      border: 1.5px solid #d63031;
      padding: 11px 0; border-radius: var(--radius-pill);
      font-size: 13px; font-weight: 600; cursor: pointer; width: 100%;
      transition: background 0.15s, color 0.15s;
    }
    .btn-hapus-detail:hover { background: #d63031; color: #fff; }

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
      <a href="{{ route('admin.products.index') }}" class="nav-item active">
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

    <!-- Tombol kembali -->
    <a href="{{ route('admin.products.index') }}" class="btn-back">
      <i class="ti ti-arrow-left"></i> Kembali ke Daftar Produk
    </a>

    <!-- Card detail produk -->
    <div class="detail-card">

      <!-- Gambar -->
      <div class="detail-img-side">
        @if ($product->gambar)
          <img src="{{ asset('storage/' . $product->gambar) }}"
               alt="{{ $product->nama_produk }}">
        @else
          <i class="ti ti-camera"></i>
        @endif
      </div>

      <!-- Info -->
      <div class="detail-info-side">

        <div class="detail-title">{{ $product->nama_produk }}</div>

        {{-- Badge stok --}}
        <div class="stok-badge {{ $product->stok <= 2 ? 'low' : '' }}">
          <i class="ti ti-stack-2"></i>
          Stok tersedia: {{ $product->stok }} unit
        </div>

        {{-- Harga --}}
        <div class="harga-box">
          <span class="harga-label">Harga Sewa</span>
          <span class="harga-value">Rp{{ number_format($product->harga_sewa) }}</span>
          <span class="harga-unit">/ hari</span>
        </div>

        <div class="divider"></div>

        {{-- Deskripsi --}}
        <div class="desc-label">Deskripsi</div>
        @if ($product->deskripsi)
          <p class="desc-text">{{ $product->deskripsi }}</p>
        @else
          <p class="desc-empty">Tidak ada deskripsi.</p>
        @endif

        {{-- Tombol Edit & Hapus --}}
        <div class="detail-actions">
          <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit-detail">
            <i class="ti ti-pencil"></i> Edit Produk
          </a>
          <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                style="flex:1; display:flex;"
                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-hapus-detail" style="flex:1;">
              <i class="ti ti-trash"></i> Hapus Produk
            </button>
          </form>
        </div>

      </div>
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
  </script>
</body>
</html>