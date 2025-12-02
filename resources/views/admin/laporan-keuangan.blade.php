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
                                            <h3 class="card-title mb-2">Rp.{{ number_format($saldoBersih, 0, ',', '.') }}
                                            </h3>
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
                                                <h3 class="card-title text-nowrap mb-2">
                                                    Rp.{{ number_format($pemasukan, 0, ',', '.') }}</h3>
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
                                            <h3 class="card-title mb-2">Rp.{{ number_format($pengeluaran, 0, ',', '.') }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Main Card --}}
                <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                    <h5 class="card-header">Daftar Simpanan dan Pinjaman</h5>

                    <div class="px-4 mb-3">
                        {{-- FORM FILTER & EXPORT --}}
                        {{-- Action default mengarah ke Index (Tampilan Web) --}}
                        <form method="GET" action="{{ route('laporan.index') }}" class="row gx-2 gy-2 align-items-center">

                            <div class="col-12 col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold">Dari</span>
                                    {{-- 'value' mempertahankan input user setelah reload --}}
                                    <input type="date" name="start_date" class="form-control"
                                        value="{{ request('start_date') }}" />
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold">Sampai</span>
                                    <input type="date" name="end_date" class="form-control"
                                        value="{{ request('end_date') }}" />
                                </div>
                            </div>

                            <div class="col-12 col-lg-2">
                                <select name="jenis_laporan" class="form-select">
                                    <option value="">-- Semua --</option>
                                    <option value="pemasukan"
                                        {{ request('jenis_laporan') == 'pemasukan' ? 'selected' : '' }}>
                                        Pemasukan</option>
                                    <option value="pengeluaran"
                                        {{ request('jenis_laporan') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran
                                    </option>
                                </select>
                            </div>

                            <div class="col-6 col-lg-2">
                                <div class="d-grid gap-2">
                                    {{-- Tombol CSV: Submit ke route('laporan.export') berkat 'formaction' --}}
                                    {{-- Data tanggal & select di form ini akan otomatis ikut terkirim --}}
                                    <button type="submit" formaction="{{ route('laporan.export') }}"
                                        class="btn btn-success">
                                        Cetak CSV
                                    </button>
                                </div>
                            </div>
                            <div class="col-6 col-lg-2">
                                <div class="d-grid gap-2">
                                    {{-- Tombol Filter: Submit biasa ke route('laporan.index') --}}
                                    <button type="submit" class="btn btn-primary">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- TABLE DATA --}}
                    <div class="table-responsive text-nowrap px-4">
                        <table class="table mb-0 align-middle table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Transaksi</th>
                                    <th>Nominal (Rp)</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $datum)
                                    <tr>
                                        <td>
                                            {{ $datum->tanggal ? \Carbon\Carbon::parse($datum->tanggal)->format('d M Y') : '-' }}
                                        </td>
                                        <td>
                                            @if ($datum->kategori == 'pemasukan')
                                                <span
                                                    class="badge bg-success bg-opacity-75">{{ $datum->jenis_label }}</span>
                                            @else
                                                <span
                                                    class="badge bg-danger bg-opacity-75">{{ $datum->jenis_label }}</span>
                                            @endif
                                        </td>
                                        <td class="fw-bold">
                                            Rp {{ number_format($datum->jumlah, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $datum->keterangan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            Tidak ada data ditemukan untuk periode ini.
                                        </td>
                                    </tr>
                                @endforelse
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
