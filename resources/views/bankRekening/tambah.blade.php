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
                        <li class="breadcrumb-item"><a href="{{ route('konsultan.bankRekening') }}">Bank</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
                <h4 class="page-title">Tambah Bank</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">


            @php
                
                $oldNamaBankValue = old('nama_bank');
                $msgErrNamaBank = "";
                if ($errors->has('nama_bank') && !empty($oldNamaBankValue)) {
                    $msgErrNamaBank = "\"".$oldNamaBankValue."\"";
                    $oldNamaBankValue = "";
                }

            @endphp

            <form id="form-input"  method="POST" action="{{ route('konsultan.simpanBankRekening') }}" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
            @csrf            
                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-info float-start"><i class="mdi mdi-access-point me-1"></i>Tambah</div>
                        <h5 class="text-info float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                        <div class="ribbon-content">   
                        
                            <div class="row mb-3">
                                <label for="nama_bank" class="col-3 col-form-label">Nama Bank</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="nama_bank" name="nama_bank" placeholder="" @error('nama_bank') required @enderror value="{{ $oldNamaBankValue }}" >
                                    @error('nama_bank')
                                        <div class="invalid-feedback">
                                        {{ $msgErrNamaBank.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                    
                            
                            <div class="row mb-3">
                                <div class="col-12 text-end">                        
                                    <button type="Submit" class="btn btn-info">Simpan</button>
                                    <a href="{{ route('konsultan.bankRekening') }}" class="btn btn-warning btn-md">Kembali</a></h4>
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