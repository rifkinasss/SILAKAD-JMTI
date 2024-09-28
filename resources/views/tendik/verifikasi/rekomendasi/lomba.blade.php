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
                                    <th>NO</th>
                                    <th>Nama Lengkap Mhs</th>
                                    <th>Jenis Layanan</th>
                                    <th>Status</th>
                                    <th>Lapor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_lomba as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->user->nama_lengkap }}</td>
                                        <td>{{ $data->jenis_layanan }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>
                                            <a class="btn btn-outline-danger"
                                                href="{{ route('detaillomba', ['id' => $data->id]) }}">Detail</a>
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
