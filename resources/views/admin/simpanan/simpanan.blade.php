@extends('templates.admin')

@section('title', 'Dashboard Admin')

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
                                    <h3 class="card-title text-primary">MANAJEMEN SIMPANAN</h3>
                                    <p class="mb-4">
                                        Welcome <span class="fw-bold fst-italic">Joe</span>, let's monitoring your user
                                        performance
                                        more closely!
                                    </p>
                                    <div class="d-flex gap-3">
                                        <a href="\admin\simpanan\tambah-simpanan" class="btn btn-primary">Tambah
                                            Simpanan</a>
                                        <a href="\admin\simpanan\simpanan-per-anggota" class="btn btn-primary">Simpanan Per
                                            Anggota</a>
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

                {{-- Pengajuan Pinjaman Baru --}}
                <div class="col-lg-12 mb-4">
                    <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                        <h5 class="card-header">Daftar Pengajuan Pinjaman Terbaru</h5>

                        <div class="px-4 mb-3 g-2">
                            <div class="row gx-3">
                                <div class="col-12 col-md-6 col-lg-3 mt-2">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">Dari</span>
                                        <input type="date" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mt-2">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">Sampai</span>
                                        <input type="date" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-2 mt-2">
                                    <select id="jenis-laporan" name="jenis-laporan" class="form-select">
                                        <option value="">-- Pilih Jenis Simpanan --</option>
                                        <option value="pendapatan">Wajib</option>
                                        <option value="pengeluaran">Pokok</option>
                                        <option value="pengeluaran">Sukarela</option>
                                    </select>
                                </div>
                                <!-- Search (4 columns) -->
                                <div class="col-lg-4 col-md-8 mt-2 mt-lg-0">
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
                                        <td>Nama Anggota</td>
                                        <td>Jenis</td>
                                        <td>Jumlah Simpanan(Rp)</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($simpanans as $simpanan)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($simpanan->tanggal, 'd M Y') }}</td>
                                            <td>{{ $simpanan->user->name }}</td>
                                            <td>{{ $simpanan->jenis }}</td>
                                            <td>Rp.{{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                                            <td>
                                                <a href="/admin/simpanan/edit-simpanan/{{ $simpanan->id }}"
                                                    class="btn btn-warning py-1">
                                                    Edit
                                                </a>
                                                {{-- <a href="" class="btn btn-danger py-1">
                                                Hapus
                                            </a> --}}
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
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
