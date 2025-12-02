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
                                    <h3 class="card-title text-primary">RIWAYAT ANGSURAN</h3>
                                    <p class="mb-4">
                                        Welcome <span class="fw-bold fst-italic">Joe</span>, let's monitoring your user
                                        performance
                                        more closely!
                                    </p>
                                    <div class="d-flex gap-3">
                                        {{-- <a href="\petugas\pinjaman\tambah-angsuran" class="btn btn-primary">Tambah
                                            Angsuran</a> --}}
                                    </div>
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

                {{-- Pengajuan Pinjaman Baru  --}}
                <div class="col-lg-12 mb-4">
                    <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                        <h5 class="card-header">Daftar Riwayat Angsuran</h5>

                        <div class="card-body ps-4">
                            <div class="col-12 border border-secondary p-2 px-3 rounded mb-3 d-flex">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <table>
                                            <tr>
                                                <td>Nama</td>
                                                <td style="padding: 0 10px;">:</td>
                                                <td>Joe</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td style="padding: 0 10px;">:</td>
                                                <td>Jakarta</td>
                                            </tr>
                                            <tr>
                                                <td>No Hp</td>
                                                <td style="padding: 0 10px;">:</td>
                                                <td>08123456789</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-4 col-lg-2 ms-3 bg-warning pt-2 row rounded">
                                        <div class="text-white">Sisa Tenor</div>
                                        <h2 class="text-white">7</h2>
                                    </div>
                                    <div class="col-7 col-lg-5 ms-3 bg-primary pt-2 row rounded">
                                        <div class="text-white">Sisa Pinjaman</div>
                                        <h2 class="text-white">Rp. 7.000.000</h2>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 table-responsive text-nowrap">
                                <table class="table mb-0 align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <td>Bulan</td>
                                            <td>Tanggal</td>
                                            <td>Jumlah</td>
                                            <td>Status</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>12-12-2023</td>
                                            <td>Rp. 1.000.000</td>
                                            <td><span class="badge bg-label-success">Lunas</span></td>
                                            <td>
                                                <form action="" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menandai angsuran ini sebagai dibayar?');">
                                                    <button class="btn btn-success py-1">Tandai Dibayar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    @endsection
