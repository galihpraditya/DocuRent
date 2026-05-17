<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk – DocuRent</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.30.0/dist/tabler-icons.min.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg: #f2f2f0; --sidebar-bg: #fff; --card-bg: #fff;
      --text-primary: #1a1a1a; --text-secondary: #6b6b6b; --text-muted: #a0a0a0;
      --border: rgba(0,0,0,0.08); --active-bg: #f0f0ee; --input-bg: #e8e8e6;
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
    .content { flex: 1; overflow-y: auto; padding: 36px 48px; }

    /* Card pembungkus form */
    .form-card {
      background: var(--card-bg);
      border-radius: var(--radius-lg);
      border: 1px solid var(--border);
      padding: 36px 48px 32px;
      max-width: 820px;
      margin: 0 auto;
    }

    .form-title { font-size: 20px; font-weight: 600; text-align: center; margin-bottom: 36px; }

    .field { display: grid; grid-template-columns: 160px 1fr; align-items: center; gap: 16px; margin-bottom: 20px; }
    .field.top { align-items: flex-start; }
    .field-label { font-size: 14px; font-weight: 500; color: var(--text-primary); }
    .field input { background: var(--input-bg); border: none; outline: none; border-radius: var(--radius-pill); padding: 12px 18px; font-size: 14px; color: var(--text-primary); width: 100%; font-family: var(--font); transition: background 0.15s; }
    .field input:focus { background: #ddddd8; }
    .field textarea { background: var(--input-bg); border: none; outline: none; border-radius: var(--radius-lg); padding: 14px 18px; font-size: 14px; color: var(--text-primary); width: 100%; height: 180px; resize: none; font-family: var(--font); transition: background 0.15s; }
    .field textarea:focus { background: #ddddd8; }

    .harga-wrap { position: relative; }
    .harga-wrap input { padding-right: 56px; }
    .harga-suffix { position: absolute; right: 18px; top: 50%; transform: translateY(-50%); font-size: 13px; color: var(--text-muted); pointer-events: none; }

    .char-hint { font-size: 12px; color: var(--text-muted); text-align: right; margin-top: 5px; }
    .error-msg { font-size: 12px; color: #d63031; margin-top: 5px; }

    .form-footer { display: flex; justify-content: flex-end; margin-top: 28px; }
    .btn-save { display: flex; align-items: center; gap: 8px; background: #e8e8e6; border: 1px solid rgba(0,0,0,0.1); border-radius: var(--radius-pill); padding: 10px 24px; font-size: 14px; font-weight: 500; cursor: pointer; color: var(--text-primary); transition: background 0.15s; }
    .btn-save:hover { background: #d8d8d4; }
    .btn-save i { font-size: 17px; }

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
    <div class="form-card">
      <div class="form-title">Tambah Unit Alat</div>

      <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="field">
          <label class="field-label" for="nama_produk">Nama Produk</label>
          <div>
            <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}">
            @error('nama_produk')<div class="error-msg">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="field">
          <label class="field-label" for="stok">Stok</label>
          <div>
            <input type="number" id="stok" name="stok" value="{{ old('stok') }}" min="0">
            @error('stok')<div class="error-msg">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="field">
          <label class="field-label" for="harga_sewa">Harga Sewa</label>
          <div>
            <div class="harga-wrap">
              <input type="number" id="harga_sewa" name="harga_sewa" value="{{ old('harga_sewa') }}" min="0">
              <span class="harga-suffix">/ hari</span>
            </div>
            @error('harga_sewa')<div class="error-msg">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="field top">
          <label class="field-label" for="deskripsi" style="padding-top:14px;">Deskripsi</label>
          <div style="width:100%;">
            <textarea id="deskripsi" name="deskripsi" maxlength="1500"
              oninput="document.getElementById('charCount').textContent = this.value.length + '/1500'">{{ old('deskripsi') }}</textarea>
            <div class="char-hint" id="charCount">0/1500</div>
            @error('deskripsi')<div class="error-msg">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="field">
          <label class="field-label" for="gambar">Gambar</label>
          <div>
            <input type="file" id="gambar" name="gambar" accept="image/*"
              style="background:transparent; border-radius:0; padding:0;">
            @error('gambar')<div class="error-msg">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="form-footer">
          <button type="submit" class="btn-save">
            <i class="ti ti-device-floppy"></i> Simpan
          </button>
        </div>
      </form>
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