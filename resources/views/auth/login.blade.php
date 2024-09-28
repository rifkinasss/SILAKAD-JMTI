@extends('layouts.login')

@section('login')
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
    <style>
        @media (max-width: 767px) {
            .bg-image {
                display: none;
            }

            .auth-form-light {
                margin: auto;
                width: 90vw;
                padding: 2rem;
            }
        }

        @media (min-width: 768px) and (max-width: 1023px) {
            .bg-image {
                display: none;
            }

            .auth-form-light {
                margin: auto;
                width: 70vw;
                padding: 2rem;
            }
        }

        @media (min-width: 1024px) {
            .bg-image {
                display: block;
            }

            .auth-form-light {
                margin: auto;
                width: 100%;
                padding: 2rem;
            }
        }

        .left-shadow {
            box-shadow: -10px 0px 15px -5px rgba(0, 0, 0, 0.3);
        }
    </style>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper-login d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-8 p-0">
                    <div class="bg-image">
                        <img src="{{ asset('assets/img/login/depan.jpg') }}"
                            style="height: 100vh; object-fit: cover; width: 100%;" alt="Branding Logo">
                    </div>
                </div>
                <div class="col-lg-4 p-auto m-auto">
                    <div class="auth-form-light px-5 px-sm-5">
                        <div class="brand-logo text-center">
                            <img src="{{ asset('assets/img/LogoJMTI.png') }}" alt="logo">
                            <h6 class="text-center mt-2">Sistem Informasi Layanan Akademik</h6>
                        </div>
                        <form class="pt-3" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text"
                                    class="form-control form-control-lg @error('identifier') is-invalid @enderror"
                                    id="exampleInputEmail1" placeholder="Username" name="identifier"
                                    value="{{ old('identifier') }}" required>
                                @error('identifier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    id="exampleInputPassword1" placeholder="Password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" class="btn btn-block btn-primary btn-lg auth-form-btn">Login</button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input"> Tetap Masuk </label>
                                </div>
                                <p>Lupa Password? <a href="{{ route('password.request') }}"
                                        class="auth-link text-black">Reset</a></p>
                            </div>
                        </form>
                    </div>
                    <div class="bg-image">
                    </div>
                </div>
                {{-- <div class="col-lg-4 p-0 m-auto left-shadow">
                </div> --}}
            </div>
        </div>
    </div>
@endsection
