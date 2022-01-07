<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- third party css -->
        <link href="{{ asset('assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

        @stack('styles')

    </head>

    <body class="loading" data-layout="topnav" data-layout-config='{"layoutBoxed":false,"darkMode":false,"showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom topnav-navbar">
                        <div class="container-fluid">

                            <!-- LOGO -->
                            <!-- <a href="" class="topnav-logo">
                                <span class="topnav-logo-lg">
                                    <img src="assets/images/logo-light.png" alt="" height="16">
                                </span>
                                <span class="topnav-logo-sm">
                                    <img src="assets/images/logo_sm_dark.png" alt="" height="16">
                                </span>
                            </a> -->

                            <a href="#" class="topnav-logo">
                                <span class="topnav-logo-lg">
                                    <img src="{{ asset('assets/images/MGS-10.png') }}" alt="" height="16">
                                </span>
                                <span class="topnav-logo-sm">
                                    <img src="{{ asset('assets/images/logo-dark-mgs.png') }}" alt="" height="16">
                                </span>
                            </a>                            

                            <ul class="list-unstyled topbar-menu float-end mb-0">

                                <!-- <li class="dropdown notification-list d-xl-none">
                                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <i class="dripicons-search noti-icon"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                        <form class="p-3">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                        </form>
                                    </div>
                                </li> -->
    
                                <li class="dropdown notification-list">
                                    <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span class="account-user-avatar"> 
                                            <img src="{{ asset('assets/images/users/no-pic-user-150.png') }}" alt="user-image" class="rounded-circle">
                                        </span>
                                        <span>
                                            <span class="account-user-name">{{ Auth::user()->name }}</span>
                                            <span class="account-position">{{ Auth::user()->role }}</span>
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                                        <!-- item-->
                                        <div class=" dropdown-header noti-title">
                                            <h6 class="text-overflow m-0">Welcome !</h6>
                                        </div>
    
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="mdi mdi-account-circle me-1"></i>
                                            <span>My Account</span>
                                        </a>
    
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="mdi mdi-account-edit me-1"></i>
                                            <span>Settings</span>
                                        </a>
    
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="mdi mdi-lifebuoy me-1"></i>
                                            <span>Support</span>
                                        </a>
    
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="mdi mdi-lock-outline me-1"></i>
                                            <span>Lock Screen</span>
                                        </a>
    
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item" 
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <i class="mdi mdi-logout me-1"></i>
                                            <span>Logout</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                        </form>    
                                    </div>
                                </li>

                            </ul>
                            <a class="navbar-toggle"  data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- end Topbar -->

                    <div class="topnav">
                        <div class="container-fluid">
                            <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">
        
                                <div class="collapse navbar-collapse" id="topnav-menu-content">
                                    <ul class="navbar-nav">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('konsultan.dashboard') }}" id="topnav-dashboards" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="uil-home-alt me-1"></i>Beranda
                                            </a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-developer" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="uil-constructor me-1"></i>Developer <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-developer">
                                                <div class="dropdown">
                                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-pengajuan-developer" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Pengajuan <div class="arrow-down"></div>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="topnav-pengajuan-developer">
                                                        <a href="{{ route('dpd.listPengajuan') }}" class="dropdown-item">List Pengajuan</a>
                                                    </div>
                                                </div>
                                                {{-- 
                                                <div class="dropdown">
                                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-perumahan" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Perumahan <div class="arrow-down"></div>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="topnav-perumahan">
                                                        <a href="{{ route('konsultan.listPerumahanDeveloper') }}" class="dropdown-item">List Perumahan</a>
                                                    </div>
                                                </div>
                                                --}}                                                
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>

                    
                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <!-- <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <form class="d-flex">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-light" id="dash-daterange">
                                                <span class="input-group-text bg-primary border-primary text-white">
                                                    <i class="mdi mdi-calendar-range font-13"></i>
                                                </span>
                                            </div>
                                            <a href="javascript: void(0);" class="btn btn-primary ms-2">
                                                <i class="mdi mdi-autorenew"></i>
                                            </a>
                                            <a href="javascript: void(0);" class="btn btn-primary ms-1">
                                                <i class="mdi mdi-filter-variant"></i>
                                            </a>
                                        </form>
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div> -->
                        <!-- end page title -->

                        <!-- <div class="row">

                        </div> -->
                        <!-- end row -->

                        @yield('content')

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                2021 © PT. Mitra Guntur Sarana
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

        <!-- third party js -->
        <script src="{{ asset('assets/js/vendor/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
        <!-- third party js ends -->

        @stack('scripts')

    </body>
</html>