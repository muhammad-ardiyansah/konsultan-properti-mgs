<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>PT. Mitra Guntur Sarana</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
        
        <!-- App css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-3 pb-3 text-center bg-primary">
                                <a href="/">
                                    <span><img src="{{ asset('assets/images/logo-mgs.png') }}" alt="" height="58"></span>
                                    <!-- <h4 class="text-dark">PT. Mitra Guntur Sarana</h4> -->
                                </a>
                            </div>

                            <div class="card-body p-3">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold mb-4">Login {{ ucfirst($userrole) }}</h4>
                                    <!-- <p class="text-muted mb-4">Masukkan Username dan Password Anda</p> -->
                                    {{--
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    --}}    
                                </div>

                                <form method="POST" action="{{ route('login') }}" class="{{ $errors->any() ? 'needs-validation was-validated' : '' }}" >    
                                    @if (Session::get('error'))

                                    <div class="alert alert-danger" role="alert">
                                        <i class="dripicons-wrong me-2"></i><strong>Error - </strong> {{ Session::get('error') }}
                                    </div>    

                                    @endif
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input class="form-control" type="text" id="username" name="username" placeholder="Username" {{ $errors->has('username') ? 'required' : '' }}>
                                        @if ($errors->has('username'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('username') }}
                                            </div>
                                        @endif                                            

                                    </div>

                                    <div class="mb-3">
                                        <!-- <a href="pages-recoverpw.html" class="text-muted float-end"><small>Forgot your password?</small></a> -->
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" {{ $errors->has('password') ? 'required' : '' }}>
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                            @if ($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                            @endif                                            
                                        </div>
                                    </div>

                                    <!-- <div class="mb-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div> -->

                                    <div class="mb-3 mb-0 text-center">
                                        <input name="userrole" type="hidden" value="{{ $userrole }}">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        
                        @if (strtoupper($userrole) === strtoupper('developer'))
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Pengguna baru ? Silahkan registrasi<a href="{{ route('user.formRegistrasi.developer') }}" class="text-muted ms-1"><b>disini</b></a></p>
                            </div> 
                        </div>
                        @endif
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            2021 © PT. Mitra Guntur Sarana
        </footer>

        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        
    </body>
</html>
