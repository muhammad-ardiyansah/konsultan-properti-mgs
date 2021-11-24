@extends('layouts.layout-front')
@section('title','Konsultan Properti PT. Mitra Guntur Sarana')

@section('content')

<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item active">Registrasi Developer</li>
                    </ol>
                </div>
                <h4 class="page-title">Registrasi Developer</h4>
            </div>
        </div>
    </div>     
    <!-- end page title -->
</div>    

<section class="pt-0 pb-5">
    <div class="container">
        <div class="row py-4">
            <div class="col-lg-12">

                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-info float-start"><i class="mdi mdi-access-point me-1"></i> Form Registrasi Developer</div>
                        <h5 class="text-info float-end mt-0"></h5>
                        <div class="ribbon-content">

                        @if ($errors->any())                        
                            <div class="alert alert-danger" role="alert">
                                <strong>Error Input - </strong> Mohon periksa kembali input data Anda
                            </div>
                        @endif

                        @if (Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="dripicons-checkmark me-2"></i> {{ Session::get('success') }} Silahkan login <a href="{{ route('user.login', ['userrole' => 'developer']) }}">disini</a> 
                        </div>
                        @endif

                        @if (Session::get('fail'))
                        <div class="alert alert-danger" role="alert">
                            <i class="dripicons-wrong me-2"></i> {{ Session::get('fail') }}
                        </div>
                        @endif

                        {{-- 
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        --}}   
                        {{-- $errors --}}    
                        
                        @php

                            $oldNoHpValue = old('no_hp');
                            $msgErrNoHp = "";
                            if ($errors->has('no_hp') && !empty($oldNoHpValue)) {
                                $msgErrNoHp = "Format No. Hp \"".$oldNoHpValue."\"";
                                $oldNoHpValue = "";
                            }

                            $oldEmailValue = old('email');
                            $msgErrEmail = "";
                            if ($errors->has('email') && !empty($oldEmailValue)) {
                                $msgErrEmail = "Email \"".$oldEmailValue."\"";
                                $oldEmailValue = "";
                            }

                            $oldUsernameValue = old('username');
                            $msgErrUsername = "";
                            if ($errors->has('username') && !empty($oldUsernameValue)) {
                                $msgErrUsername = "Username \"".$oldUsernameValue."\"";
                                $oldUsernameValue = "";
                            }                            
                         
                         @endphp

                        <form  method="POST" action="{{ route('user.saveRegistrasi.developer') }}" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
                        @csrf    
                            <div class="row mb-3">
                                <label for="nama_perusahaan" class="col-3 col-form-label">Nama Perusahaan</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder=""  @error('nama_perusahaan') required @enderror value="{{ old('nama_perusahaan') }}">
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nama_direktur" class="col-3 col-form-label">Nama Direktur</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="nama_direktur" name="nama_direktur" placeholder="" @error('nama_direktur') required @enderror value="{{ old('nama_direktur') }}" >
                                    @error('nama_direktur')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>          
                            <div class="row mb-3">
                                <label for="no_kta_apersi" class="col-3 col-form-label">No. KTA Apersi</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="no_kta_apersi" name="no_kta_apersi" placeholder="" @error('no_kta_apersi') required @enderror value="{{ old('no_kta_apersi') }}" >
                                    @error('no_kta_apersi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="row mb-3">
                                <label for="province_code" class="col-3 col-form-label">Asal DPD Apersi</label>
                                <div class="col-9">    
                                    <select class="form-control select2" name="province_code" id="province_code" data-toggle="select2" @error('province_code') required @enderror >
                                    <option value="">[- Pilih Propinsi -]</option>
                                        @foreach ($provinces as $code => $name)
                                            <option value="{{ $code }}" {{ $code == old('province_code') ? "selected" : "" }}>{{ $name }}</option>
                                        @endforeach
                                    </select>          
                                    @error('province_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>                            
                            <div class="row mb-3">
                                <label for="alamat" class="col-3 col-form-label">Alamat</label>
                                <div class="col-9">
                                    <textarea class="form-control" placeholder="" id="alamat" name="alamat" style="height: 100px;" @error('alamat') required @enderror >{{ old('alamat') }}</textarea>                                    
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror                       
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_hp" class="col-3 col-form-label">No. HP</label>
                                <div class="col-6">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon1">+62</span>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder=""  @error('no_hp') required @enderror value="{{ $oldNoHpValue  }}" data-toggle="input-mask" data-mask-format="000000000000000" data-reverse="true">
                                    </div>
                                    @error('no_hp')
                                        <div class="invalid-feedback" style="display:block;">
                                            {{ $msgErrNoHp.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                            

                            <div class="row mb-3">
                                <label for="email" class="col-3 col-form-label">Email</label>
                                <div class="col-6">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="" @error('email') required @enderror value="{{ $oldEmailValue }}" >
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $msgErrEmail.' '.$message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-3 col-form-label">Username</label>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="" @error('username') required @enderror value="{{ $oldUsernameValue }}">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $msgErrUsername.' '.$message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-3 col-form-label">Password</label>
                                <div class="col-6">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="" {{ $errors->count() > 0 ? 'required' : '' }} value="{{ old('password') }}">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password_confirmation" class="col-3 col-form-label">Konfirmasi Password</label>
                                <div class="col-6">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder=""  {{ $errors->count() > 0 ? 'required' : '' }} value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror                                
                                </div>
                            </div>    
                            <div class="justify-content-end row">
                                <div class="col-9">                        
                                    <button type="Submit" class="btn btn-primary">Register</button>
                                </div>
                            </div>
                        </form>
                                                                        

                        </div>
                    </div> <!-- end card-body -->
                </div>

            </div> <!-- end col -->
        </div>
    </div>
</section>

@endsection