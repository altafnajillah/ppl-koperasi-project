@extends('template-dashboard')
@section('isi')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card  border-0 border-bottom border-3 border-primary">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h3 class="card-title text-primary">DASHBORAD ADMIN</h3>
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

                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-12 order-3 order-md-2">
                    <div class="row">
                        <div class="col-lg-2 col-md-12 col-6 mb-4">
                            <div class="card border-0 border-bottom border-3 border-success">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar">
                                            <span class="avatar-initial rounded bg-label-success">
                                                <i class="icon-base bx bx-user-check icon-lg"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Total Anggota</span>
                                    <h3 class="card-title mb-2">12,628</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-6 mb-4">
                            <div class="card border-0 border-bottom border-3 border-danger">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-danger">
                                                    <i class="icon-base bi bi-cash-coin icon-lg"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Total Pinjaman</span>
                                        <h3 class="card-title text-nowrap mb-2">Rp. 35.000.000</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-6 mb-4">
                            <div class="card  border-0 border-bottom border-3 border-warning">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar">
                                            <span class="avatar-initial rounded bg-label-warning">
                                                <i class="icon-base bi bi-cash-coin icon-lg"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Saldo Koperasi</span>
                                    <h3 class="card-title mb-2">RP. 14.000.000.000.000</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-6 mb-4">

                        </div>
                    </div>
                </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme" style="margin-top: 140px">
                <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                    <div class="mb-2 mb-md-0">
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        , made with ❤️ by
                        <a href="https://themeselection.com" target="_blank"
                            class="footer-link fw-bolder">ThemeSelection</a>
                    </div>
                    <div>
                        <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                        <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                        <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                            target="_blank" class="footer-link me-4">Documentation</a>

                        <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                            class="footer-link me-4">Support</a>
                    </div>
                </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    @endsection
