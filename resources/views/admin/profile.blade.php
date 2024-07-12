@extends('admin.layouts.app')

@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User Profile</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard-admin') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            User Profile
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ Auth::guard('admin')->user()->profile_photo_url }}"
                                        alt="{{ Auth::guard('admin')->user()->name }}">
                                @endif
                            </div>
                            <h3 class="profile-username text-center">{{ Auth::guard('admin')->user()->name }}</h3>
                            <p class="text-muted text-center">Admin</p>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="settings-tab" data-toggle="tab" href="#settings"
                                        role="tab" aria-controls="settings" aria-selected="false">Settings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="settings" role="tabpanel"
                                    aria-labelledby="settings-tab">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('UpdateProfileAdmin', ['id' => $admin->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row mb-3">
                                            <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName"
                                                    value="{{ $admin->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                    value="{{ $admin->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
