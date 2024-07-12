@extends('admin.layouts.app')

@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i
                                class="bi bi-people-fill"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Mahasiswa</span> <span
                                class="info-box-number">{{ $mahasiswa }}</span> </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm"> <i
                                class="bi bi-people-fill"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Tenaga Kependidikan</span> <span
                                class="info-box-number">{{ $tendik }}</span> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
