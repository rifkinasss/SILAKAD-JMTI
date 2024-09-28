@extends('mahasiswa.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mb-0">Rekomendasi Lomba</h3>
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
                        <form class="form-sample" method="POST" action="{{ route('StoreRekLomba') }}"
                            enctype="multipart/form-data">
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
                                        <label class="col-sm-3 col-form-label">Semester</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ Auth::user()->semester }}"
                                                name="semester" required />
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Indeks Prestasi Kumulatif ( IPK
                                            )</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="ipk"
                                                value="{{ Auth::user()->ipk }}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SKS Tempuh</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="sks_tempuh"
                                                value="{{ Auth::user()->sks_tempuh }}" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description"> Data Permohonan </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Nama Program Lomba</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama_program" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Nama Instansi Lomba</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama_perusahaan" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Alamat Instansi Lomba</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" rows="4" class="form-control" name="alamat_perusahaan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Screenshot </label>
                                        <div class="col-sm-9">
                                            <input type="file" class="file-upload-default" accept="image/*"
                                                name="screenshot" />
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled
                                                    placeholder="Upload Image .png/jpg">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary"
                                                        type="button">Upload</button>
                                                </span>
                                            </div>
                                            <p class="card-description pt-0">* WhatsApp atau Email persetujuan Dosen Wali
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Transkrip Nilai</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="file-upload-default" accept="application/pdf"
                                                name="transkrip_nilai" />
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled
                                                    placeholder="Upload Dokumen .pdf" name="transkrip_nilai">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary"
                                                        type="button">Upload</button>
                                                </span>
                                            </div>
                                            <p class="card-description pt-0">* Masukkan Transkrip Nilai Terbaru dengan
                                                format
                                                .pdf</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label pt-0">Format Khusus Surat</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="file-upload-default" accept="application/pdf"
                                                name="format_khusus" />
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled
                                                    placeholder="Upload Dokumen .pdf">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary"
                                                        type="button">Upload</button>
                                                </span>
                                            </div>
                                            <p class="card-description pt-0">* Kosongkan jika tidak ada</p>
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
