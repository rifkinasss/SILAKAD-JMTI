@extends('layouts.login')

@section('content')
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0 rounded-5">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <div class="brand-logo text-center">
                        <img src="{{ asset('assets/img/logoJMTI.png') }}" alt="logo" height="100px" width="200px">
                        <p>Sistem Layanan Informasi Akademik</p>
                    </div>
                    <p class="text-center">Reset Password</p>
                    <form class="pt-2" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <input type="text"
                                class="form-control rounded-5 form-control-lg @error('email') is-invalid @enderror"
                                id="email" placeholder="Email" name="email" value="{{ $email ?? old('email') }}"
                                required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password"
                                class="form-control rounded-5 form-control-lg @error('password') is-invalid @enderror"
                                id="password" placeholder="Password" name="password" required>
                            <i class="fa fa-eye" id="togglePassword"></i>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2 d-grid gap-2">
                            <button class="btn btn-block btn-primary rounded-5 btn-lg fw-medium auth-form-btn"
                                type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function(e) {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
