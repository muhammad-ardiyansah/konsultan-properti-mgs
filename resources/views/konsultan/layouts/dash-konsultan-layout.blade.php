<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <body class="loading" data-layout="detached" data-layout-config='{"layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'></body>

        <!-- Topbar Start -->
        <div class="navbar-custom topnav-navbar topnav-navbar-dark">
            <div class="container-fluid">

                <!-- LOGO -->
                <a href="#" class="topnav-logo">
                    <span class="topnav-logo-lg">
                        <img src="{{ asset('assets/images/MGS-10.png') }}" alt="" height="16">
                    </span>
                    <span class="topnav-logo-sm">
                        <img src="{{ asset('assets/images/logo-light-mgs.png') }}" alt="" height="16">
                    </span>
                </a>

                <ul class="list-unstyled topbar-menu float-end mb-0">
    
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
                                <span>Akun saya</span>
                            </a>
    
                            <!-- item-->
                            <a href="{{ route('logout') }}" class="dropdown-item notify-item" 
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

    
                        </div>
                    </li>

                </ul>
                <a class="button-menu-mobile disable-btn">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>

            </div>
        </div>
        <!-- end Topbar -->
        
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- Begin page -->
            <div class="wrapper">

                <!-- ========== Left Sidebar Start ========== -->
                <div class="leftside-menu leftside-menu-detached">

                    <div class="leftbar-user">
                        <a href="javascript: void(0);">
                            <img src="{{ asset('assets/images/users/no-pic-user-150.png') }}" alt="user-image" height="42" class="rounded-circle shadow-sm">
                            <span class="leftbar-user-name">{{ Auth::user()->name }}</span>
                        </a>
                    </div>

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item">Developer</li>

                        <li class="side-nav-item {{ (request()->is('developer/listPengajuan*')) ? 'menuitem-active' : '' }}">
                            <a href="{{ route('developer.listPengajuan') }}" class="side-nav-link {{ (request()->is('developer/ListPengajuan*')) ? 'active' : '' }}">
                                <i class="uil-books"></i>
                                <span> List Pengajuan </span>
                            </a>
                        </li>

                        <li class="side-nav-title side-nav-item">Template SIMAK</li>

                        <li class="side-nav-item {{ (request()->is('konsultan/*MasterTemplateKomponenPemeriksaan')) ? 'menuitem-active' : '' }}">
                            <a href="{{ route('konsultan.masterTemplateKomponenPemeriksaan') }}" class="side-nav-link {{ (request()->is('developer/ListPengajuan*')) ? 'active' : '' }}">
                                <i class="mdi mdi-book-marker"></i>
                                <span> Master Template </span>
                            </a>
                        </li>                        

                        <li class="side-nav-item {{ (request()->is('konsultan/templateStrukturalFondasi')) ? 'menuitem-active' : '' }}">
                            <a href="{{ route('konsultan.templateStrukturalFondasi') }}" class="side-nav-link">
                                <i class="mdi mdi-book-arrow-down"></i>
                                <span> Struktural Fondasi </span>
                            </a>
                        </li>                        

                        <li class="side-nav-item {{ ( request()->is('konsultan/templateKomponenPemeriksaan') || request()->is('konsultan/tambahTemplateKomponenPemeriksaan') ) ? 'menuitem-active' : '' }}">
                            <a href="{{ route('konsultan.templateKomponenPemeriksaan') }}" class="side-nav-link">
                                <i class="mdi mdi-book-settings"></i>
                                <span> Pemeriksaan Kelaikan </span>
                            </a>
                        </li>                        

                        <li class="side-nav-title side-nav-item">Data Konsultan</li>  
                        <li class="side-nav-item">
                            <a href="apps-chat.html" class="side-nav-link">
                                <i class="uil-file-bookmark-alt"></i>
                                <span> Akta </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="apps-chat.html" class="side-nav-link">
                                <i class="uil-file-check-alt"></i>
                                <span> Izin Usaha & NPWP </span>
                            </a>
                        </li>                           
                        <li class="side-nav-item">
                            <a href="apps-chat.html" class="side-nav-link">
                                <i class="uil-file-share-alt"></i>
                                <span> IUJK </span>
                            </a>
                        </li>     
                        <li class="side-nav-item">
                            <a href="apps-chat.html" class="side-nav-link">
                                <i class="uil-file-lock-alt"></i>
                                <span> SKA Penanggung Jawab </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="apps-chat.html" class="side-nav-link">
                                <i class="uil-file-shield-alt"></i>
                                <span> SBU Pengawasan </span>
                            </a>
                        </li>

                    </ul>

                    <!-- Help Box -->
                    <div class="help-box help-box-light text-center">

                    </div>
                    <!-- end Help Box -->
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>
                    <!-- Sidebar -left -->

                </div>
                <!-- Left Sidebar End -->

                <div class="content-page">

                    @yield('content')

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
                <!-- content-page -->

            </div> <!-- end wrapper-->
        </div>
        <!-- END Container -->


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
