@extends('templates.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-lg-12 mb-4">
                <div class="card pb-3 border-0 border-bottom border-3 border-primary">
                    <h5 class="card-header">Daftar Pengajuan Pinjaman Terbaru</h5>

                    <div class="px-4 mb-3 g-2">
                        {{-- FORM FILTER --}}
                        <form action="{{ url()->current() }}" method="GET">
                            <div class="row gx-3">
                                <div class="col-12 col-md-6 col-lg-3 mt-2">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">Dari</span>
                                        {{-- Input Date From --}}
                                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                                            class="form-control" onchange="this.form.submit()" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3 mt-2">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold">Sampai</span>
                                        {{-- Input Date To --}}
                                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                                            class="form-control" onchange="this.form.submit()" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-2 mt-2">
                                    {{-- Select Jenis Simpanan --}}
                                    {{-- Note: Value disesuaikan dengan isi database (misal: lowercase) --}}
                                    <select id="jenis-laporan" name="jenis_simpanan" class="form-select"
                                        onchange="this.form.submit()">
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Wajib" {{ request('jenis_simpanan') == 'Wajib' ? 'selected' : '' }}>
                                            Wajib</option>
                                        <option value="Pokok" {{ request('jenis_simpanan') == 'Pokok' ? 'selected' : '' }}>
                                            Pokok</option>
                                        <option value="Sukarela"
                                            {{ request('jenis_simpanan') == 'Sukarela' ? 'selected' : '' }}>Sukarela
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-8 mt-2 mt-lg-0">
                                    <div class="h-100 d-flex align-items-end">
                                        {{-- Input Search --}}
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            class="form-control" placeholder="Cari nama anggota... (Enter)" />
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
                                    <td>Jenis</td>
                                    <td>Jumlah Simpanan(Rp)</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($simpanans as $simpanan)
                                    <tr>
                                        {{-- Koreksi format tanggal agar tidak error --}}
                                        <td>{{ \Carbon\Carbon::parse($simpanan->tanggal)->format('d M Y') }}</td>
                                        <td>{{ $simpanan->user->name }}</td>
                                        <td>{{ $simpanan->jenis }}</td>
                                        <td>Rp.{{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="/admin/simpanan/edit-simpanan/{{ $simpanan->id }}"
                                                class="btn btn-warning py-1">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    @endsection
