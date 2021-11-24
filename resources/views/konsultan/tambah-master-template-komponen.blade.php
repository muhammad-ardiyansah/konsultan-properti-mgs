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
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li> -->
                        <li class="breadcrumb-item"><a href="{{ route('konsultan.masterTemplateKomponenPemeriksaan') }}">Master Template</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
                <h4 class="page-title">Tambah Master Template</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">


            @php
                
                $oldNamaMasterValue = old('nama_master');
                $msgErrNamaMaster = "";
                if ($errors->has('nama_master') && !empty($oldNamaMasterValue)) {
                    $msgErrNamaMaster = "\"".$oldNamaMasterValue."\"";
                    $oldNamaMasterValue = "";
                }

            @endphp

            <form id="form-input"  method="POST" action="{{ route('konsultan.simpanMasterTemplateKomponenPemeriksaan') }}" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
            @csrf            
                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-info float-start"><i class="mdi mdi-access-point me-1"></i>Tambah</div>
                        <h5 class="text-info float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                        <div class="ribbon-content">   
                        
                            <div class="row mb-3">
                                <label for="nama_perumahan" class="col-3 col-form-label">Nama master</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="nama_master" name="nama_master" placeholder="" @error('nama_master') required @enderror value="{{ $oldNamaMasterValue }}" >
                                    @error('nama_master')
                                        <div class="invalid-feedback">
                                        {{ $msgErrNamaMaster.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                    

                            <div class="row mb-3">
                                <label for="province_code" class="col-3 col-form-label">Propinsi Apersi</label>
                                <div class="col-6">    
                                    <select class="form-control select2" name="province_code" id="province_code" data-toggle="select2" @error('province_code') required @enderror >
                                    <option value="">[- Pilih Propinsi Apersi -]</option>
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
                                <div class="col-3"></div>    

                                <div class="col-9">
                                    <div class="form-check form-checkbox-success mb-2">
                                        <input type="hidden" name="aktif" value="checked">
                                        <input type="checkbox" class="form-check-input" id="aktif" name="aktif"  {{ old('aktif')== null || old('aktif')== 'on' ? 'checked' : ''  }}>
                                        <label class="form-check-label" for="aktif">Aktif</label>
                                    </div>
                                </div>    
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-12 text-end">                        
                                    <button type="Submit" class="btn btn-info">Simpan</button>
                                    <a href="{{ route('konsultan.masterTemplateKomponenPemeriksaan') }}" class="btn btn-warning btn-md">Kembali</a></h4>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->                       
            </form>        

        </div>    
    </div> <!-- end col-->

</div>

@endsection