@extends('templates.anggota')

@section('title', 'Dashboard Anggota')

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
                                    <h3 class="card-title text-primary">PINJAMAN</h3>
                                    <p class="mb-4">
                                        Welcome <span class="fw-bold fst-italic">Joe</span>, let's monitoring your user
                                        performance
                                        more closely!
                                    </p>
                                    <div class="d-flex gap-3">
                                        <a href="\anggota\pinjaman\tambah-pinjaman" class="btn btn-primary">Tambah
                                            Pinjaman</a>
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

                {{-- Daftar Pinjaman Aktif  --}}
                <div class="col-lg-12 mb-4">
                    <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                        <h5 class="card-header">Daftar Pinjaman Aktif</h5>

                        <div class="px-4 mb-3">
                            <div class="row gx-3">
                                <!-- Search (4 columns) -->
                                <div class="col-12 col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">Dari</span>
                                        <input type="date" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">Sampai</span>
                                        <input type="date" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-2 mt-lg-0">
                                    <div class="h-100 d-flex align-items-center">
                                        <input type="text" class="form-control h-100" placeholder="Search..." />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive text-nowrap px-4">
                            <table class="table mb-0 align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>Jumlah Pinjaman(Rp)</td>
                                        <td>Tenor</td>
                                        <td>Bunga(%)</td>
                                        <td>Alasan</td>
                                        <td>Jaminan</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>12-12-20223</td>
                                        <td>Rp.12.000.000</td>
                                        <td>12 Bulan</td>
                                        <td>5%</td>
                                        <td>Untuk Modal Usaha</td>
                                        <td>
                                            <a href="{{ asset('templates') }}/assets/img/avatars/1.png" target="_blank"
                                                class="ne-flex align-items-center rounded px-2 py-1 btn btn-primary">
                                                <i class="bi bi-file-earmark-text-fill me-2 fs-6"></i>
                                                1.png
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/anggota/pinjaman/riwayat-angsuran" class="btn btn-primary py-1">
                                                Riwayat Angsuran
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    @endsection
