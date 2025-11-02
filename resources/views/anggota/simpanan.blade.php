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
                                    <h3 class="card-title text-primary">SIMPANAN</h3>
                                    <p class="mb-4">
                                        Welcome <span class="fw-bold fst-italic">{{ $user->name }}</span>, let's monitoring
                                        your user
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

                {{-- Pengajuan Pinjaman Baru --}}
                <div class="col-lg-12 mb-4">
                    <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                        <h5 class="card-header">Daftar Simpanan</h5>

                        <form action="{{ url()->current() }}" method="GET">
                            <div class="px-4 mb-3 g-2">
                                <div class="row gx-3">
                                    <div class="col-12 col-md-4 col-lg-3 mt-2">
                                        <div class="input-group">
                                            <span class="input-group-text fw-bold">Dari</span>
                                            <input type="date" class="form-control" name="dari_tanggal"
                                                value="{{ request('dari_tanggal') }}" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3 mt-2">
                                        <div class="input-group">
                                            <span class="input-group-text fw-bold">Sampai</span>
                                            <input type="date" class="form-control" name="sampai_tanggal"
                                                value="{{ request('sampai_tanggal') }}" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3 mt-2">
                                        <select id="jenis-laporan" name="jenis_simpanan" class="form-select">
                                            <option value="">-- Pilih Jenis Simpanan --</option>
                                            <option value="Wajib" @selected(request('jenis_simpanan') == 'Wajib')>Wajib
                                            </option>
                                            <option value="Pokok" @selected(request('jenis_simpanan') == 'Pokok')>Pokok
                                            </option>
                                            <option value="Sukarela" @selected(request('jenis_simpanan') == 'Sukarela')>
                                                Sukarela</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3 mt-2">
                                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive text-nowrap px-4">
                            <table class="table mb-0 align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>Jenis</td>
                                        <td>Jumlah Simpanan (Rp)</td>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($simpanans as $simpanan)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($simpanan->tanggal)->format('d M Y') }}</td>
                                            <td>{{ $simpanan->jenis }}</td>
                                            <td>Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data simpanan yang ditemukan.</td>
                                        </tr>
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