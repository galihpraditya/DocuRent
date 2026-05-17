<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard – DocuRent</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.30.0/dist/tabler-icons.min.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg: #f2f2f0; --sidebar-bg: #fff; --stat-bg: #2b2b2b;
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

    /* MAIN */
    .main { flex: 1; overflow-y: auto; padding: 36px 40px; }
    .page-title { font-size: 28px; font-weight: 700; margin-bottom: 28px; }

    /* STAT CARDS */
    .stat-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 32px; }
    .stat-card { background: var(--stat-bg); border-radius: var(--radius-lg); padding: 28px 28px; color: #fff; }
    .stat-card .label { font-size: 13px; opacity: 0.8; margin-bottom: 14px; }
    .stat-card .value { font-size: 36px; font-weight: 700; }

    /* TRANSAKSI */
    .section-label {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 16px;
        color: #111;
    }

    .tx-box {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #e5e5e5;
        overflow: hidden;
    }

    .tx-header,
    .tx-row {
        display: grid;
        grid-template-columns: 80px 1.5fr 1fr 1.2fr 120px;
        align-items: center;
        gap: 16px;
        padding: 18px 24px;
        text-align: center;
    }

    .tx-header {
        background-color: #2b2b2b;
        color: white;
        font-size: 0.85rem;
        font-weight: 600;
        text-align: center;
    }

    .tx-row {
        border-bottom: 1px solid #ededed;
        font-size: 0.9rem;
    }

    .tx-row:last-child {
        border-bottom: none;
    }

    .tx-user {
        font-weight: 600;
        color: #111;
    }

    .tx-total {
        font-weight: 700;
        color: #111;
    }

    .tx-status {
        display: inline-block;
        background: #fff3cd;
        color: #856404;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .btn-detail {
        background: #111;
        color: white;
        border: none;
        border-radius: 999px;
        padding: 8px 18px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-detail:hover {
        opacity: 0.85;
        color: white;
    }

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
      <a href="{{ route('dashboard') }}" class="nav-item active">
        <i class="ti ti-layout-dashboard"></i> Dashboard
      </a>
      <a href="{{ route('admin.products.index') }}" class="nav-item">
        <i class="ti ti-package"></i> Manajemen Produk
      </a>
      <a href="{{ route('admin.rentals.index') }}" class="nav-item">
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

  <!-- MAIN -->
  <main class="main">
    <div class="page-title">Dashboard</div>

    <div class="stat-grid">
      <div class="stat-card">
        <div class="label">Total Produk</div>
        <div class="value">{{ $totalProduk ?? 0 }}</div>
      </div>
      <div class="stat-card">
        <div class="label">Jumlah Pelanggan Aktif</div>
        <div class="value">{{ $totalPelanggan ?? 0 }}</div>
      </div>
    </div>

    <div class="section-label">
        Transaksi yang Perlu Dikonfirmasi
    </div>

    <div class="tx-box">

        <!-- Header -->
        <div class="tx-header">

            <div>ID</div>

            <div>Penyewa</div>

            <div>Total</div>

            <div>Status Pembayaran</div>

            <div class="text-center">Aksi</div>

        </div>

        <!-- Data -->
        @foreach($rentalsPaymentPending as $rental)

            <div class="tx-row">

                <div>
                    #{{ $rental->id }}
                </div>

                <div class="tx-user">
                    {{ $rental->user->nama }}
                </div>

                <div class="tx-total">
                    Rp {{ number_format($rental->total_harga) }}
                </div>

                <div>

                    <span class="tx-status">
                        {{ $rental->payment->status_pembayaran ?? '-' }}
                    </span>

                </div>

                <div class="text-center">

                    <a 
                        href="{{ route('admin.rentals.show', $rental->id) }}"
                        class="btn-detail"
                    >
                        Detail
                    </a>

                </div>

            </div>

        @endforeach

    </div>
  </main>

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