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
                        <li class="breadcrumb-item"><a href="{{ route('konsultan.indexRegistrasiDeveloper', ['active' => 'developer']) }}">List Developer</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-info float-start"><i class="mdi mdi-access-point me-1"></i> Edit Registrasi Developer</div>
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

                            $oldNamaPerusahaanValue = old('nama_perusahaan', $developer->nama_perusahaan);
                            $msgErrNamaPerusahaan = "";
                            if ($errors->has('nama_perusahaan') && !empty($oldNamaPerusahaanValue)) {
                                $msgErrNamaPerusahaan = "\"".$oldNamaPerusahaanValue."\"";
                                $oldNamaPerusahaanValue = "";
                            }

                            $oldNamaDirekturValue = old('nama_direktur', $developer->nama_direktur);
                            $msgErrNamaDirektur = "";
                            if ($errors->has('nama_direktur') && !empty($oldNamaDirekturValue)) {
                                $msgErrNamaDirektur = "\"".$oldNamaDirekturValue."\"";
                                $oldNamaDirekturValue = "";
                            }

                            $oldNoKtaApersiValue = old('no_kta_apersi', $developer->no_kta_apersi);
                            $msgErrNoKtaApersi = "";
                            if ($errors->has('no_kta_apersi') && !empty($oldNoKtaApersiValue)) {
                                $msgErrNoKtaApersi = "\"".$oldNoKtaApersiValue."\"";
                                $oldNoKtaApersiValue = "";
                            } 

                            $oldProvinceCodeValue = old('province_code', $developer->province_code);
                            $msgErrProvinceCode = "";
                            if ($errors->has('province_code') && !empty($oldProvinceCodeValue)) {
                                $msgErrProvinceCode = "\"".$oldProvinceCodeValue."\"";
                                $oldProvinceCodeValue = "";
                            }                            

                            $oldAlamatValue = old('alamat', $developer->alamat);
                            $msgErrAlamat = "";
                            if ($errors->has('alamat') && !empty($oldAlamatValue)) {
                                $msgErrAlamat = "\"".$oldAlamatValue."\"";
                                $oldAlamatValue = "";
                            } 

                            $oldNoHpValue = old('no_hp', $developer->no_hp);
                            $msgErrNoHp = "";
                            if ($errors->has('no_hp') && !empty($oldNoHpValue)) {
                                $msgErrNoHp = "\"".$oldNoHpValue."\"";
                                $oldNoHpValue = "";
                            }

                            $oldEmailValue = old('email', $developer->email);
                            $msgErrEmail = "";
                            if ($errors->has('email') && !empty($oldEmailValue)) {
                                $msgErrEmail = "\"".$oldEmailValue."\"";
                                $oldEmailValue = "";
                            }                         
                        
                        @endphp

                        <form  method="POST" action="{{ route('konsultan.simpanRegistrasiDeveloper') }}" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
                        @csrf    
                            <div class="row mb-3">
                                <label for="nama_perusahaan" class="col-lg-3 col-xl-3 col-form-label">Nama Perusahaan</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder=""  @error('nama_perusahaan') required @enderror value="{{ $oldNamaPerusahaanValue }}">
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback">
                                            {{ $msgErrNamaPerusahaan.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nama_direktur" class="col-lg-3 col-xl-3 col-form-label">Nama Direktur</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control" id="nama_direktur" name="nama_direktur" placeholder="" @error('nama_direktur') required @enderror value="{{ $oldNamaDirekturValue }}" >
                                    @error('nama_direktur')
                                        <div class="invalid-feedback">
                                            {{ $msgErrNamaDirektur.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>          
                            <div class="row mb-3">
                                <label for="no_kta_apersi" class="col-lg-3 col-xl-3 col-form-label">No. KTA Apersi</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control" id="no_kta_apersi" name="no_kta_apersi" placeholder="" @error('no_kta_apersi') required @enderror value="{{ $oldNoKtaApersiValue }}" >
                                    @error('no_kta_apersi')
                                        <div class="invalid-feedback">
                                            {{ $msgErrNoKtaApersi.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="row mb-3">
                                <label for="province_code" class="col-lg-3 col-xl-3 col-form-label">Asal DPD Apersi</label>
                                <div class="col-lg-9 col-xl-9">    
                                    <select class="form-control select2" name="province_code" id="province_code" data-toggle="select2" @error('province_code') required @enderror >
                                    <option value="">[- Pilih Propinsi -]</option>
                                        @foreach ($provinces as $code => $name)
                                            <option value="{{ $code }}" {{ $code == $oldProvinceCodeValue ? "selected" : "" }}>{{ $name }}</option>
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
                                <label for="alamat" class="col-lg-3 col-xl-3 col-form-label">Alamat</label>
                                <div class="col-lg-9 col-xl-9">
                                    <textarea class="form-control" placeholder="" id="alamat" name="alamat" style="height: 100px;" @error('alamat') required @enderror >{{ $oldAlamatValue }}</textarea>                                    
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $msgErrAlamat.' '.$message }}
                                        </div>
                                    @enderror                       
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_hp" class="col-lg-3 col-xl-3 col-form-label">No. HP</label>
                                <div class="col-lg-6 col-xl-6">
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="" @error('no_hp') required @enderror value="{{ $oldNoHpValue }}" >
                                    @error('no_hp')
                                        <div class="invalid-feedback" style="display:block;">
                                            {{ $msgErrNoHp.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                            

                            <div class="row mb-3">
                                <label for="email" class="col-lg-3 col-xl-3 col-form-label">Email</label>
                                <div class="col-lg-6 col-xl-6">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="" @error('email') required @enderror value="{{ $oldEmailValue }}" >
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $msgErrEmail.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mt-3 mb-3">
                                <div class="col-12 text-end">   
                                    <input name="id" type="hidden" value="{{ $developer->id; }}">                                                                           
                                    <button type="Submit" class="btn btn-info">Simpan</button>
                                    <a href="{{ route('konsultan.indexRegistrasiDeveloper', ['active' => 'developer' ]) }}" class="btn btn-warning btn-md">Kembali</a></h4>
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