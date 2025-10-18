@extends('template-dashboard')
@section('isi')
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
                                    <h3 class="card-title text-primary">LAPORAN KEUANGAN</h3>
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

                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12 mb-4">
                            <div class="card border-0 border-bottom border-3 border-success">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start">
                                        <div class="avatar">
                                            <span class="avatar-initial rounded bg-label-success">
                                                <i class="icon-base bi bi-cash-coin icon-lg"></i>
                                            </span>
                                        </div>
                                        <div class="ps-3">
                                            <span class="fw-semibold d-block mb-1">Total Saldo Bersih</span>
                                            <h3 class="card-title mb-2">Rp.21.000.000</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-8 col-12 mb-4">
                            <div class="card border-0 border-bottom border-3 border-danger">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start">
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-danger">
                                                    <i class="icon-base bi bi-cash-coin icon-lg"></i>
                                                </span>
                                            </div>
                                            <div class="ps-3">
                                                <span class="fw-semibold d-block mb-1">Total Pemasukan</span>
                                                <h3 class="card-title text-nowrap mb-2">Rp. 35.000.000</h3>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 mb-4">
                            <div class="card border-0 border-bottom border-3 border-warning">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start">
                                        <div class="avatar">
                                            <span class="avatar-initial rounded bg-label-warning">
                                                <i class="icon-base bi bi-cash-coin icon-lg"></i>
                                            </span>
                                        </div>
                                        <div class="ps-3">
                                            <span class="fw-semibold d-block mb-1">Total Pengeluaran</span>
                                            <h3 class="card-title mb-2">RP. 14.000.000</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- table --}}
                <div class="col-lg-12 mb-4">
                    <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                        <h5 class="card-header">Daftar Pengajuan Pinjaman Terbaru</h5>

                        <div class="px-4 mb-3">
                            <!-- Form filter: single row so columns stay aligned -->
                            <form method="GET" class="row gx-2 gy-2 align-items-center">
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
                                <div class="col-12 col-lg-2">
                                    <select id="jenis-laporan" name="jenis-laporan" class="form-select">
                                        <option value="">-- Pilih jenis laporan --</option>
                                        <option value="pendapatan">Harian</option>
                                        <option value="pengeluaran">Bulanan</option>
                                        <option value="laporan">Tahunan</option>
                                    </select>
                                </div>
                                <div class="col-6 col-lg-2">
                                    <button class="btn btn-primary w-100" type="submit">Tampilkan</button>
                                </div>
                                <div class="col-6 col-lg-2">
                                    <a href="#" class="btn btn-success w-100">Cetak CSV</a>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive text-nowrap px-4">
                            <table class="table mb-0 align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>Jenis</td>
                                        <td>Keterangan</td>
                                        <td>Pemasukan(Rp)</td>
                                        <td>Pengeluaran(Rp)</td>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>12/01/2023</td>
                                        <td>Pemasukan</td>
                                        <td>Pembayaran Angsuran</td>
                                        <td>12.000.000</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>12/01/2023</td>
                                        <td>Pembayaran Simpanan</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>12.000.000</td>
                                    </tr>
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
