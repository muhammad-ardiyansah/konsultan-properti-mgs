@extends('konsultan.layouts.dash-konsultan-layout')
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
                        <li class="breadcrumb-item"><a href="{{ route('konsultan.templateKomponenPemeriksaan') }}">Template Komponen</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
                <h4 class="page-title">Tambah Template Komponen</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">


            @php

                $oldNoKomponenPemeriksaanValue = old('no_komponen_pemeriksaan');
                $msgErrNoKomponenPemeriksaan = "";
                if ($errors->has('no_komponen_pemeriksaan') && !empty($oldNoKomponenPemeriksaanValue)) {
                    $msgErrNoKomponenPemeriksaan = "\"".$oldNoKomponenPemeriksaanValue."\"";
                    $oldNoKomponenPemeriksaanValue = "";
                }            

                $oldNamaKomponenPemeriksaanValue = old('nama_komponen_pemeriksaan');
                $msgErrNamaKomponenPemeriksaan = "";
                if ($errors->has('nama_komponen_pemeriksaan') && !empty($oldNamaKomponenPemeriksaanValue)) {
                    $msgErrNamaKomponenPemeriksaan = "\"".$oldNamaKomponenPemeriksaanValue."\"";
                    $oldNamaKomponenPemeriksaanValue = "";
                }

            @endphp

            <form id="form-input"  method="POST" action="{{ route('konsultan.simpanTemplateKomponenPemeriksaan') }}" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
            @csrf            
                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-info float-start"><i class="mdi mdi-access-point me-1"></i>Tambah</div>
                        <h5 class="text-info float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                        <div class="ribbon-content">   
                        

                            <div class="row mb-3">
                                <label for="tlu_master_template_id" class="col-3 col-form-label">Master Template</label>
                                <div class="col-9">    
                                    <select class="form-control select2" name="tlu_master_template_id" id="tlu_master_template_id" data-toggle="select2" @error('tlu_master_template_id') required @enderror >
                                    <option value="">[- Pilih Master Template -]</option>
                                        @foreach ($tluMasterTemplates as $id => $nama_master)
                                            <option value="{{ $id }}" {{ $id == old('tlu_master_template_id') ? "selected" : "" }}>{{ $nama_master }}</option>
                                        @endforeach
                                    </select>          
                                    @error('tlu_master_template_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>

                            <div class="row mb-3">
                                <label for="parent_id" class="col-3 col-form-label">Parent Komponen</label>
                                <div class="col-9">    
                                    <select class="form-control select2" name="parent_id" id="parent_id" data-toggle="select2" @error('parent_id') required @enderror >
                                    <option value="">[- Pilih Parent Komponen -]</option>
                                        @foreach ($templateKomponenPemeriksaans as $templateKomponen)
                                            <option value="{{ $templateKomponen->id }}" {{ $templateKomponen->id == old('parent_id') ? "selected" : "" }}>{{ $templateKomponen->no_komponen_pemeriksaan }} {{ $templateKomponen->nama_komponen_pemeriksaan }}</option>
                                            @if(count($templateKomponen->subtemplatekomponen))
                                                @include('konsultan.sub-list-select_', ['subtemplatekomponens' => $templateKomponen->subtemplatekomponen, 'dash'=>'-'])
                                            @endif
                                        @endforeach
                                    </select>          
                                    @error('parent_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>                            

                            <div class="row mb-3">
                                <label for="no_komponen_pemeriksaan" class="col-3 col-form-label">No Komponen</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="no_komponen_pemeriksaan" name="no_komponen_pemeriksaan" placeholder="" @error('no_komponen_pemeriksaan') required @enderror value="{{ $oldNoKomponenPemeriksaanValue }}" >
                                    @error('no_komponen_pemeriksaan')
                                        <div class="invalid-feedback">
                                        {{ $msgErrNoKomponenPemeriksaan.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                    

                            <div class="row mb-3">
                                <label for="nama_komponen_pemeriksaan" class="col-3 col-form-label">Nama Komponen</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="nama_komponen_pemeriksaan" name="nama_komponen_pemeriksaan" placeholder="" @error('nama_komponen_pemeriksaan') required @enderror value="{{ $oldNamaKomponenPemeriksaanValue }}" >
                                    @error('nama_komponen_pemeriksaan')
                                        <div class="invalid-feedback">
                                        {{ $msgErrNamaKomponenPemeriksaan.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12 text-end">                        
                                    <button type="Submit" class="btn btn-info">Simpan</button>
                                    <a href="{{ route('konsultan.templateKomponenPemeriksaan') }}" class="btn btn-warning btn-md">Kembali</a></h4>
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