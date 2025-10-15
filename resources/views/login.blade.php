@extends('template-auth')
@section('isi')
    <h4 class="mb-2 mt-4">Welcome to Kopersaiku </h4>
    <p class="mb-4">Please Login to your account</p>

    <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email-username"
                placeholder="Enter your email or username" autofocus />
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="auth-forgot-password-basic.html">
                    <small>Forgot Password?</small>
                </a>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100 mt-4" type="submit">Login</button>
        </div>
    </form>

    <p class="text-center">
        <span>New on our platform?</span>
        <a href="\temp-register">
            <span>Create an account</span>
        </a>
    </p>
@endsection
