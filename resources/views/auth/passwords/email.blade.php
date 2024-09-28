@extends('layouts.login')

@section('login')
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0 rounded-5">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <div class="brand-logo text-center">
                        <img src="{{ asset('assets/img/logoJMTI.png') }}" alt="logo" height="100px" width="200px">
                        <p>Sistem Layanan Informasi Akademik</p>
                    </div>
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 font-medium text-sm text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form class="pt-2" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text"
                                class="form-control rounded-5 form-control-lg @error('email') is-invalid @enderror"
                                id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2 d-grid gap-2">
                            <button class="btn btn-block btn-primary rounded-5 btn-lg fw-medium auth-form-btn"
                                type="submit">Email Password Reset
                                Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
