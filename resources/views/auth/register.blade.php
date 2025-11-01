@extends('templates.auth')
@section('isi')
    <h4 class="mb-2 mt-4 fw-bold text-center fs-3 mb-4">Register</h4>

    <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                autofocus />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
        </div>
        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password">Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <ahref="javascript:void(0);">privacy policy & terms</ahref=>
                </label>
            </div>
        </div>
        <button class="btn btn-primary d-grid w-100">Register</button>
    </form>

    <p class="text-center">
        <span>Already have an account?</span>
        <a href="\">
            <span>Login</span>
        </a>
    </p>
@endsection
