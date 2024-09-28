@extends('tendik.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mb-0">Permohonan Data Tugas Akhir</h3>
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
                        <form class="form-sample" method="POST" action="{{ route('StatusdataTA', ['id' => $dataTA->id]) }}">
                            @csrf
                            @if ($dataTA->status == 'diterima' || $dataTA->status == 'diproses' || $dataTA->status == 'selesai')
                                <p class="card-description">Nomor Surat</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nomor Surat</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nomor_surat"
                                                    value="{{ $dataTA->nomor_surat }}" required
                                                    {{ in_array($dataTA->status, ['diproses', 'selesai']) ? 'disabled' : '' }} />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <p class="card-description"> Data Mahasiswa </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                value="{{ $dataTA->user->nama_lengkap }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">No Handphone</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $dataTA->user->no_hp }}"
                                                name="no_hp" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Nomor Induk Mahasiswa</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $dataTA->user->nim }}"
                                                disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Program Studi</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text"
                                                value="{{ $dataTA->user->program_studi }}" disabled />
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
                                            <input type="text" class="form-control" name="nama_mitra"
                                                value="{{ $dataTA->nama_mitra }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Alamat Mitra</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" rows="4" class="form-control" name="alamat_mitra" disabled>{{ $dataTA->alamat_mitra }}</textarea>
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
                                            <input type="date" class="form-control" name="tgl_mulai"
                                                value="{{ $dataTA->tgl_mulai }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tanggal Selesai</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="tgl_akhir"
                                                value="{{ $dataTA->tgl_akhir }}" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Judul Tugas Akhir</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="judul_tugas_akhir"
                                                value="{{ $dataTA->judul_tugas_akhir }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Data yang dibutuhkan</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" rows="4" class="form-control" name="data_yang_dibutuhkan" disabled>{{ $dataTA->data_yang_dibutuhkan }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Dosen Pembimbing</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="dosen_pembimbing"
                                                value="{{ $dataTA->dosen_pembimbing }}" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-start"><a href="{{ route('VerifdataTA') }}"
                                        class="btn btn-light me-2">Cancel</a></div>
                                <div class="col-md-6 text-end">
                                    @if ($dataTA->status == 'pending')
                                        <div>
                                            <button class="btn btn-primary" type="submit" name="diterima"
                                                value="diterima"><i
                                                    class="mdi mdi-check-circle-outline text-white me-2"></i>Terima</button>
                                            <button class="btn btn-danger" type="submit" name="ditolak"
                                                value="ditolak"><i
                                                    class="mdi mdi-cancel text-white me-2"></i>Tolak</button>
                                        </div>
                                    @elseif ($dataTA->status == 'diterima')
                                        <div>
                                            <button class="btn btn-warning" type="submit" name="diproses"
                                                value="diproses"><i
                                                    class="mdi mdi-check text-white me-2"></i>Proses</button>
                                        </div>
                                    @elseif ($dataTA->status == 'diproses')
                                        <div>
                                            <a class="btn btn-primary"
                                                href="{{ route('downloadWordTA', ['id' => $dataTA->id]) }}">
                                                <i class="bi bi-printer me-2"></i>Cetak
                                            </a>
                                            <button class="btn btn-dark" type="submit" name="selesai"
                                                value="selesai"><i
                                                    class="mdi mdi-check text-white me-2"></i>Selesai</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
