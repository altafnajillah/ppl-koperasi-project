@extends('templates.petugas')

@section('title', 'Dashboard Petugas')

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
                                    <h3 class="card-title text-primary">PROFIL ANGGOTA</h3>
                                    <p class="mb-4">
                                        Welcome <span class="fw-bold fst-italic">{{ $anggota->name }}</span>, let's monitoring your user
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

                {{-- form add user  --}}
                <div class="col-lg-12 mb-4">
                    <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                        <h5 class="card-header">Profile User</h5>

                        <div class="row px-2 gx-3">
                            <div class="card-body col-lg-2">
                                <div class="d-flex align-items-start align-items-sm-center">
                                    <img src="{{ asset('templates') }}/assets/img/avatars/1.png" alt="user-avatar"
                                        class="d-block rounded" height="150" width="150" id="uploadedAvatar" />
                                </div>
                            </div>
                            <div class="card-body col-lg-10">
                                <form id="formAccountSettings" method="POST" action="{{ route('petugas.anggota.acceptBiodata', $anggota->id) }}">
                                    @csrf
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
                                            <input class="form-control" value="{{ $anggota->name }}" type="text" id="name" name="name"
                                                 autofocus />
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control" type="text" id="email" name="email"
                                                value="{{ $anggota->email }}" placeholder="john.doe@example.com" />
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input class="form-control" type="text" name="alamat" id="alamat"
                                                value="{{ $anggota->biodata->alamat }}" />
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label class="form-label" for="no_hp">No Hp</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">ID (+62)</span>
                                                <input type="text" value="{{ $anggota->biodata->no_hp }}" id="no_hp" name="no_hp"
                                                    class="form-control" placeholder="202 555 0111" />
                                            </div>
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik"
                                                value="{{ $anggota->biodata->nik }}" />
                                        </div>
                                        <div class="mb-3 col-12">
                                            <label for="ktp" class="form-label">Ktp</label>
                                            <input type="file" class="form-control" id="ktp" name="ktp"
                                                placeholder="231465" maxlength="6" />
                                            <div class="d-flex align-items-start align-items-sm-center mt-2">
                                                <img src="{{ asset('templates') }}/assets/img/avatars/1.png"
                                                    alt="user-avatar" class="d-block rounded" height="180" width="320"
                                                    id="uploadedAvatar" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 row gx-2">
                                        <div class="col-lg-12 col-6">
                                            <button type="submit" class="btn {{ $anggota->biodata->accepted_at == null ? "btn-success" : "btn-secondary" }} w-100" 
                                                {{ $anggota->biodata->accepted_at == null ? "" : "disabled" }}>{{ $anggota->biodata->accepted_at == null ? "Terima Profil" : "Telah Diterima" }}</button>
                                        </div>
                                        {{-- <div class="col-lg-4 col-6">
                                            <a href="" class="btn btn-warning w-100">Edit Profil</a>
                                        </div> --}}
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- end form add user  --}}
            </div>
            <!-- / Content -->
        </div>
        <!-- Content wrapper -->
    @endsection
