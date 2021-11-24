<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>PT. Mitra Guntur Sarana</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Konsultan Properti Konsultan Apersi" name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />        

    </head>

    <body class="loading" data-layout-config='{"darkMode":false}'>

        <!-- NAVBAR START -->
        <nav class="navbar navbar-expand-lg py-lg-3 navbar-dark">
            <div class="container">

                <!-- logo -->
                <a href="/" class="navbar-brand me-lg-5">
                    <img src="{{ asset('assets/images/logo-light-mgs.png') }}" alt="" class="logo-dark" height="18" />
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <!-- menus -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">

                    <!-- left menu -->
                    <ul class="navbar-nav me-auto align-items-center">
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link active" href="">Beranda</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="{{ route('user.login', ['userrole' => 'developer']) }}">Login Developer</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="{{ route('user.login.dpd') }}">Login DPD</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="{{ route('user.login', ['userrole' => 'DPP']) }}">Login DPP</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="{{ route('user.login', ['userrole' => 'konsultan']) }}">Login Konsultan</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="{{ route('user.login', ['userrole' => 'pengawas']) }}">Pengawas</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link" href="">Alur</a>
                        </li>
                    </ul>

                    <!-- right menu -->
                    <!-- <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item me-0">
                            <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/" target="_blank" class="nav-link d-lg-none">Purchase now</a>
                            <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/" target="_blank" class="btn btn-sm btn-light rounded-pill d-none d-lg-inline-flex">
                                <i class="mdi mdi-basket me-2"></i> Purchase Now
                            </a>
                        </li>
                    </ul> -->

                </div>
            </div>
        </nav>
        <!-- NAVBAR END -->

        <!-- START HERO -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="mt-md-4">
                            <div>
                                <span class="badge bg-danger rounded-pill">New</span>
                                <span class="text-white-50 ms-1">Aplikasi PT. Mitra Guntur Sarana</span>
                            </div>
                            <h2 class="text-white fw-normal mb-0 mt-3 hero-title">
                                Selamat datang di website 
                            </h2>

                            <h2 class="text-white fw-normal mb-4 mt-0 hero-title">
                                PT. Mitra Guntur Sarana 
                            </h2>

                            <p class="mb-4 font-16 text-white-50">
                            Selamat datang Website PT. MITRA GUNTUR SARANA. Anda dapat melakukan pengajuan di website ini dengan melakukan registrasi di menu login dengan melengkapi data perusahaan anda.    
                            </p>

                            <a href="" target="_blank" class="btn btn-success">Info Selanjutnya<i
                                    class="mdi mdi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-2">
                        <div class="text-md-end mt-3 mt-md-0">
                            <img src="{{ asset('assets/images/startup.svg') }}" alt="" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END HERO -->

        <!-- START SERVICES -->
        <section class="py-5">
            <div class="container">
                <div class="row py-4">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h1 class="mt-0"><i class="mdi mdi-infinity"></i></h1>
                            <!-- <h3>The admin is fully <span class="text-primary">responsive</span> and easy to <span
                                    class="text-primary">customize</span></h3>
                            <p class="text-muted mt-2">The clean and well commented code allows easy customization of the
                                theme.It's designed for
                                <br>describing your app, agency or business.</p> -->
                            <h3>Semua pengajuan yang masuk akan kami layani <span class="text-primary">24 jam</span></h3>    
                            <h4>
                                Jam kerja kami: <span class="text-primary">Senin - Jum'at : 08:00 - 16:00 WIB</span> dan <span class="text-primary">Sabtu : 08:00 - 13:00 WIB</span>
                            </h4>    
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SERVICES -->

        <!-- START FOOTER -->
        <footer class="bg-dark py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ asset('assets/images/logo-mgs.png') }}" alt="" class="logo-dark" height="48" />
                        <p class="text-muted mt-2 font-12">Jl. Perintis Kemerdekaan No.18A RT 04/RW 03 Kb. Klp. <br> Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat <br> 16125</p>

                        <ul class="social-list list-inline mt-3">
                            <li class="list-inline-item text-center">
                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item text-center">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item text-center">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item text-center">
                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                            </li>
                        </ul>

                    </div>

                    <div class="col-lg-2 mt-3 mt-lg-0">
                        <h5 class="text-light">Company</h5>

                        <ul class="list-unstyled ps-0 mb-0 mt-3">
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">About Us</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Documentation</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Blog</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Affiliate Program</a></li>
                        </ul>

                    </div>

                    <div class="col-lg-2 mt-3 mt-lg-0">
                        <h5 class="text-light">Apps</h5>

                        <ul class="list-unstyled ps-0 mb-0 mt-3">
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Ecommerce Pages</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Email</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Social Feed</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Projects</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Tasks Management</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 mt-3 mt-lg-0">
                        <h5 class="text-light">Discover</h5>

                        <ul class="list-unstyled ps-0 mb-0 mt-3">
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Help Center</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Our Products</a></li>
                            <li class="mt-2"><a href="javascript: void(0);" class="text-muted">Privacy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mt-5">
                            <p class="text-muted mt-4 text-center mb-0">2021 © PT. Mitra Guntur Sarana</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END FOOTER -->

        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

    </body>

</html>