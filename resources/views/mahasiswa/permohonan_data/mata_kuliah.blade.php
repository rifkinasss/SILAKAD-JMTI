@extends('mahasiswa.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mb-0">Permohonan Data Mata Kuliah</h3>
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
                </div>
                <div class="card">
                    <div class="card-body">
                        <p class="card-description text-warning text-center"> Permohonan Pembuatan Surat di Lingkungan
                            Jurusan
                            Matematika dan
                            Teknologi Informasi dengan lama proses pembuatan suratnya
                            <br> maksimal <b>2x24 jam</b> di hari
                            kerja.
                        </p>
                        <form class="form-sample" method="POST" action="{{ route('StoreDataMataKuliah') }}">
                            @csrf
                            <p class="card-description"> Data Mahasiswa </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                value="{{ Auth::user()->nama_lengkap }}" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">No Handphone</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::user()->no_hp }}"
                                                maxlength="13" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Nomor Induk Mahasiswa</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::user()->nim }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Program Studi</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text"
                                                value="{{ Auth::user()->program_studi }}" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-description" id="anggotaLabel">
                                <p>Data Anggota</p>
                            </div>
                            <div class="row" id="anggotaForm">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nama Anggota 1</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama1" id="nama1"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nama Anggota 2</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama2" id="nama2"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nama Anggota 3</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama3" id="nama3"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nama Anggota 4</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama4" id="nama4"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">NIM Anggota 1</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nim1" id="nim1"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">NIM Anggota 2</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nim2" id="nim2"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">NIM Anggota 3</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nim3" id="nim3"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">NIM Anggota 4</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nim4" id="nim4"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description"> Data Permohonan </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nama Mitra</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama_mitra" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Alamat Mitra</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" rows="4" class="form-control" name="alamat_mitra" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <p class="card-description"> Periode Pelaksanaan </p>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="tgl_mulai" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tanggal Selesai</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="tgl_akhir" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Nama Mata Kuliah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama_matkul" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Data yang dibutuhkan</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" rows="4" class="form-control" name="data_yang_dibutuhkan" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Dosen Pembimbing</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="dosen_pembimbing"
                                                required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <a href="{{ route('mahasiswa') }}" class="btn btn-light me-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
