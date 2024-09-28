@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mb-0">Data Tenaga Kependidikan</h3>
                    <div class="container mt-3">
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
                </div>
                <div class="card">
                    <div class="container mt-4 pl-3">
                        <div class="col-md-6">
                            <a href="#" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#tambahModal">
                                <i class="bi bi-person-add"></i> Tambah
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#uploadExcelModal"
                                class="btn btn-secondary btn-sm">
                                <i class="bi bi-upload"></i> Import
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="user-admin" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tendiks as $tendik)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tendik->nip }}</td>
                                        <td>{{ $tendik->nama_lengkap }}</td>
                                        <td>{{ $tendik->email }}</td>
                                        <td>
                                            @if ($tendik->status === 'aktif')
                                                <span class="badge text-bg-success">{{ $tendik->status }}</span>
                                            @elseif ($tendik->status === 'cuti')
                                                <span class="badge text-bg-warning">{{ $tendik->status }}</span>
                                            @elseif ($tendik->status === 'resign')
                                                <span class="badge text-bg-danger">{{ $tendik->status }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" type="button" class="btn btn-sm btn-warning"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                onclick="openEditModal({{ $tendik }})">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form
                                                action="{{ url('dashboard-admin/tenaga-kependidikan/delete/' . $tendik->id) }}"
                                                method="POST" style="display:inline;" id="deleteForm{{ $tendik->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger deleteTendik"
                                                    data-id="{{ $tendik->id }}">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Tendik -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Tenaga Kependidikan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('StoreTendik') }}" method="POST">
                        @csrf
                        <!-- Form fields -->
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" maxlength="19"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
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
                            <label for="editNip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="editNip" name="nip" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
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

    {{-- Modal Import --}}
    <div class="modal fade" id="uploadExcelModal" tabindex="-1" role="dialog" aria-labelledby="uploadExcelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadExcelModalLabel">Upload Users via Excel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tendikimport') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="excelFile">Upload Excel File</label>
                            <input type="file" class="form-control" id="excelFile" name="file"
                                accept=".xls,.xlsx"required>
                        </div>
                        <div>
                            <h6>Template dapat di unduh : <a href="{{ asset('excel/tendik/user.xlsx') }}"
                                    download>Template
                                    User</a></h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openEditModal(tendik) {
            document.getElementById('editId').value = tendik.id;
            document.getElementById('editNamaLengkap').value = tendik.nama_lengkap;
            document.getElementById('editNip').value = tendik.nip;
            document.getElementById('editEmail').value = tendik.email;
            document.getElementById('editForm').action = `/dashboard-admin/tenaga-kependidikan/${tendik.id}/update`;
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
