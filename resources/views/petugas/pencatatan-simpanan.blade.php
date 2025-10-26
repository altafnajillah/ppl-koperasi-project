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
                                    <h3 class="card-title text-primary">PENCATATAN SIMPANAN</h3>
                                    <p class="mb-4">
                                        Welcome <span class="fw-bold fst-italic">Joe</span>, let's monitoring your user
                                        performance
                                        more closely!
                                    </p>
                                    <a href="/petugas/simpanan" class="btn btn-primary">Table Pencatatan</a>
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
                    <div class="card pb-3 border-0 border-bottom border-3 border-warning">
                        <h5 class="card-header">Catat Simpanan Baru</h5>

                        <form id="" class="mb-3 mx-4" action="" method="POST">
                            <div class="mb-3">
                                <label for="role" class="form-label">Id Anggota</label>
                                <select id="jenis-laporan" name="jenis-laporan" class="form-select">
                                    <option value="pendapatan">A001</option>
                                    <option value="pengeluaran">A002</option>
                                    <option value="laporan">A003</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Tipe Simpanan</label>
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Pokok
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Wajib
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Sukarela
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Jumlah</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your name" autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Metode Pembayaran</label>
                                <select id="jenis-laporan" name="jenis-laporan" class="form-select">
                                    <option value="pendapatan">Tunai</option>
                                    <option value="pengeluaran">Transfer</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" />
                            </div>


                            <div class="row g-3 align-items-center">
                                <div class="col-12 col-lg-9">
                                    <button class="btn btn-primary w-100" type="submit">Catat Transaksi</button>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <a href="" class="btn btn-secondary w-100">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- end form add user  --}}
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    @endsection
