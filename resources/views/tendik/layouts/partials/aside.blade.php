<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard-tendik') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">LAYANAN</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#permohonan-data" aria-expanded="false"
                aria-controls="permohonan-data">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Permohonan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="permohonan-data">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ url('dashboard-tendik/permohonan/data-tugas-akhir') }}">Data Tugas
                            Akhir</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ url('dashboard-tendik/permohonan/data-mata-kuliah') }}">Data Mata
                            Kuliah</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#keterangan" aria-expanded="false"
                aria-controls="keterangan">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Keterangan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="keterangan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ url('dashboard-tendik/keterangan/telah-tugas-akhir') }}">Telah
                            Tugas Akhir</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#rekomendasi" aria-expanded="false"
                aria-controls="rekomendasi">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Rekomendasi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="rekomendasi">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ url('dashboard-tendik/rekomendasi/beasiswa') }}">Beasiswa</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ url('dashboard-tendik/rekomendasi/lomba') }}">Lomba</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
