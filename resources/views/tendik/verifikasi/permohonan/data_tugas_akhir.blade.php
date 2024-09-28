@extends('tendik.layouts.app')

@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0-beta3/css/bootstrap.min.css" rel="stylesheet">

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
                                @foreach ($dataTA as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $data->user->nama_lengkap }}</td>
                                        <td>{{ $data->jenis_layanan }}</td>
                                        <td class="text-center">
                                            @if ($data->status == 'pending')
                                                <span class="badge rounded-pill text-bg-primary">Pending</span>
                                            @elseif ($data->status == 'diproses')
                                                <span class="badge rounded-pill text-bg-warning text-dark">Proses</span>
                                            @elseif ($data->status == 'diterima')
                                                <span class="badge rounded-pill text-bg-success">Terima</span>
                                            @elseif ($data->status == 'ditolak')
                                                <span class="badge rounded-pill text-bg-danger">Tolak</span>
                                            @elseif ($data->status == 'selesai')
                                                <span class="badge rounded-pill text-bg-dark">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-danger"
                                                href="{{ route('detaildataTA', ['id' => $data->id]) }}">Detail</a>
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
