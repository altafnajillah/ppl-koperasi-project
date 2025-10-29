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

                        <form id="formAuthentication" class="mb-3 mx-4" action="" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input list="namaList" id="nama" name="nama" class="form-control"
                                    placeholder="Cari Nama Lengkap...">
                                <datalist id="namaList">
                                    <option value="Yasir Nakano">
                                    <option value="Altaf Najillah">
                                    <option value="Aulia Zahra">
                                </datalist>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Tujuan</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Masukkan Tujuan" />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Jumlah</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Masukkan Jumlah" />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Tenor</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Masukkan Tenor" />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Jaminan</label>
                                <input type="file" class="form-control" id="email" name="email" />
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
