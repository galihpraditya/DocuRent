<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Transaksi – DocuRent</title>
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
    .content { flex: 1; overflow-y: auto; padding: 32px 40px; }

    .btn-back { display: inline-flex; align-items: center; gap: 6px; color: var(--text-secondary); font-size: 13px; text-decoration: none; margin-bottom: 20px; transition: color 0.15s; }
    .btn-back:hover { color: var(--text-primary); }
    .btn-back i { font-size: 17px; }

    /* Layout 2 kolom */
    .detail-grid { display: grid; grid-template-columns: 1fr 340px; gap: 20px; max-width: 1000px; }

    /* ── CARD GENERIK ── */
    .card { background: var(--card-bg); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; margin-bottom: 16px; }
    .card:last-child { margin-bottom: 0; }
    .card-title { font-size: 13px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
    .card-title i { font-size: 16px; }

    /* Info baris */
    .info-row { display: flex; align-items: flex-start; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--border); gap: 12px; }
    .info-row:last-child { border-bottom: none; padding-bottom: 0; }
    .info-label { font-size: 13px; color: var(--text-muted); white-space: nowrap; }
    .info-value { font-size: 13px; font-weight: 500; color: var(--text-primary); text-align: right; }

    /* Status badge */
    .status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; border-radius: var(--radius-pill); font-size: 12px; font-weight: 600; }
    .status-badge.pending    { background: #fff8e1; color: #f59f00; }
    .status-badge.ongoing    { background: #e3f2fd; color: #1971c2; }
    .status-badge.completed  { background: #ebfbee; color: #2f9e44; }
    .status-badge.cancelled  { background: #fff5f5; color: #d63031; }
    .status-badge.waiting_for_verification { background: #fff8e1; color: #f59f00; }
    .status-badge.paid   { background: #ebfbee; color: #2f9e44; }
    .status-badge.failed  { background: #fff5f5; color: #d63031; }

    /* Booking code */
    .booking-code { font-family: monospace; background: var(--input-bg); border-radius: 6px; padding: 3px 8px; font-size: 13px; color: var(--text-primary); }

    /* Tabel item rental */
    .items-table { width: 100%; border-collapse: collapse; }
    .items-table th { font-size: 11px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.04em; padding: 0 0 10px; text-align: left; border-bottom: 1px solid var(--border); }
    .items-table td { font-size: 13px; color: var(--text-primary); padding: 12px 0; border-bottom: 1px solid var(--border); vertical-align: middle; }
    .items-table tr:last-child td { border-bottom: none; }
    .item-thumb { width: 40px; height: 36px; border-radius: 6px; object-fit: cover; background: #e8e8e6; margin-right: 10px; display: inline-block; vertical-align: middle; }
    .item-name { font-weight: 500; }

    /* Total harga */
    .total-row { display: flex; justify-content: space-between; align-items: center; padding: 14px 0 0; border-top: 2px solid var(--border); margin-top: 4px; }
    .total-label { font-size: 14px; font-weight: 600; }
    .total-value { font-size: 18px; font-weight: 700; color: var(--text-primary); }

    /* Bukti bayar */
    .proof-img { width: 100%; border-radius: var(--radius-md); object-fit: cover; max-height: 200px; margin-bottom: 16px; border: 1px solid var(--border); }

    /* Tombol aksi */
    .btn-verify { width: 100%; padding: 11px; background: #2f9e44; color: #fff; border: none; border-radius: var(--radius-pill); font-size: 13px; font-weight: 700; cursor: pointer; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 6px; transition: opacity 0.15s; }
    .btn-verify:hover { opacity: 0.85; }

    /* Update status */
    .status-select-wrap { margin-top: 4px; }
    .status-select-wrap label { font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.04em; display: block; margin-bottom: 8px; }
    .status-select-wrap select { width: 100%; background: var(--input-bg); border: none; outline: none; border-radius: var(--radius-pill); padding: 10px 16px; font-size: 13px; color: var(--text-primary); font-family: var(--font); cursor: pointer; }
    .btn-update { width: 100%; padding: 11px; background: var(--btn-dark); color: #fff; border: none; border-radius: var(--radius-pill); font-size: 13px; font-weight: 700; cursor: pointer; margin-top: 10px; display: flex; align-items: center; justify-content: center; gap: 6px; transition: opacity 0.15s; }
    .btn-update:hover { opacity: 0.85; }

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

    <a href="{{ route('admin.rentals.index') }}" class="btn-back">
      <i class="ti ti-arrow-left"></i> Kembali ke Daftar Transaksi
    </a>

    <div class="detail-grid">

      <!-- KOLOM KIRI -->
      <div>

        <!-- Info Transaksi -->
        <div class="card">
          <div class="card-title"><i class="ti ti-receipt"></i> Informasi Transaksi</div>
          <div class="info-row">
            <span class="info-label">Booking Code</span>
            <span class="info-value"><span class="booking-code">#{{ $rental->id }}</span></span>
          </div>
          <div class="info-row">
            <span class="info-label">Penyewa</span>
            <span class="info-value">{{ $rental->user->nama }}</span>
          </div>
          <div class="info-row">
            <span class="info-label">Tanggal Sewa</span>
            <span class="info-value">{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }}</span>
          </div>
          <div class="info-row">
            <span class="info-label">Tanggal Kembali</span>
            <span class="info-value">{{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}</span>
          </div>

          <div class="info-row">
            <span class="info-label">
                Status Pembayaran
            </span>
            <span class="info-value">
                @php
                    $paymentMap = [
                        'waiting for verification' => [
                            'label' => 'Menunggu Verifikasi',
                            'class' => 'waiting_for_verification'
                        ],
                        'paid' => [
                            'label' => 'Pembayaran Terverifikasi',
                            'class' => 'paid'
                        ],
                        'failed' => [
                            'label' => 'Pembayaran Gagal',
                            'class' => 'failed'
                        ],
                    ];
                    $paymentStatus =
                        $paymentMap[$rental->payment->status_pembayaran]
                        ?? [
                            'label' => ucfirst($rental->payment->status_pembayaran),
                            'class' => 'pending'
                        ];
                @endphp
                <span class="status-badge {{ $paymentStatus['class'] }}">
                    {{ $paymentStatus['label'] }}
                </span>
            </span>
          </div>

          <div class="info-row">
            <span class="info-label">
                Status Rental
            </span>
            <span class="info-value">
                @php
                    $statusMap = [
                        'pending' => [
                            'label' => 'Pending',
                            'class' => 'pending'
                        ],
                        'ongoing' => [
                            'label' => 'Sedang Disewa',
                            'class' => 'ongoing'
                        ],
                        'completed' => [
                            'label' => 'Selesai',
                            'class' => 'completed'
                        ],
                        'cancelled' => [
                            'label' => 'Dibatalkan',
                            'class' => 'cancelled'
                        ],
                    ];
                    $rentalStatus =
                        $statusMap[$rental->status]
                        ?? [
                            'label' => ucfirst($rental->status),
                            'class' => 'pending'
                        ];
                @endphp
                <span class="status-badge {{ $rentalStatus['class'] }}">
                    {{ $rentalStatus['label'] }}
                </span>
            </span>
        </div>

        </div>

        <!-- Item Rental -->
        <div class="card">
          <div class="card-title"><i class="ti ti-package"></i> Item Rental</div>
          <table class="items-table">
            <thead>
              <tr>
                <th>Produk</th>
                <th>Harga / Hari</th>
                <th>Jumlah</th>
                <th style="text-align:right;">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($rental->rentalItems as $item)
              <tr>
                <td>
                  @if ($item->product->gambar)
                    <img src="{{ asset('storage/' . $item->product->gambar) }}"
                         class="item-thumb" alt="{{ $item->product->nama_produk }}">
                  @endif
                  <span class="item-name">{{ $item->product->nama_produk }}</span>
                </td>
                <td>Rp{{ number_format($item->harga_saat_sewa) }}</td>
                <td>{{ $item->jumlah }}</td>
                <td style="text-align:right;">
                  Rp{{ number_format($item->harga_saat_sewa * $item->jumlah) }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="total-row">
            <span class="total-label">Total Biaya Sewa</span>
            <span class="total-value">Rp{{ number_format($rental->total_harga) }}</span>
          </div>
        </div>

      </div>

      <!-- KOLOM KANAN -->
      <div>

        <!-- Bukti Pembayaran + Verifikasi -->
        @if (isset($rental->payment))
        <div class="card">
          <div class="card-title"><i class="ti ti-credit-card"></i> Bukti Pembayaran</div>

          @if ($rental->payment->status_pembayaran != 'verified')
            {{-- Tampilkan bukti dan tombol verifikasi --}}
            @if ($rental->payment->bukti_pembayaran)
              <img src="{{ asset('storage/' . $rental->payment->bukti_pembayaran) }}"
                   alt="Bukti Pembayaran" class="proof-img">
            @endif
            <form action="{{ route('admin.payments.verify', $rental->payment->id) }}"
                  method="POST">
              @csrf
              @method('PUT')
              <button type="submit" class="btn-verify">
                <i class="ti ti-check"></i> Konfirmasi Pembayaran
              </button>
            </form>
          @else
            <div class="info-row" style="border:none; padding:0;">
              <span class="info-label">Pembayaran sudah terverifikasi</span>
              <span class="status-badge verified"><i class="ti ti-circle-check"></i> Verified</span>
            </div>
          @endif
        </div>
        @endif

        <!-- Update Status Rental -->
        <div class="card">
          <div class="card-title"><i class="ti ti-refresh"></i> Update Status Rental</div>
          <form action="{{ route('admin.rentals.update-status', $rental->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="status-select-wrap">
              <label>Status</label>
              <select name="status">
                <option value="pending"   {{ $rental->status == 'pending'   ? 'selected' : '' }}>Pending</option>
                <option value="ongoing"   {{ $rental->status == 'ongoing'   ? 'selected' : '' }}>Berlangsung</option>
                <option value="completed" {{ $rental->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ $rental->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
              </select>
            </div>
            <button type="submit" class="btn-update">
              <i class="ti ti-device-floppy"></i> Update Status
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