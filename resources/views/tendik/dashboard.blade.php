@extends('tendik.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                            <div class="row justify-content-between">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i
                                                class="bi bi-hourglass-split"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Pending</span> <span
                                                class="info-box-number">
                                                {{ $total_pending }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-green shadow-sm"> <i
                                                class="bi bi-check2-all text-black"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Terima</span> <span
                                                class="info-box-number">
                                                {{ $total_diterima }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-dark shadow-sm">
                                            <i class="bi bi-file-check"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Selesai</span> <span
                                                class="info-box-number">
                                                {{ $total_selesai }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Proses</span>
                                            <span class="info-box-number">
                                                {{ $total_diproses }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-danger shadow-sm">
                                            <i class="bi bi-x-lg"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Tolak</span> <span
                                                class="info-box-number">
                                                {{ $total_ditolak }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-info shadow-sm">
                                            <i class="bi bi-person"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Total User</span> <span
                                                class="info-box-number">
                                                {{ $total_user }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
