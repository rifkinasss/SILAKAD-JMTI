@extends('tendik.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mb-0">Keterangan Telah Tugas Akhir</h3>
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
                    <div class="card-body">
                        <form class="form-sample" action="{{ route('StatusTelahTA', ['id' => $telahTA->id]) }}"
                            method="POST">
                            @csrf
                            @if ($telahTA->status == 'diterima' || $telahTA->status == 'diproses' || $telahTA->status == 'selesai')
                                <p class="card-description">Nomor Surat</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nomor Surat</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nomor_surat"
                                                    value="{{ $telahTA->nomor_surat }}" required
                                                    {{ in_array($telahTA->status, ['diproses', 'selesai']) ? 'disabled' : '' }} />
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
                                                value="{{ $telahTA->user->nama_lengkap }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Semester</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                value="{{ $telahTA->user->semester }}" name="semester" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Nomor Induk Mahasiswa</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $telahTA->user->nim }}"
                                                disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Program Studi</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text"
                                                value="{{ $telahTA->user->program_studi }}" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description"> Data Permohonan </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label pt-0">Judul Tugas Akhir</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control"
                                                value="{{ $telahTA->judul_tugas_akhir }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label pt-0">Dosen Pembimbing Utama</label>
                                        <div class="col-sm-8">
                                            <input type="text" rows="4" class="form-control"
                                                value="{{ $telahTA->nama_pembimbing_utama }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label pt-0">Dosen Pembimbing Pendamping</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control"
                                                value="{{ $telahTA->nama_pembimbing_pendamping }}" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-start">
                                    <a href="{{ route('VeriftelahTA') }}" class="btn btn-light me-2">Cancel</a>
                                </div>
                                <div class="col-md-6 text-end">
                                    @if ($telahTA->status == 'pending')
                                        <div>
                                            <button class="btn btn-primary" type="submit" name="diterima"
                                                value="diterima"><i
                                                    class="mdi mdi-check-circle-outline text-white me-2"></i>Terima</button>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#rejectModal">
                                                <i class="mdi mdi-cancel text-white me-2"></i>Tolak
                                            </button>
                                            {{-- Modal --}}
                                            <div class="modal fade" id="rejectModal" tabindex="-1"
                                                aria-labelledby="rejectModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <textarea class="form-control" id="reason" name="keterangan" rows="4" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger" name="ditolak"
                                                                value="ditolak">Kirim</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($telahTA->status == 'diterima')
                                        <div>
                                            <button class="btn btn-warning" type="submit" name="diproses"
                                                value="diproses"><i
                                                    class="mdi mdi-check text-white me-2"></i>Proses</button>
                                        </div>
                                    @elseif ($telahTA->status == 'diproses')
                                        <div>
                                            <a class="btn btn-primary"
                                                href="{{ route('downloadWord', ['id' => $telahTA->id]) }}">
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
