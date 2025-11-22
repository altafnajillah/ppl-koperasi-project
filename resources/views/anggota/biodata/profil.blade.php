@extends('templates.anggota')

@section('title', 'Dashboard Anggota')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 ">
                    <div class="card border-0 border-bottom border-3 border-primary">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h3 class="card-title text-primary">PROFIL SAYA</h3>
                                    <p class="mb-4">
                                        Welcome <span class="fw-bold fst-italic">Joe</span>, let's monitoring your user
                                        performance
                                        more closely!
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('templates') }}/assets/img/illustrations/man-with-laptop-light.png"
                                        height="140" alt="View Badge User"
                                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- form add user --}}
                <div class="col-lg-12 mb-4">
                    <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                        <h5 class="card-header">Profile Saya</h5>

                        @session('success')
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endsession

                        @session('warning')
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                {{ session('warning') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endsession

                        <div class="row px-2 gx-3">
                            <div class="card-body col-lg-2">
                                <div class="d-flex align-items-start align-items-sm-center">
                                    <img src="{{ asset('templates') }}/assets/img/avatars/1.png" alt="user-avatar"
                                        class="d-block rounded" height="150" width="150" id="uploadedAvatar" />
                                </div>
                            </div>
                            <div class="card-body col-lg-10">
                                @if ($biodata)
                                    <form id="formAccountSettings" method="POST" action="{{ route('anggota.biodata.update') }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="button-wrapper col-12 ">
                                                <label for="upload" class="btn btn-primary mb-4 w-100" tabindex="0">
                                                    <span class="d-block">Upload New Foto</span>
                                                    <input type="file" id="upload" class="account-file-input" hidden
                                                        accept="image/png, image/jpeg" />
                                                </label>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    value="{{ $user->name }}" autofocus />
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" type="text" id="email" name="email"
                                                    value="{{ $user->email }}" placeholder="john.doe@example.com" />
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input class="form-control" type="text" name="alamat" id="alamat"
                                                    value="{{ $biodata->alamat }}" />
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label" for="no_hp">No Hp</label>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">ID (+62)</span>
                                                    <input type="text" id="no_hp" name="no_hp" class="form-control"
                                                        placeholder="812 3456 7890" value="{{ $biodata->no_hp }}" />
                                                </div>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="nik" class="form-label">NIK</label>
                                                <input type="text" class="form-control" id="nik" name="nik"
                                                    value="{{ $biodata->nik }}" />
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="ktp" class="form-label">Ktp</label>
                                                <input type="file" class="form-control" id="ktp" name="ktp" placeholder="231465"
                                                    maxlength="6" />
                                                <div class="d-flex align-items-start align-items-sm-center mt-2">
                                                    <img src="{{ asset('templates') }}/assets/img/avatars/1.png"
                                                        alt="user-avatar" class="d-block rounded" height="180" width="320"
                                                        id="uploadedAvatar" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2 row gx-2">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-warning w-100">Edit Profil</button>
                                            </div>
                                        </div>
                                    </form>

                                @else
                                    <form id="formAccountSettings" method="POST" action="{{ route('anggota.biodata.store') }}">
                                        <div class="row">
                                            @csrf
                                            <div class="button-wrapper col-12 ">
                                                <label for="upload" class="btn btn-primary mb-4 w-100" tabindex="0">
                                                    <span class="d-block">Upload New Foto</span>
                                                    <input type="file" id="upload" class="account-file-input" hidden
                                                        accept="image/png, image/jpeg" />
                                                </label>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    value="{{ $user->name }}" autofocus disabled />
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" type="text" id="email" name="email"
                                                    value="{{ $user->email }}" placeholder="john.doe@example.com" disabled />
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input class="form-control" type="text" name="alamat" id="alamat" />
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label" for="no_hp">No Hp</label>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">ID (+62)</span>
                                                    <input type="text" id="no_hp" name="no_hp" class="form-control"
                                                        placeholder="812 3456 7890" />
                                                </div>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="nik" class="form-label">NIK</label>
                                                <input type="text" class="form-control" id="nik" name="nik" value="" />
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label for="ktp" class="form-label">Ktp</label>
                                                <input type="file" class="form-control" id="ktp" name="ktp" placeholder="231465"
                                                    maxlength="6" />
                                                <div class="d-flex align-items-start align-items-sm-center mt-2">
                                                    <img src="{{ asset('templates') }}/assets/img/avatars/1.png"
                                                        alt="user-avatar" class="d-block rounded" height="180" width="320"
                                                        id="uploadedAvatar" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2 row gx-2">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary w-100">Simpan Profil</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
                {{-- end form add user --}}
            </div>
            <!-- / Content -->
        </div>
        <!-- Content wrapper -->
@endsection