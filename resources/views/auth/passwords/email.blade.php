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
            <p class="login-box-msg">Silakan untuk memasukkan email itk</p>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="form-floating"> <input id="loginEmail" type="email" name="email" class="form-control"
                            value="{{ old('email') }}" placeholder=""> <label for="loginEmail">Email</label> </div>
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Email Password Reset
                                Link</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
