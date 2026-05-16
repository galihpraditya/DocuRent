<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-decoration-none" href="{{ route('home') }}">
            <div class="bg-light rounded-pill d-flex align-items-center px-2 py-1">
                <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                    <i class="bi bi-camera-fill"></i>
                </div>
                <span class="pe-2 text-dark">DocuRent</span>
            </div>
        </a>

        <form class="d-none d-md-flex mx-auto" style="width: 50%;">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3" id="search-icon">
                    <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 26px; height: 26px;">
                        <i class="bi bi-search" style="font-size: 0.75rem;"></i>
                    </div>
                </span>
                <input type="text" class="form-control bg-light border-start-0 rounded-end-pill py-2 shadow-none" placeholder="Temukan gear terbaik untukmu" aria-label="Search">
            </div>
        </form>

        <div class="d-flex align-items-center gap-2">
            
            <a href="{{ route('cart') }}" class="d-flex align-items-center justify-content-center bg-light rounded-circle text-dark text-decoration-none hover-bg" style="width: 40px; height: 40px;" title="Keranjang">
                <i class="bi bi-cart-fill fs-5"></i>
            </a>
            
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center justify-content-center bg-light rounded-circle text-dark text-decoration-none position-relative hover-bg" role="button" data-bs-toggle="dropdown" style="width: 40px; height: 40px;" title="Notifikasi">
                    <i class="bi bi-bell-fill fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="margin-top: 8px; margin-left: -8px;">
                        <span class="visually-hidden">Notifikasi Baru</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" style="width: 250px;">
                    <li><h6 class="dropdown-header fw-bold">Notifikasi Terbaru</h6></li>
                    <li><a class="dropdown-item small py-2" href="#"><i class="bi bi-info-circle text-primary me-2"></i>Promo sewa lensa 20% hari ini!</a></li>
                    <li><a class="dropdown-item small py-2" href="#"><i class="bi bi-check-circle text-success me-2"></i>Penyewaan #123 dikonfirmasi</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-center small text-primary fw-semibold" href="#">Lihat Semua</a></li>
                </ul>
            </div>

            <div class="dropdown ms-1">
                <a class="bg-light rounded-pill text-dark text-decoration-none fw-semibold d-flex align-items-center dropdown-toggle px-2 py-1 hover-bg" href="#" role="button" data-bs-toggle="dropdown">
                    <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <span class="pe-1">Username</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                    <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                    <li><a class="dropdown-item py-2" href="{{ route('rentals.list') }}"><i class="bi bi-bag-check me-2"></i>Pesanan Saya</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>

<style>
    .hover-bg {
        transition: background-color 0.2s ease-in-out;
    }
    .hover-bg:hover {
        background-color: #e2e6ea !important;
    }
</style>