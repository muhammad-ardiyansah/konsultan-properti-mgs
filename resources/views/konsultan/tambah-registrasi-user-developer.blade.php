@extends('konsultan.layouts.dash-konsultan-layout-horizontal')
@section('title','Konsultan Properti PT. Mitra Guntur Sarana')

@section('content')

<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Registrasi Developer</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('konsultan.indexRegistrasiDeveloper', ['active' => 'user']) }}">List User Developer</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
                <h4 class="page-title">Tambah </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-info float-start"><i class="mdi mdi-access-point me-1"></i> Tambah User Login Untuk Developer</div>
                    <h5 class="text-info float-end mt-0"></h5>
                    <div class="ribbon-content">

                        @if ($errors->any())                        
                            <div class="alert alert-danger" role="alert">
                                <strong>Error Input - </strong> Mohon periksa kembali input data Anda
                            </div>
                        @endif

                        @if (Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="dripicons-checkmark me-2"></i> {{ Session::get('success') }} 
                        </div>
                        @endif

                        @if (Session::get('fail'))
                        <div class="alert alert-danger" role="alert">
                            <i class="dripicons-wrong me-2"></i> {{ Session::get('fail') }}
                        </div>
                        @endif 
                        
                        @php

                            $oldDeveloperIdValue = old('developer_id');
                            $msgErrDeveloperId = "";
                            if ($errors->has('developer_id') && !empty($oldDeveloperIdValue)) {
                                $msgErrDeveloperId = "\"".$oldDeveloperIdValue."\"";
                                $oldDeveloperIdValue = "";
                            }

                            $oldNameValue = old('name');
                            $msgErrName = "";
                            if ($errors->has('name') && !empty($oldNameValue)) {
                                $msgErrName = "\"".$oldNameValue."\"";
                                $oldNameValue = "";
                            }

                            $oldUsernameValue = old('username');
                            $msgErrUsername = "";
                            if ($errors->has('username') && !empty($oldUsernameValue)) {
                                $msgErrUsername = "\"".$oldUsernameValue."\"";
                                $oldUsernameValue = "";
                            }

                            $oldEmailValue = old('email');
                            $msgErrEmail = "";
                            if ($errors->has('email') && !empty($oldEmailValue)) {
                                $msgErrEmail = "\"".$oldEmailValue."\"";
                                $oldEmailValue = "";
                            }                         
                        


                        @endphp

                        <form  method="POST" action="{{ route('konsultan.simpanRegistrasiUserDeveloper') }}" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
                        @csrf 
                        
                            <div class="row mb-3">
                                <label for="developer_id" class="col-lg-3 col-xl-3 col-form-label">Developer</label>
                                <div class="col-lg-6 col-xl-6">    
                                    <select class="form-control select2" name="developer_id" id="developer_id" data-toggle="select2" @error('developer_id') required @enderror >
                                    <option value="">[- Pilih Developer -]</option>
                                        @foreach ($developers as $id => $nama)
                                            <option value="{{ $id }}" {{ $id == $oldDeveloperIdValue ? "selected" : "" }}>{{ $nama }}</option>
                                        @endforeach
                                    </select>          
                                    @error('developer_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>                        

                            <div class="row mb-3">
                                <label for="name" class="col-lg-3 col-xl-3 col-form-label">Nama User</label>
                                <div class="col-lg-6 col-xl-6">
                                    <input type="text" class="form-control" id="name" name="name" placeholder=""  @error('name') required @enderror value="{{ $oldNameValue }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $msgErrName.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-lg-3 col-xl-3 col-form-label">Username</label>
                                <div class="col-lg-6 col-xl-6">
                                    <input type="text" class="form-control" id="username" name="username" placeholder=""  @error('username') required @enderror value="{{ $oldUsernameValue }}">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $msgErrUsername.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>      

                            <div class="row mb-3">
                                <label for="email" class="col-lg-3 col-xl-3 col-form-label">Email User</label>
                                <div class="col-lg-6 col-xl-6">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="" @error('email') required @enderror value="{{ $oldEmailValue }}" >
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $msgErrEmail.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                                                        

                            <div class="row mb-3">
                                <label for="password" class="col-lg-3 col-xl-3 col-form-label">Password</label>
                                <div class="col-lg-6 col-xl-6">
                                    <input type="text" class="form-control" id="password" name="password" placeholder="" {{ $errors->count() > 0 ? 'required' : '' }} value="{{ old('password') }}">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password_confirmation" class="col-lg-3 col-xl-3 col-form-label">Konfirmasi Password</label>
                                <div class="col-lg-6 col-xl-6">
                                    <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder=""  {{ $errors->count() > 0 ? 'required' : '' }} value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror                                
                                </div>
                            </div>                            

                            <div class="row mt-3 mb-3">
                                <div class="col-12 text-end">                        
                                    <button type="Submit" class="btn btn-info">Simpan</button>
                                    <a href="{{ route('konsultan.indexRegistrasiDeveloper', ['active' => 'user' ]) }}" class="btn btn-warning btn-md">Kembali</a></h4>
                                </div>
                            </div>

                        </form>
                                                                    

                    </div>
                </div> <!-- end card-body -->
            </div>        

        </div>    
    </div> <!-- end col-->

</div>

@endsection