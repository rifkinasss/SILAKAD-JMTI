@extends('layouts.login')

@section('login')
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <div class="card card-outline card-primary">
        <div class="card-header">
            <a href="http://s.itk.ac.id/LayananJMTI"
                class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
                style="text-decoration: none;">
                <h1 class="mb-0" style="text-decoration: none;"> <img src="{{ asset('assets/img/LogoJMTI.png') }}"
                        alt="Logo JMTI" height="50px">
                    SILAKAD JMTI
                </h1>
            </a>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Masuk untuk memulai layanan!</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <input id="loginEmail" type="text" name="identifier" class="form-control"
                            value="{{ old('identifier') }}" placeholder="Masukkan Username">
                        <label for="loginEmail">Email</label>
                    </div>
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                </div>
                <div class="input-group mb-3">
                    <div class="form-floating">
                        <input id="loginPassword" type="password" name="password" class="form-control"
                            placeholder="Masukkan Password">
                        <label for="loginPassword">Password</label>
                    </div>
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                </div>
                <div class="row">
                    <div class="col-8 d-inline-flex align-items-center">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault">
                                Remember Me
                            </label> </div>
                    </div>
                    <div class="col-4">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>
                    </div>
                </div>
            </form>
            <p class="mb-1">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </p>
        </div>
    </div>
@endsection
