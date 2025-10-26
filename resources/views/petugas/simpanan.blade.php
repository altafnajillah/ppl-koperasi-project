@extends('templates.petugas')

@section('title', 'Dashboard Petugas')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 ">
                    <div class="card  border-0 border-bottom border-3 border-primary">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h3 class="card-title text-primary">PENCATATAN SIMPANAN</h3>
                                    <p class="mb-4">
                                        Welcome <span class="fw-bold fst-italic">Joe</span>, let's monitoring your user
                                        performance
                                        more closely!
                                    </p>
                                    <a href="/petugas/simpanan/pencatatan" class="btn btn-primary">Form Pencatatan</a>
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

                {{-- table --}}
                <div class="col-lg-12 mb-4">
                    <div class="card pb-3 border-0 border-bottom border-3 border-warning">
                        <h5 class="card-header">Daftar Pengguna</h5>

                        <div class="px-4 mt-3 mb-3">
                            <div class="row gx-3">

                                <!-- Search (4 columns) -->
                                <div class="col-8 col-lg-10 mt-2 mt-lg-0 col-md-8">
                                    <div class="h-100 d-flex align-items-center">
                                        <input type="text" class="form-control h-100" placeholder="Search..." />
                                    </div>
                                </div>

                                <!-- Search butn -->
                                <div class="col-4 col-lg-2 mt-2 mt-lg-0 col-md-4">
                                    <div class="h-100 d-flex align-items-center">
                                        <div class="w-100">
                                            <a href="" class="btn btn-primary w-100 h-100">Cari</a>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="table-responsive text-nowrap px-4">
                            <table class="table mb-0 align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>Waktu</td>
                                        <td>ID Anggota</td>
                                        <td>Tipe</td>
                                        <td>Jumlah</td>
                                        <td>Metode</td>
                                        <td>Keterangan</td>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <form action="" method="POST">
                                        <tr>
                                            <td>01/01/2023</td>
                                            <td>10:00</td>
                                            <td>A001</td>
                                            <td>
                                                Wajib
                                            </td>
                                            <td>Rp. 1.000.000</td>
                                            <td>Tunai</td>
                                            <td>~~</td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- end table --}}
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    @endsection
