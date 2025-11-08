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
                                    <h3 class="card-title text-primary">TAMBAH SIMPANAN</h3>
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
                        <h5 class="card-header">Tambah Simpanan Baru</h5>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form id="formAuthentication" class="mb-3 mx-4"
                            action="{{ url('petugas/simpanan/tambah-simpanan') }}" method="POST">
                            @csrf

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

                            <div class="mb-3 col-12">
                                <label class="form-label">Jenis</label>
                                <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Simpanan --</option>
                                    <option value="pokok" {{ old('jenis') == 'pokok' ? 'selected' : '' }}>Pokok</option>
                                    <option value="wajib" {{ old('jenis') == 'wajib' ? 'selected' : '' }}>Wajib</option>
                                    <option value="sukarela" {{ old('jenis') == 'sukarela' ? 'selected' : '' }}>Sukarela
                                    </option>
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                    name="jumlah" value="{{ old('jumlah') }}" placeholder="Masukkan jumlah">
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" value="{{ old('tanggal') }}">
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-primary w-100" type="submit">Submit</button>
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

    @section('scripts')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>
    @endsection
