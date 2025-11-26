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
                                    <h3 class="card-title text-primary">MANAJEMEN PENGGUNA</h3>
                                    <p class="mb-4">
                                        Welcome <span class="fw-bold fst-italic">Joe</span>, let's monitoring your user
                                        performance
                                        more closely!
                                    </p>
                                    <a href="\admin\pengguna\create-user" class="btn btn-primary">Tambah Pengguna</a>
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
                        <h5 class="card-header">Daftar Pengguna</h5>

                        <div class="px-4 mt-3 mb-3">
                            <div class="row gx-3">
                                <!-- Info (6 columns) -->
                                <div class="col-12 col-lg-5">
                                    <div class="h-100 d-flex align-items-center">
                                        <div class="w-100 bg-secondary text-white rounded px-3 py-2">
                                            <span class="me-3 fw-semibold">Total Users: <span
                                                    class="fw-bold">{{ $totalUser }}</span></span>
                                            <span class="badge bg-primary rounded-pill me-2">Admin: {{ $totalAdmin }}</span>
                                            <span class="badge bg-warning text-dark rounded-pill">Petugas: {{ $totalPetugas }}</span>
                                            <span class="badge bg-info text-dark rounded-pill me-2">Anggota: {{ $totalAnggota }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Role dropdown (2 columns) -->
                                <div class="col-12 col-lg-2 mt-2 mt-lg-0 col-md-4">
                                    <div class="h-100 d-flex align-items-center">
                                        <div class="w-100 h-100">
                                            <button class="btn btn-secondary w-100 h-100 dropdown-toggle" type="button"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                Role
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">Admin</a></li>
                                                <li><a class="dropdown-item" href="#">Anggota</a></li>
                                                <li><a class="dropdown-item" href="#">Petugas</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Role dropdown (2 columns) -->
                                <div class="col-12 col-lg-2 mt-2 mt-lg-0 col-md-4">
                                    <div class="h-100 d-flex align-items-center">
                                        <div class="w-100 h-100">
                                            <button class="btn btn-secondary w-100 h-100 dropdown-toggle" type="button"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                Status
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">Ditunda</a></li>
                                                <li><a class="dropdown-item" href="#">Diterima</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Search (4 columns) -->
                                <div class="col-12 col-lg-3 mt-2 mt-lg-0 col-md-4">
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
                                        <td>No</td>
                                        <td>Nama</td>
                                        <td>Email</td>
                                        <td>Role</td>
                                        <td>Status</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($users as $k => $user)
                                        <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <span class="badge me-1
                                                        @if ($user->role == 'admin') bg-label-primary 
                                                        @elseif($user->role == 'petugas') bg-label-warning 
                                                        @elseif($user->role == 'anggota') bg-label-info 
                                                        @else bg-label-secondary @endif">
                                                        {{ $user->role }}
                                                    </span>
                                                </td>
                                                @if ($user->biodata !== null)
                                                    <td><span class="badge {{ $user->biodata->accepted_at == null ? "bg-label-danger" : "bg-label-success" }} me-1">{{ $user->biodata->accepted_at == null ? "Tertunda" : "Diterima" }}</span></td>
                                                @else
                                                    <td><span class="badge bg-label-secondary me-1"></span></td>
                                                @endif
                                                <td>
                                                    <a href="{{ route('admin.user.profile', $user->id) }}" class="btn btn-primary py-1">
                                                        Lihat Profile
                                                    </a>
                                                    <a href="/admin/pengguna/edit-user" class="btn btn-warning py-1">
                                                        Edit
                                                    </a>
                                                    <button class="btn btn-danger py-1" type="submit">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        </form>
                                    @endforeach
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
