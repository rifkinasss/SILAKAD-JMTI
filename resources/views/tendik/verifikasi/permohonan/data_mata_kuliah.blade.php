@extends('tendik.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mb-0">Riwayat</h3>
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
                        <table id="user-admin" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="small-width text-center">NO</th>
                                    <th class="text-center">Nama mahasiswa</th>
                                    <th class="text-center">Jenis Layanan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Lapor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataMatkul as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $data->user->nama_lengkap }}</td>
                                        <td class="text-center">{{ $data->jenis_layanan }}</td>
                                        <td class="text-center">
                                            @if ($data->status == 'pending')
                                                <span class="badge rounded-pill text-bg-primary">Pending</span>
                                            @elseif ($data->status == 'sedang diverifikasi')
                                                <span class="badge rounded-pill text-bg-warning text-dark">Sedang
                                                    DiVerifikasi</span>
                                            @elseif ($data->status == 'diterima')
                                                <span class="badge rounded-pill text-bg-success">Diterima</span>
                                            @elseif ($data->status == 'ditolak')
                                                <span class="badge rounded-pill text-bg-danger">Ditolak</span>
                                            @elseif ($data->status == 'selesai')
                                                <span class="badge rounded-pill text-bg-dark">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-danger"
                                                href="{{ route('detailDataMatkul', ['id' => $data->id]) }}">Detail</a>
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
@endsection
