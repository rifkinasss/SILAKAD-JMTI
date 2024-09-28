<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="{{ url('dashboard') }}">
                <img src="{{ asset('assets/img/logoJMTI.png') }}" alt="logo" />
                <span class="fs-6">SILAKAD JMTI</span>
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ url('dashboard') }}">
                <img src="{{ asset('assets/img/logoJMTI.png') }}" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Selamat Datang, <span
                        class="text-black fw-bold">{{ Auth::user()->nama_lengkap }}</span></h1>
                <h3 class="welcome-sub-text">di Aplikasi Sistem Informasi Layanan Akademik JMTI</h3>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            {{-- <li class="nav-item">
                <form class="search-form" action="#">
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
            </li> --}}
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>{{ Auth::user()->nama_lengkap }}</span>
                    {{-- <img class="img-xs rounded-circle" src="{{ asset('assets/img/face8.jpg') }}" alt="Profile image"> --}}
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        {{-- <img class="img-md rounded-circle" src="{{ asset('assets/img/face8.jpg') }}"
                            alt="Profile image"> --}}
                        <p class="mb-1 mt-3 fw-semibold">{{ Auth::user()->nama_lengkap }}</p>
                        <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                    </div>
                    <a class="dropdown-item"><i
                            class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
                    <a class="dropdown-item"><i
                            class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                        Log Out
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
