<nav class="sidebar sidebar-offcanvas shadow-sm" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard-admin') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">USER MANAGEMENT</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#user-management" aria-expanded="false"
                aria-controls="user-management">
                <i class="menu-icon mdi mdi-account-circle"></i>
                <span class="menu-title">User</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard-admin/tenaga-kependidikan') }}">Tenaga
                            Kependidikan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard-admin/mahasiswa') }}">Mahasiswa</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
