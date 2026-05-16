<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
            <i class="bi bi-camera-fill fs-4 me-2"></i> <!-- Asumsi pakai Bootstrap Icons -->
            DocuRent
        </a>

        <!-- Search Bar (Tengah) -->
        <form class="d-none d-md-flex mx-auto" style="width: 50%;">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 rounded-start-pill" id="search-icon">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control bg-light border-start-0 rounded-end-pill" placeholder="Temukan gear terbaik untukmu" aria-label="Search">
            </div>
        </form>

        <!-- Menu Kanan -->
        <div class="d-flex align-items-center gap-1">

            @auth

                <a 
                    href="{{ route('cart.index') }}"
                    class="rounded-circle bg-dark d-flex align-items-center justify-content-center text-white text-decoration-none"
                    style="width: 30px; height: 30px;"
                >
                </a>

                <a href="#" class="text-dark">
                    <i class="bi bi-bell fs-5"></i>
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