@extends('templates.auth')
@section('isi')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{ asset('templates') }}/assets/img/illustrations/man-with-laptop-light.png" height="140"
                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png" />
        </div>
        <h4 class="mb-2">Satu Langkah Terakhir! Periksa Email Anda</h4>
        <p class="mb-4 mx-2 text-center">Pendaftaran Anda hampir selesai. Silakan buka inbox (kotak masuk) email Anda dan
            klik link
            verifikasi
            yang telah kami kirimkan untuk mengaktifkan akun Anda.</p>
        <div class="">
            <p class="bg-info text-dark p-2 px-3 rounded">Tidak menemukan emailnya? Pastikan untuk memeriksa folder
                Spam/Junk
                Anda.</p>
        </div>
    </div>
@endsection
