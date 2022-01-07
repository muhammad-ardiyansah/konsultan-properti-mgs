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
                        <li class="breadcrumb-item"><a href="{{ route('konsultan.indexRekeningKonsultan') }}">Nomor Rekening</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
                <h4 class="page-title">Tambah Rekening</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">


            @php
                
                $oldTluBankIdValue = old('tlu_bank_id');
                $msgErrTluBankId = "";
                if ($errors->has('tlu_bank_id') && !empty($oldTluBankIdValue)) {
                    $msgErrTluBankId = "\"".$oldTluBankIdValue."\"";
                    $oldTluBankIdValue = "";
                }

                $oldNoRekeningValue = old('no_rekening');
                $msgErrNoRekening = "";
                if ($errors->has('no_rekening') && !empty($oldNoRekeningValue)) {
                    $msgErrNoRekening = "No. rekening \"".$oldNoRekeningValue."\"";
                    $oldNoRekeningValue = "";
                }

                $oldNamaPemilikRekeningValue = old('nama_pemilik_rekening');
                $msgErrNamaPemilikRekening = "";
                if ($errors->has('nama_pemilik_rekening') && !empty($oldNamaPemilikRekeningValue)) {
                    $msgErrNamaPemilikRekening = "\"".$oldNamaPemilikRekeningValue."\"";
                    $oldNamaPemilikRekeningValue = "";
                }

            @endphp

            <form id="form-input"  method="POST" action="{{ route('konsultan.simpanRekeningKonsultan') }}" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
            @csrf            
                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-info float-start"><i class="mdi mdi-access-point me-1"></i>Tambah</div>
                        <h5 class="text-info float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                        <div class="ribbon-content">   

                        
                            <div class="row mb-3">
                                <label for="tlu_bank_id" class="col-lg-3 col-xl-3 col-form-label">Bank</label>
                                <div class="col-lg-9 col-xl-9">    
                                    <select class="form-control select2" name="tlu_bank_id" id="tlu_bank_id" data-toggle="select2" @error('tlu_bank_id') required @enderror >
                                    <option value="">[- Pilih Bank -]</option>
                                        @foreach ($tluBanks as $id => $nama_bank)
                                            <option value="{{ $id }}" {{ $id == $oldTluBankIdValue ? "selected" : "" }}>{{ $nama_bank }}</option>
                                        @endforeach
                                    </select>          
                                    @error('tlu_bank_id')
                                        <div class="invalid-feedback">
                                            {{ $msgErrTluBankId.' '.$message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>

                            <div class="row mb-3">
                                <label for="nama_bank" class="col-lg-3 col-xl-3 col-form-label">No. Rekening</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control" id="no_rekening" name="no_rekening" placeholder="" @error('no_rekening') required @enderror value="{{ $oldNoRekeningValue }}" >
                                    @error('no_rekening')
                                        <div class="invalid-feedback">
                                        {{ $msgErrNoRekening.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nama_bank" class="col-lg-3 col-xl-3 col-form-label">Nama Pemilik Rekening</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control" id="nama_pemilik_rekening" name="nama_pemilik_rekening" placeholder="" @error('nama_pemilik_rekening') required @enderror value="{{ $oldNamaPemilikRekeningValue }}" >
                                    @error('nama_pemilik_rekening')
                                        <div class="invalid-feedback">
                                        {{ $msgErrNamaPemilikRekening.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                    
                            
                            <div class="row mb-3">
                                <div class="col-12 text-end">                        
                                    <button type="Submit" class="btn btn-info">Simpan</button>
                                    <a href="{{ route('konsultan.indexRekeningKonsultan') }}" class="btn btn-warning btn-md">Kembali</a></h4>
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