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
                                    <h3 class="card-title text-primary">SIMPANAN PER ANGGOTA</h3>
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

                {{-- Pengajuan Pinjaman Baru --}}
                <div class="col-lg-12 mb-4">
                    <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                        <h5 class="card-header">Daftar Simpanan Per Anggota</h5>

                        <div class="px-4 mb-3">
                            <div class="row gx-3">
                                <div class="col-12 mt-2 mt-lg-0">
                                    <form action="{{ url()->current() }}" method="GET">
                                        <div class="h-100 d-flex align-items-center">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control h-100" placeholder="Cari nama anggota..." />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive text-nowrap px-4">
                            <div style="max-height: 500px; overflow-y: auto;">
                                <table class="table mb-0 align-middle">
                                    <thead class="table-dark sticky-top text-white">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Anggota</th>
                                            <th>Wajib(Rp)</th>
                                            <th>Pokok(Rp)</th>
                                            <th>Sukarela(Rp)</th>
                                            <th>Total(Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse ($data as $user)
                                            @php
                                                $grandTotal = ($user->wajib ?? 0) + ($user->pokok ?? 0) + ($user->sukarela ?? 0);
                                            @endphp
                                            <tr>
                                                <td>{{ $user->tanggal_terakhir ? \Carbon\Carbon::parse($user->tanggal_terakhir)->format('d-m-Y') : '-' }}
                                                </td>
                                                <td class="fw-bold">{{ $user->name }}</td>
                                                <td>Rp {{ number_format($user->wajib ?? 0, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($user->pokok ?? 0, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($user->sukarela ?? 0, 0, ',', '.') }}</td>
                                                <td class="fw-bold text-primary">Rp
                                                    {{ number_format($grandTotal, 0, ',', '.') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data ditemukan.</td>
                                            </tr>
                                        @endforelse
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