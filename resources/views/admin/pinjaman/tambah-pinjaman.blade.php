@extends('templates.admin')

@section('title', 'Dashboard Admin')

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
                                    <h3 class="card-title text-primary">TAMBAH PINJAMAN</h3>
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
                        <h5 class="card-header">Tambah Pinjaman Baru</h5>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form id="formAuthentication" class="mb-3 mx-4" action="{{ route('admin.pinjaman.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="">
                                <p class="bg-secondary text-white p-2 rounded text-center">
                                    Batas Pinjaman Maksimal: Rp 10.000.000. Jika melebihi batas, jaminan diperlukan.
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <select class="js-example-basic-single form-control @error('user_id') is-invalid @enderror"
                                    name="user_id">
                                    <option value="">-- Pilih Anggota --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tujuan / Alasan --}}
                            <div class="mb-3">
                                <label for="alasan" class="form-label">Tujuan</label>
                                <input type="text" class="form-control @error('alasan') is-invalid @enderror"
                                    id="alasan" name="alasan" value="{{ old('alasan') }}"
                                    placeholder="Masukkan Tujuan" />
                                @error('alasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jumlah --}}
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                    id="jumlah" name="jumlah" value="{{ old('jumlah') }}"
                                    placeholder="Masukkan Jumlah" />
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tenor --}}
                            <div class="mb-3">
                                <label for="tenor" class="form-label">Tenor (bulan)</label>
                                <input type="number" class="form-control @error('tenor') is-invalid @enderror"
                                    id="tenor" name="tenor" value="{{ old('tenor') }}"
                                    placeholder="Masukkan Tenor" />
                                @error('tenor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Jaminan --}}
                            <div class="mb-3">
                                <label for="jaminan" class="form-label">Jaminan</label>
                                <input type="file" class="form-control @error('jaminan') is-invalid @enderror"
                                    id="jaminan" name="jaminan" />
                                @error('jaminan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row gx-3 align-items-center mt-3">
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                {{-- end form add user --}}
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    @endsection
