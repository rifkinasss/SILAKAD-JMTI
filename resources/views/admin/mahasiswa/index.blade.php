@extends('admin.layouts.app')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Data Mahasiswa</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Mahasiswa
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3 class="card-title mb-3">Data Mahasiswa</h1>
                                <div class="col-md-6">
                                    <a href="#" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#tambahModal">
                                        <i class="bi bi-person-add"></i> Tambah
                                    </a>
                                    <a href="{{ url('dashboard-admin/mahasiswa/import') }}" type="button"
                                        class="btn btn-success btn-sm"><i class="bi bi-box-arrow-right"></i> Import</a>
                                </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Email</th>
                                    <th>Prodi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswas as $mahasiswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mahasiswa->nama_lengkap }}</td>
                                        <td>{{ $mahasiswa->nim }}</td>
                                        <td>{{ $mahasiswa->email }}</td>
                                        <td>{{ $mahasiswa->program_studi }}</td>
                                        <td>
                                            @if ($mahasiswa->status === 'aktif')
                                                <span class="badge text-bg-success">{{ $mahasiswa->status }}</span>
                                            @elseif ($mahasiswa->status === 'cuti')
                                                <span class="badge text-bg-warning">{{ $mahasiswa->status }}</span>
                                            @elseif ($mahasiswa->status === 'non-aktif')
                                                <span class="badge text-bg-danger">{{ $mahasiswa->status }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal" onclick="openEditModal({{ $mahasiswa }})">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ url('dashboard-admin/mahasiswa/delete/' . $mahasiswa->id) }}"
                                                method="POST" style="display:inline;" id="deleteForm{{ $mahasiswa->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger deleteBtn"
                                                    data-id="{{ $mahasiswa->id }}">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Mahasiswa-->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('StoreMahasiswa') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" maxlength="19"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="email_mhs" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_mhs" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select class="form-select" id="prodi" name="program_studi" required>
                                <option value="" selected disabled>Pilih Program Studi</option>
                                <option value="Matematika">Matematika</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Informatika">Informatika</option>
                                <option value="Statistika">Statistika</option>
                                <option value="Ilmu Aktuaria">Ilmu Aktuaria</option>
                                <option value="Bisnis Digital">Bisnis Digital</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tendik -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Tenaga Kependidikan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editId">
                        <div class="mb-3">
                            <label for="editNamaLengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="editNamaLengkap" name="nama_lengkap"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editNIM" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="editNIM" name="nim" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select class="form-select" id="prodi" name="program_studi" required>
                                <option value="{{ $mahasiswa->program_studi }}" selected disabled>
                                    {{ $mahasiswa->program_studi }}
                                </option>
                                <option value="Matematika">Matematika</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Informatika">Informatika</option>
                                <option value="Statistika">Statistika</option>
                                <option value="Ilmu Aktuaria">Ilmu Aktuaria</option>
                                <option value="Bisnis Digital">Bisnis Digital</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password</label>
                            <input type="Password" class="form-control" id="editPassword" name="password" required>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openEditModal(mahasiswa) {
            document.getElementById('editId').value = mahasiswa.id;
            document.getElementById('editNamaLengkap').value = mahasiswa.nama_lengkap;
            document.getElementById('editNIM').value = mahasiswa.nim;
            document.getElementById('editEmail').value = mahasiswa.email;
            document.getElementById('editForm').action = `/dashboard-admin/mahasiswa/${mahasiswa.id}/update`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                });
            @endif
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.deleteTendik').forEach(button => {
                button.addEventListener('click', function() {
                    const tendikId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`deleteForm${tendikId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
