@extends('template-auth')
@section('isi')
    <h4 class="mb-2 mt-4">Welcome to Kopersaiku </h4>
    <p class="mb-4">Make your own account here</p>

    <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
                autofocus />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">NIK</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
                autofocus />
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">No Hp</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
                autofocus />
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
                autofocus />
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
            <label class="form-label" for="password">Konfirmasi Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
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
                    <a href="javascript:void(0);">privacy policy & terms</a>
                </label>
            </div>
        </div>
        <button class="btn btn-primary d-grid w-100">Register</button>
    </form>

    <p class="text-center">
        <span>Already have an account?</span>
        <a href="auth-login-basic.html">
            <span>Sign in instead</span>
        </a>
    </p>
@endsection
