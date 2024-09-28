@extends('tendik.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mb-0">Rekomendasi Beasiswa</h3>
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
                        <form class="form-sample" method="POST"
                            action="{{ route('Statusbeasiswa', ['id' => $data_beasiswa->id]) }}">
                            @csrf
                            @if ($data_beasiswa->status == 'diterima' || $data_beasiswa->status == 'diproses' || $data_beasiswa->status == 'selesai')
                                <p class="card-description">Nomor Surat</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nomor Surat</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nomor_surat"
                                                    value="{{ $data_beasiswa->nomor_surat }}" required
                                                    {{ in_array($data_beasiswa->status, ['diproses', 'selesai']) ? 'disabled' : '' }} />
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
                                                value="{{ $data_beasiswa->user->nama_lengkap }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Semester</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                value="{{ $data_beasiswa->user->semester }}" name="semester" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Nomor Induk Mahasiswa</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"
                                                value="{{ $data_beasiswa->user->nim }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Program Studi</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text"
                                                value="{{ $data_beasiswa->user->program_studi }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Indeks Prestasi Kumulatif ( IPK
                                            )</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="ipk"
                                                value="{{ $data_beasiswa->user->ipk }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SKS Tempuh</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="sks_tempuh"
                                                value="{{ $data_beasiswa->user->sks_tempuh }}" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description"> Data Permohonan </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Nama Program Beasiswa</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama_program"
                                                value="{{ $data_beasiswa->nama_program }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Nama Instansi Beasiswa</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama_perusahaan"
                                                value="{{ $data_beasiswa->nama_perusahaan }}" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="col-sm-3 col-form-label pt-0">Alamat Instansi Beasiswa</label>
                                    <textarea type="text" rows="4" class="form-control" name="alamat_perusahaan" disabled>{{ $data_beasiswa->alamat_perusahaan }}</textarea>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="col-sm-4 col-form-label">Screenshot Persetujuan Dosen Wali</label>
                                    <a class="btn btn-info" href="{{ $data_beasiswa->screenshot }}" target="_blank">
                                        Preview Screenshot
                                    </a>
                                    @if (!empty($data_beasiswa->screenshot))
                                        <embed src="{{ asset($data_beasiswa->screenshot) }}" type="application/pdf"
                                            width="100%" height="600px" />
                                    @else
                                        <input type="text" class="form-control"
                                            value="Tidak Ada File Untuk Transkrip Nilai." disabled />
                                    @endif
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="col-sm-3 col-form-label mb-2">Transkrip Nilai</label>
                                    <a class="btn btn-info" href="{{ $data_beasiswa->transkrip_nilai }}"
                                        target="_blank">
                                        Preview Transkrip Nilai
                                    </a>
                                    @if (!empty($data_beasiswa->transkrip_nilai))
                                        <embed src="{{ asset($data_beasiswa->transkrip_nilai) }}" type="application/pdf"
                                            width="100%" height="600px" />
                                    @else
                                        <input type="text" class="form-control"
                                            value="Tidak Ada File Untuk Transkrip Nilai." disabled />
                                    @endif
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="col-sm-3 col-form-label mb-2">Format Khusus</label>
                                    <a class="btn btn-info" href="{{ $data_beasiswa->format_khusus }}" target="_blank">
                                        Preview Format Khusus
                                    </a>
                                    @if (!empty($data_beasiswa->format_khusus))
                                        <embed src="{{ asset($data_beasiswa->format_khusus) }}" type="application/pdf"
                                            width="100%" height="600px" />
                                    @else
                                        <input type="text" class="form-control"
                                            value="Tidak Ada File Untuk Format Khusus." disabled />
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-start"><a href="{{ route('Verifbeasiswa') }}"
                                        class="btn btn-light me-2">Cancel</a></div>
                                <div class="col-md-6 text-end">
                                    @if ($data_beasiswa->status == 'pending')
                                        <div>
                                            <button class="btn btn-primary" type="submit" name="diterima"
                                                value="diterima"><i
                                                    class="mdi mdi-check-circle-outline text-white me-2"></i>Terima</button>
                                            <button class="btn btn-danger" type="submit" name="ditolak"
                                                value="ditolak"><i
                                                    class="mdi mdi-cancel text-white me-2"></i>Tolak</button>
                                        </div>
                                    @elseif ($data_beasiswa->status == 'diterima')
                                        <div>
                                            <button class="btn btn-warning" type="submit" name="diproses"
                                                value="diproses"><i
                                                    class="mdi mdi-check text-white me-2"></i>Proses</button>
                                        </div>
                                    @elseif ($data_beasiswa->status == 'diproses')
                                        <div>
                                            <a class="btn btn-primary"
                                                href="{{ route('downloadWordBeasiswa', ['id' => $data_beasiswa->id]) }}">
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
