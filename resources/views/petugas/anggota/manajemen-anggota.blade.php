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
                                    <h3 class="card-title text-primary">MANAJEMEN ANGGOTA</h3>
                                    <p class="mb-4">
                                        Welcome <span class="fw-bold fst-italic">Joe</span>, let's monitoring your user
                                        performance
                                        more closely!
                                    </p>
                                    <a href="/petugas/anggota/tambah-anggota" class="btn btn-primary">Tambah Anggota</a>
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
                    <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                        <h5 class="card-header">Daftar Anggota</h5>

                        <form action="{{ route('petugas.anggota.index') }}" method="GET">
                            <div class="px-4 mt-3 mb-3">
                                <div class="row gx-3">
                                    <div class="col-12 col-lg-2">
                                        <div class="h-100 d-flex align-items-center">
                                            <div class="w-100 bg-secondary text-white rounded px-3 py-2">
                                                <span class="me-3 fw-semibold">Total Anggota: <span
                                                        class="fw-bold">{{ $totalAnggota }}</span></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-2 mt-2 mt-lg-0 col-md-4">
                                        <div class="h-100">
                                            <select name="status" class="form-select h-100" aria-label="Filter Status">
                                                <option value="">Semua Status</option>
                                                <option value="ditunda"
                                                    {{ request('status') == 'ditunda' ? 'selected' : '' }}>Ditunda</option>
                                                <option value="diterima"
                                                    {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-8 mt-2 mt-lg-0 col-md-4">
                                        <div class="input-group h-100">
                                            <input type="text" name="search" class="form-control h-100"
                                                placeholder="Cari nama atau email..." value="{{ request('search') }}" />

                                            <button class="btn btn-primary" type="submit">Cari</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive text-nowrap px-4">
                            <table class="table mb-0 align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <td>No</td>
                                        <td>Nama</td>
                                        <td>Email</td>
                                        <td>Status</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">

                                    @forelse ($anggota as $ang)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ang->name }}</td>
                                            <td>{{ $ang->email }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $ang->biodata->accepted_at == null ? 'bg-label-danger' : 'bg-label-success' }} me-1">
                                                    {{ $ang->biodata->accepted_at == null ? 'Ditunda' : 'Diterima' }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('petugas.anggota.destroy', $ang->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan!');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="/petugas/anggota/profil-anggota/{{ $ang->id }}"
                                                        class="btn btn-primary py-1">
                                                        Lihat Profile
                                                    </a>

                                                    <a href="{{ route('petugas.anggota.edit', $ang->id) }}"
                                                        class="btn btn-warning py-1">
                                                        Edit
                                                    </a>

                                                    <button class="btn btn-danger py-1" type="submit">
                                                        Hapus
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data anggota yang ditemukan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <!-- / Content --> --}}

            <div class="content-backdrop fade"></div>
        </div>
        {{-- <!-- Content wrapper --> --}}
    @endsection
