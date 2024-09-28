@extends('mahasiswa.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                            <div class="container mt-3">
                                @if (session('success'))
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            text: '{{ session('success') }}',
                                        });
                                    </script>
                                @endif
                                @if (session('error'))
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal',
                                            text: '{{ session('error') }}',
                                        });
                                    </script>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i
                                                class="bi bi-hourglass-split"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Pending</span> <span
                                                class="info-box-number">
                                                {{ $total_pending }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Verifikasi</span>
                                            <span class="info-box-number">
                                                {{ $total_diproses }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-success shadow-sm"> <i
                                                class="bi bi-check-all"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Terima</span> <span
                                                class="info-box-number">
                                                {{ $total_diterima }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-danger shadow-sm">
                                            <i class="bi bi-x-lg"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Tolak</span> <span
                                                class="info-box-number">
                                                {{ $total_ditolak }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 d-flex flex-column">
                                    <div class="row flex-grow">
                                        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <h4 class="card-title card-title-dash">Riwayat</h4>
                                                    <table id="user-mhs" class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">NO</th>
                                                                <th>Jenis Layanan</th>
                                                                <th class="text-center">Status</th>
                                                                {{-- <th>Aksi</th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($all_riwayat as $riwayat)
                                                                <tr>
                                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                                    <td>{{ $riwayat->jenis_layanan ?? 'N/A' }}</td>
                                                                    <td class="text-center">
                                                                        @if ($riwayat->status == 'pending')
                                                                            <span
                                                                                class="badge badge-secondary">Pending</span>
                                                                        @elseif($riwayat->status == 'diterima')
                                                                            <span
                                                                                class="badge badge-success">Diterima</span>
                                                                        @elseif($riwayat->status == 'ditolak')
                                                                            <span class="badge badge-danger">Ditolak</span>
                                                                        @elseif($riwayat->status == 'selesai')
                                                                            <span class="badge badge-primary">Selesai</span>
                                                                        @else
                                                                            <span class="badge badge-secondary">N/A</span>
                                                                        @endif
                                                                    </td>
                                                                    {{-- <td>
                                                                        <a class="btn btn-outline-warning detail-btn"
                                                                            data-id="{{ $riwayat->id }}"
                                                                            data-jenis-layanan="{{ $riwayat->jenis_layanan }}"
                                                                            href="#">Cek Status</a>
                                                                    </td> --}}
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-4 d-flex flex-column">
                                    <div class="row flex-grow">
                                        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="d-sm-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h4 class="card-title card-title-dash">Status</h4>
                                                        </div>
                                                    </div>
                                                    <div class="timeline p-4 block mb-4">
                                                        @foreach ($logs as $log)
                                                            <div
                                                                class="tl-item {{ $log->getKey() == $latestLogKey ? 'active' : '' }}">
                                                                <div class="tl-dot b-warning"></div>
                                                                <div class="tl-content">
                                                                    <h5>{{ $log->keterangan }}</h5>
                                                                    <p class="status-text">{{ $log->status }}</p>
                                                                    <div class="tl-date text-muted mt-1">
                                                                        {{ $log->created_at->format('d M Y H:i') }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.detail-btn').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    var id = button.getAttribute('data-id');
                    var jenisLayanan = button.getAttribute('data-jenis-layanan');

                    // Fetch data dari API berdasarkan jenis layanan dan ID
                    fetch(`/filter-activity-logs?jenis_layanan=${jenisLayanan}&id=${id}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            var timeline = document.querySelector('.timeline');
                            timeline.innerHTML = ''; // Clear previous data

                            data.forEach(log => {
                                // Hanya tampilkan log yang sesuai dengan jenis layanan yang dipilih
                                if (
                                    (jenisLayanan === 'data_tugas_akhir' && log
                                        .data_tugas_akhir_id == id) ||
                                    (jenisLayanan === 'data_mata_kuliah' && log
                                        .data_mata_kuliah_id == id) ||
                                    (jenisLayanan === 'ket_telah_tugas_akhir' && log
                                        .ket_telah_tugas_akhir_id == id) ||
                                    (jenisLayanan === 'rekomendasi_lomba' && log
                                        .rekomendasi_lomba_id == id) ||
                                    (jenisLayanan === 'rekomendasi_beasiswa' && log
                                        .rekomendasi_beasiswa_id == id)
                                ) {
                                    var item = document.createElement('div');
                                    item.className = 'tl-item';
                                    item.setAttribute('data-id', log.id);

                                    var dot = document.createElement('div');
                                    dot.className = 'tl-dot b-warning';

                                    var content = document.createElement('div');
                                    content.className = 'tl-content';
                                    content.innerHTML = `
                                        <h5>${log.keterangan}</h5>
                                        <p class="status-text">${log.status}</p>
                                        <div class="tl-date text-muted mt-1">
                                            ${new Date(log.created_at).toLocaleDateString()} ${new Date(log.created_at).toLocaleTimeString()}
                                        `;

                                    item.appendChild(dot);
                                    item.appendChild(content);

                                    timeline.appendChild(item);
                                }
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching activity logs:', error);
                        });
                });
            });
        });
    </script> --}}
@endsection
