@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i
                                                class="bi bi-person"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Mahasiswa</span> <span
                                                class="info-box-number">
                                                {{ $mahasiswa }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box"> <span class="info-box-icon text-bg-green shadow-sm"> <i
                                                class="bi bi-person-gear"></i> </span>
                                        <div class="info-box-content"> <span class="info-box-text">Tendik</span> <span
                                                class="info-box-number">
                                                {{ $tendik }}</span>
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
