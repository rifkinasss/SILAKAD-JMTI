<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark" id="sidebar">
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="{{ url('dashboad-admin') }}" class="brand-link">
            <!--begin::Brand Image--> <img src="{{ asset('assets/img/LogoJMTI.png') }}" alt="Logo JMTI"
                class="brand-image opacity-75 shadow">
            <!--begin::Brand Text--> <span class="brand-text fw-light">SILAKAD JMTI</span> <!--end::Brand Text-->
        </a>
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <a href="{{ url('dashboard-admin') }}" class="nav-link"> <i
                            class="nav-icon bi bi-speedometer"></i>
                        <p>Dashborad</p>
                    </a> </li>
                <li class="nav-header">USER MANAGEMENT</li>
                <li class="nav-item"> <a href="{{ url('dashboard-admin/mahasiswa') }}" class="nav-link"> <i
                            class="nav-icon bi bi-person-fill"></i>
                        <p>
                            Mahasiswa
                        </p>
                    </a>
                </li>
                <li class="nav-item"> <a href="{{ url('dashboard-admin/tenaga-kependidikan') }}" class="nav-link"> <i
                            class="nav-icon bi bi-person-fill"></i>
                        <p>
                            Tenaga Kependidikan
                        </p>
                    </a>
                </li>
                <li class="nav-header">SETTING</li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i
                            class="nav-icon bi bi-box-arrow-left"></i>
                        <p>
                            Log Out
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
