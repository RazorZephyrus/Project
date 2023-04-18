<!DOCTYPE html>
<!-- beautify ignore:start -->
@include('front.include.header')

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  layout-without-menu">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('front.include.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h5 class="pb-1 mt-3 mb-3">List Room Asrama</h5>
                        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="javascript:void(0)">Navbar</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page"
                                                href="javascript:void(0)">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="javascript:void(0)">Link</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Dropdown
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)">Another
                                                        action</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:void(0)">Something else
                                                        here</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link disabled" href="javascript:void(0)"
                                                tabindex="-1">Disabled</a>
                                        </li>
                                    </ul>
                                    <form class="d-flex" onsubmit="return false">
                                        <input class="form-control me-2" type="search" placeholder="Search"
                                            aria-label="Search">
                                        <button class="btn btn-outline-primary" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </nav>
                        <!-- Layout Demo -->
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <img class="card-img-top" style="width: 100%"
                                                    src="../assets/img/elements/kamar.jpg" />
                                            </div>
                                            <div class="col">
                                                <div class="text-light small fw-semibold">Stok Kamar Tersedia</div>
                                                <h3 class="card-title">Double Standart Room</h2>
                                                <h5 class="card-title">Fasilitas</h5>
                                                <small>

                                                    <ul class="list-unstyled mt-2">
                                                        <li>
                                                            <ul>
                                                            <li>Free Wifi</li>
                                                            <li>Smoking Room</li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </small>
                                                    <div class="card-title mb-0">
                                                        <h5 class="m-2 me-2">Rp. 50.000/Hari</h5>
                                                        <a href="/detail" class="btn btn-primary">Lihat Lebih Detail</a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--/ Order Statistics -->
                        <!--/ Layout Demo -->
                    </div>
                    <!-- / Content -->
                    <!-- Footer -->
                    @include('front.include.footer')
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>
