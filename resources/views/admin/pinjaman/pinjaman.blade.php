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
                                    <h3 class="card-title text-primary">MANAJEMEN PINJAMAN</h3>
                                    <p class="mb-4">
                                        Welcome <span class="fw-bold fst-italic">Joe</span>, let's monitoring your user
                                        performance
                                        more closely!
                                    </p>
                                    <div class="d-flex gap-3">
                                        <a href="\admin\pinjaman\tambah-pinjaman" class="btn btn-primary">Tambah
                                            Pinjaman</a>
                                        <a href="\admin\pinjaman\tambah-angsuran" class="btn btn-primary">Tambah
                                            Angsuran</a>
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
                {{-- Daftar Pengajuan Pinjaman Terbaru --}}
                <div class="col-lg-12 mb-4">
                    <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                        <h5 class="card-header">Daftar Pengajuan Pinjaman Terbaru</h5>

                        <div class="px-4 mb-3">
                            {{-- FORM PENCARIAN PENGAJUAN (Pending) --}}
                            <form action="{{ url()->current() }}" method="GET">
                                {{-- Pertahankan filter tabel bawah jika ada --}}
                                @foreach(request()->except(['search_pending', '_token']) as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach

                                <div class="row gx-3">
                                    <div class="col-12 mt-2 mt-lg-0">
                                        <div class="h-100 d-flex align-items-center">
                                            {{-- Tambahkan name="search_pending" dan value --}}
                                            <input type="text" name="search_pending" value="{{ request('search_pending') }}"
                                                class="form-control h-100"
                                                placeholder="Cari nama anggota... (Tekan Enter)" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive text-nowrap px-4">
                            <table class="table mb-0 align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>Nama Anggota</td>
                                        <td>Jumlah Pinjaman(Rp)</td>
                                        <td>Tenor</td>
                                        <td>Alasan</td>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($pengajuanPinjaman as $pj)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($pj->tanggal)->format('d M Y') }}</td>
                                            <td>{{ $pj->user->name }}</td>
                                            <td>Rp.{{ number_format($pj->jumlah, 0, ',', '.') }}</td>
                                            <td>{{ $pj->tenor }} Bulan</td>
                                            <td>{{ $pj->alasan }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Daftar Pinjaman Aktif --}}
                <div class="col-lg-12 mb-4">
                    <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                        <h5 class="card-header">Daftar Pinjaman Aktif</h5>

                        <div class="px-4 mb-3">
                            {{-- FORM FILTER PINJAMAN AKTIF --}}
                            <form action="{{ url()->current() }}" method="GET">
                                {{-- Pertahankan filter tabel atas jika ada --}}
                                @if(request('search_pending'))
                                    <input type="hidden" name="search_pending" value="{{ request('search_pending') }}">
                                @endif

                                <div class="row gx-3">
                                    <div class="col-12 col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-text fw-bold">Dari</span>
                                            {{-- Input Date From --}}
                                            <input type="date" name="date_from" value="{{ request('date_from') }}"
                                                class="form-control" onchange="this.form.submit()" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-text fw-bold">Sampai</span>
                                            {{-- Input Date To --}}
                                            <input type="date" name="date_to" value="{{ request('date_to') }}"
                                                class="form-control" onchange="this.form.submit()" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-2 mt-lg-0">
                                        <div class="h-100 d-flex align-items-center">
                                            {{-- Input Search Active --}}
                                            <input type="text" name="search_active" value="{{ request('search_active') }}"
                                                class="form-control h-100"
                                                placeholder="Cari nama anggota... (Tekan Enter)" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive text-nowrap px-4">
                            <table class="table mb-0 align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>Nama Anggota</td>
                                        <td>Jumlah Pinjaman(Rp)</td>
                                        <td>Tenor</td>
                                        <td>Alasan</td>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($pinjamanAktif as $pj)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($pj->tanggal)->format('d M Y') }}</td>
                                            <td>{{ $pj->user->name }}</td>
                                            <td>Rp.{{ number_format($pj->jumlah, 0, ',', '.') }}</td>
                                            <td>{{ $pj->tenor }} Bulan</td>
                                            <td>{{ $pj->alasan }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada pinjaman aktif yang sesuai filter.
                                            </td>
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