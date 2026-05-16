<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top py-3">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold text-decoration-none" href="{{ route('home') }}">
            <div class="bg-light rounded-pill d-flex align-items-center px-2 py-1">
                <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                    <i class="bi bi-camera-fill"></i>
                </div>
                <span class="pe-2 text-dark">DocuRent</span>
            </div>
        </a>

        <!-- Search Bar (Tengah) -->
        <form action="{{ route('products.search') }}#catalog" method="GET" class="d-none d-md-flex mx-auto" style="width: 50%;">
             <div class="input-group">
                <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-2" id="search-icon">
                    <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 26px; height: 26px;">
                        <i class="bi bi-search" style="font-size: 0.75rem;"></i>
                    </div>
                </span>
                <input type="text" class="form-control bg-light border-start-0 rounded-end-pill py-2 shadow-none" placeholder="Temukan gear terbaik untukmu" aria-label="Search">
            </div>
        </form>

        <!-- Menu Kanan -->
        <div class="d-flex align-items-center gap-1">

            @auth

                <a href="{{ route('cart.index') }}" class="d-flex align-items-center justify-content-center bg-light rounded-circle text-dark text-decoration-none hover-bg" style="width: 40px; height: 40px;" title="Keranjang">
                    <i class="bi bi-cart-fill fs-5"></i>
                </a>

                <div class="dropdown">
                    <a 
                        class="btn text-dark text-decoration-none fw-semibold d-flex align-items-center dropdown-toggle border-0"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="bi bi-person-circle fs-5 me-2"></i>

                        {{ auth()->user()->username }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item" href="#">
                                Profil
                            </a>
                        </li>

                        <li>
                            <a 
                                class="dropdown-item"
                                href="{{ route('rentals.list') }}"
                            >
                                Daftar sewaan
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>

                            <form action="{{ route('logout') }}" method="POST">

                                @csrf

                                <button 
                                    type="submit"
                                    class="dropdown-item text-danger"
                                >
                                    Logout
                                </button>

                            </form>

                        </li>

                    </ul>

                </div>

            @else

                <a 
                    href="{{ route('login') }}"
                    class="btn btn-dark rounded-pill px-4"
                >
                    Login
                </a>

            @endauth

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