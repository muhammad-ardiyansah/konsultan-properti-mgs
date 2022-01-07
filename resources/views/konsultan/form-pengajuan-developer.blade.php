@extends('konsultan.layouts.dash-konsultan-layout-horizontal')
@section('title','Konsultan Properti PT. Mitra Guntur Sarana')

@section('content')

<div class="content">
    <!-- start page title -->
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xs-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Developer</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pengajuan</a></li>
                        <li class="breadcrumb-item active">Form Pengajuan</li>
                    </ol>
                </div>
                <h4 class="page-title">Input Pengajuan</h4>
                <!-- <h5>Lengkapi data berikut sesuai dengan data yang ingin diajukan</h5> -->
                <p class="muted">
                Lengkapi data berikut sesuai dengan data yang ingin diajukan :
                </p>
                 
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xs-12">

            @php

                $oldLuasTanahValue = old('luas_tanah');
                $msgAddErrLuasTanah = "";
                if ($errors->has('luas_tanah') && !empty($oldLuasTanahValue)) {
                    $msgAddErrLuasTanah = "\"".$oldLuasTanahValue."\"";
                    $oldLuasTanahValue = "";
                }            

                $oldKetinggianBangunanValue = old('ketinggian_bangunan');
                $msgAddErrKetinggianBangunan = "";
                if ($errors->has('ketinggian_bangunan') && !empty($oldKetinggianBangunanValue)) {
                    $msgAddErrKetinggianBangunan = "\"".$oldKetinggianBangunanValue."\"";
                    $oldKetinggianBangunanValue = "";
                }

                $oldJumlahLantaiValue = old('jumlah_lantai');
                $msgAddErrJumlahLantai = "";
                if ($errors->has('jumlah_lantai') && !empty($oldJumlahLantaiValue)) {
                    $msgAddErrJumlahLantai = "\"".$oldJumlahLantaiValue."\"";
                    $oldJumlahLantaiValue = "";
                }                

                $oldLuasLantaiValue = old('luas_lantai');
                $msgAddErrLuasLantai = "";
                if ($errors->has('luas_lantai') && !empty($oldLuasLantaiValue)) {
                    $msgAddErrLuasLantai = "\"".$oldLuasLantaiValue."\"";
                    $oldLuasLantaiValue = "";
                }

                $oldBlokRumahValue = old('blok_rumah');
                $msgErrBlokRumah = "";
                if ($errors->has('blok_rumah') && !empty($oldBlokRumahValue)) {
                    $msgErrBlokRumah = "\"".$oldBlokRumahValue."\"";
                    $oldBlokRumahValue = "";
                }                

                $oldHargaJualPerUnitValue = old('harga_jual_per_unit');
                $msgAddErrHargaJualPerUnit = "";
                if ($errors->has('harga_jual_per_unit') && !empty($oldHargaJualPerUnitValue)) {
                    $msgAddErrHargaJualPerUnit = "\"".$oldHargaJualPerUnitValue."\"";
                    $oldHargaJualPerUnitValue = "";
                }

            @endphp

            <form  method="POST" action="{{ route('konsultan.simpanPengajuan') }}" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
            @csrf
                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i> Input Data Perumahan</div>
                        <h5 class="text-primary float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                        <div class="ribbon-content">

                                @if ($errors->any())                        
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Error Input - </strong> Mohon periksa kembali input data Anda
                                    </div>
                                @endif

                                @if (Session::get('success'))
                                <div class="alert alert-success" role="alert">
                                    <i class="dripicons-checkmark me-2"></i> {{ Session::get('success') }} Lihat list pengajuan Anda <a href="{{ route('konsultan.listPengajuan') }}">disini</a> 
                                </div>
                                @endif

                                @if (Session::get('fail'))
                                <div class="alert alert-danger" role="alert">
                                    <i class="dripicons-wrong me-2"></i> {{ Session::get('fail') }}
                                </div>
                                @endif


                                <div class="row mb-3">
                                    <label for="fungsi_bangunan" class="col-3 col-form-label">Fungsi Utama</label>
                                    <div class="col-9">
                                        <input type="hidden" name="tlu_fungsi_bangunan_id" value="{{ $tluFungsiBangunan->id }}">
                                        <input type="text" class="form-control" id="fungsi_bangunan" name="fungsi_bangunan" placeholder=""  @error('fungsi_bangunan') required @enderror value="{{ $tluFungsiBangunan->fungsi_bangunan }}" readonly>
                                        @error('fungsi_bangunan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tlu_tipe_rumah_id" class="col-3 col-form-label">Tipe Bangunan</label>
                                    <div class="col-9">    
                                        <select class="form-control select2" name="tlu_tipe_rumah_id" id="tlu_tipe_rumah_id" data-toggle="select2" @error('tlu_tipe_rumah_id') required @enderror >
                                        <option value="">[- Pilih Tipe Rumah -]</option>
                                            @foreach ($tluTipeRumah as $id => $tipe_rumah)
                                                <option value="{{ $id }}" {{ $id == old('tlu_tipe_rumah_id') ? "selected" : "" }}>{{ $tipe_rumah }}</option>
                                            @endforeach
                                        </select>          
                                        @error('tlu_tipe_rumah_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>                      
                                </div>
                            
                                <div class="row mb-3">
                                    <label for="luas_tanah" class="col-3 col-form-label">Luas Tanah (m2)</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="luas_tanah" name="luas_tanah" maxlength="8" placeholder="" @error('luas_tanah') required @enderror value="{{ $oldLuasTanahValue }}" >
                                        @error('luas_tanah')
                                            <div class="invalid-feedback">
                                                {{ $msgAddErrLuasTanah." ".$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>                            

                                <div class="row mb-3">
                                    <label for="posisi_koordinat" class="col-3 col-form-label">Posisi Koordinat</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="posisi_koordinat" name="posisi_koordinat" placeholder="" @error('posisi_koordinat') required @enderror value="{{ old('posisi_koordinat') }}" >
                                        @error('posisi_koordinat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="klasifikasi_kompleksitas" class="col-3 col-form-label">Klasifikasi kompleksitas</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="klasifikasi_kompleksitas" name="klasifikasi_kompleksitas" placeholder="" @error('klasifikasi_kompleksitas') required @enderror value="{{ old('klasifikasi_kompleksitas') }}" >
                                        @error('klasifikasi_kompleksitas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>                            

                                <div class="row mb-3">
                                    <label for="ketinggian_bangunan" class="col-3 col-form-label">Ketinggian Bangunan (m)</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="ketinggian_bangunan" name="ketinggian_bangunan" placeholder="" @error('ketinggian_bangunan') required @enderror value="{{ $oldKetinggianBangunanValue }}" >
                                        @error('ketinggian_bangunan')
                                            <div class="invalid-feedback">
                                                {{ $msgAddErrKetinggianBangunan." ".$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="jumlah_lantai" class="col-3 col-form-label">Jumlah lantai</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="jumlah_lantai" name="jumlah_lantai" placeholder="" @error('jumlah_lantai') required @enderror value="{{ $oldJumlahLantaiValue }}" >
                                        @error('jumlah_lantai')
                                            <div class="invalid-feedback">
                                                {{ $msgAddErrJumlahLantai." ".$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>                            

                                <div class="row mb-3">
                                    <label for="luas_lantai" class="col-3 col-form-label">Luas lantai (m2)</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="luas_lantai" name="luas_lantai" placeholder="" @error('luas_lantai') required @enderror value="{{ $oldLuasLantaiValue }}" >
                                        @error('luas_lantai')
                                            <div class="invalid-feedback">
                                                {{ $msgAddErrLuasLantai." ".$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="blok_rumah" class="col-3 col-form-label">Letak bangunan (blok)</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="blok_rumah" name="blok_rumah" placeholder="" @error('blok_rumah') required @enderror data-role="tagsinput" value="{{ $oldBlokRumahValue }}">
                                        @error('blok_rumah')
                                            <div class="invalid-feedback">
                                                {{ $msgErrBlokRumah." ".$message }}
                                            </div>
                                        @enderror                                    
                                        <p class="muted">
                                            Isi data blok rumah dengan mengetik nama blok lalu tekan enter. Misal A1 (tekan enter). 
                                        </p>
                                        <p class="text-info">
                                        * Pengajuan hanya untuk 50 unit rumah. Jika lebih dari 50 unit, silahkan buat pengajuan baru.
                                        </p>                                    
                                    </div>
                                </div>       

                                <div class="row mb-3">
                                    <label for="developer_id" class="col-3 col-form-label">Developer</label>
                                    <div class="col-9">    
                                        <select class="form-control select2" name="developer_id" id="developer_id" data-toggle="select2" @error('developer_id') required @enderror >
                                        <option value="">[- Pilih Developer -]</option>
                                            @foreach ($developers as $id => $nama_perusahaan)
                                                <option value="{{ $id }}" {{ $id == old('developer_id') ? "selected" : "" }}>{{ $nama_perusahaan }}</option>
                                            @endforeach
                                        </select>          
                                        @error('developer_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>                      
                                </div>                                
                                
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <a href="javascript:void(0)" id="show-perumahan-developer">Tambah Perumahan</a>
                                    </div>
                                </div>  

                                <div class="row mb-3">
                                    <label for="perumahan_developer_id" class="col-3 col-form-label">Nama Perumahan</label>
                                    <div class="col-9">    
                                        <select class="form-control select2" name="perumahan_developer_id" id="perumahan_developer_id" data-toggle="select2" @error('perumahan_developer_id') required @enderror >
                                        <option value="">[- Pilih Perumahan -]</option>
                                        @foreach ($perumahanDevelopers as $id => $nama_perumahan)
                                            <option value="{{ $id }}" {{ $id == old('perumahan_developer_id') ? "selected" : "" }}>{{ $nama_perumahan }}</option>
                                        @endforeach                                        
                                        </select>          
                                        @error('perumahan_developer_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>                      
                                </div>

                                <div id="perumahan-developer-additional-info">

                                </div>

                                @php
                                    $oldBlokRumahs = [];
                                    if (!empty(old('blok_rumah'))) {
                                        $oldBlokRumahs = explode(",", old('blok_rumah'));
                                    }
                                    //print_r($oldBlokRumahs);
                                @endphp
                                <div class="row mb-3">
                                    <label for="rumah_sample" class="col-3 col-form-label">Rumah sample</label>
                                    <div class="col-9">    
                                        <select class="form-control select2" name="rumah_sample" id="rumah_sample" data-toggle="select2" @error('rumah_sample') required @enderror >
                                        <option value="">[- Pilih 1 rumah yang mewakili semua blok rumah -]</option>
                                            @if (!$msgErrBlokRumah)
                                                @forelse ($oldBlokRumahs as $oldBlokRumah)
                                                    <option value="{{ $oldBlokRumah }}" {{ $oldBlokRumah == old('rumah_sample') ? "selected" : "" }}>{{ $oldBlokRumah }}</option>
                                                @endforeach
                                            @endif    
                                        </select>          
                                        @error('rumah_sample')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>                      
                                </div>        
                                
                                <div class="row mb-3">
                                    <label for="harga_jual_per_unit" class="col-3 col-form-label">Harga jual per unit (Rp.)</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="harga_jual_per_unit" name="harga_jual_per_unit" placeholder="" @error('harga_jual_per_unit') required @enderror value="{{ $oldHargaJualPerUnitValue }}" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                        @error('harga_jual_per_unit')
                                            <div class="invalid-feedback">
                                                {{ $msgAddErrHargaJualPerUnit." ".$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>                            
    
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->

                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i> Pengawas</div>
                        <h5 class="text-primary float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                        <div class="ribbon-content">
                        
                            <div class="row">
                                <div class="col-12 text-end">
                                    <a href="javascript:void(0)" id="show-pengawas">Tambah Pengawas</a>
                                </div>
                            </div>  

                            <div class="row mb-3">
                                <label for="pengawas_id" class="col-3 col-form-label">Data Pengawas</label>
                                <div class="col-9">    
                                    <select class="form-control select2" name="pengawas_id" id="pengawas_id" data-toggle="select2" @error('pengawas_id') required @enderror >
                                    <option value="">[- Pilih Pengawas -]</option>
                                    @foreach ($pengawas as $id => $nama_perusahaan)
                                        <option value="{{ $id }}" {{ $id == old('pengawas_id') ? "selected" : "" }}>{{ $nama_perusahaan }}</option>
                                    @endforeach                                        
                                    </select>          
                                    @error('pengawas_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>

                            <div class="row mb-3">
                                <label for="penanggung_jawab_pengawas" class="col-lg-3 col-xl-3 col-form-label">Penanggung Jawab</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control" id="penanggung_jawab_pengawas" name="penanggung_jawab_pengawas" disabled value="">
                                </div>
                            </div>                            

                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->

                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i> Wilayah Pengajuan Apersi</div>
                        <h5 class="text-primary float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                        <div class="ribbon-content">

                            <div class="row mb-3">
                                <label for="province_code" class="col-3 col-form-label">Provinsi</label>
                                <div class="col-9">    
                                    <select class="form-control select2" name="province_code_apersi" id="province_code_apersi" data-toggle="select2" @error('province_code_apersi') required @enderror >
                                    <option value="">[- Pilih Provinsi -]</option>
                                        @foreach ($provinces as $code => $name)
                                            <option value="{{ $code }}" {{ $code == old('province_code_apersi') ? "selected" : "" }}>{{ $name }}</option>
                                        @endforeach
                                    </select>          
                                    @error('province_code_apersi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>

                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->

                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i> Input Data Administrasi</div>
                        <h5 class="text-primary float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                        <div class="ribbon-content">

                            <div class="row mb-3">
                                <label for="sertifikat_hak_atas_tanah" class="col-3 col-form-label">Sertifikat hak atas tanah</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="sertifikat_hak_atas_tanah" name="sertifikat_hak_atas_tanah" placeholder="" @error('sertifikat_hak_atas_tanah') required @enderror value="{{ old('sertifikat_hak_atas_tanah') }}" >
                                    @error('sertifikat_hak_atas_tanah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="izin_pemanfaatan_tanah" class="col-3 col-form-label">Izin pemanfaatan tanah</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="izin_pemanfaatan_tanah" name="izin_pemanfaatan_tanah" placeholder="" @error('izin_pemanfaatan_tanah') required @enderror value="{{ old('izin_pemanfaatan_tanah') }}" >
                                    @error('izin_pemanfaatan_tanah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="pengesahan_site_plan" class="col-3 col-form-label">Pengesahan site plan</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="pengesahan_site_plan" name="pengesahan_site_plan" placeholder="" @error('pengesahan_site_plan') required @enderror value="{{ old('pengesahan_site_plan') }}" >
                                    @error('pengesahan_site_plan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                            

                            <div class="row mb-3">
                                <label for="nomor_imb" class="col-3 col-form-label">Nomor IMB</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="nomor_imb" name="nomor_imb" placeholder="" @error('nomor_imb') required @enderror value="{{ old('nomor_imb') }}" >
                                    @error('nomor_imb')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="input_nomor_izin_lainnya" class="col-3 col-form-label">Input nomor izin lainnya</label>
                                <div class="col-4">
                                    <input type="text" class="form-control" id="jenis_nomor_izin_lainnya" name="jenis_nomor_izin_lainnya" placeholder="Jenis nomor izin lainnya" value="" >
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control" id="nomor_izin_lainnya" name="nomor_izin_lainnya" placeholder="Nomor izin lainnya" value="" >
                                </div>
                            </div>

                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->                        

                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="justify-content-end row">
                            <div class="col-9">                        
                                <button type="Submit" class="btn btn-primary">Kirim Data</button>
                                <button type="Reset" class="btn btn-warning">Reset</button>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->

            </form> 

        </div> <!-- end col-->
    </div>    

</div>

@include('modals-dialog.modal-static-full-width')
@include('modals-dialog.modal-confirmation')
@include('modals-dialog.modal-warning')

@endsection

@push('styles')

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />

    <style>
    
        .bootstrap-tagsinput {
            box-shadow: none;
            padding: 3px 7px 6px;
            border: 1px solid #e3e3e3;
            width: 100%;
        }
        .bootstrap-tagsinput .label-info {
            /* background-color: #2196f3 !important;
            display: inline-block;
            padding: 5px;
            margin-bottom: 3px;
            border-radius: 3px; */
            background-color: #727cf5;
            border: none;
            color: #fff;
            border-radius: 3px;
            padding: 0 7px;
            margin-top: 6px;        
        
        }

    </style>

@endpush

@push('scripts')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<script src="{{ asset('assets/js/autoNumeric.js') }}"></script>
<script>
window.addEventListener('DOMContentLoaded', function() {
    $(function () {

        // $.ajaxSetup({
        //     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        // });        

        $('#luas_tanah').autoNumeric('init', {aSep: '.', aDec: ',', vMax: '1000'});
        $('#ketinggian_bangunan').autoNumeric('init', {aSep: '.', aDec: ',', vMax: '100'});
        $('#jumlah_lantai').autoNumeric('init', {aSep: '.', aDec: ',', vMax: '100', mDec: '0'});   
        $('#luas_lantai').autoNumeric('init', {aSep: '.', aDec: ',', vMax: '500'});        

        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

        $("#blok_rumah").on('itemAdded', function(event) {
            // console.log('item added : '+event.item);
            $('#rumah_sample').append($("<option></option>").attr("value",event.item).text(event.item)); 
        });
        $("#blok_rumah").on('itemRemoved', function(event) {
            // console.log('item removed : '+event.item);
            $("#rumah_sample option[value='"+event.item+"']").remove();
        });    

        $('#show-perumahan-developer').on('click', function () {
            // alert('show');
            // $("#staticBackdrop").modal("show");
            if ($('#developer_id').val()) {
                var title = "{{ 'Daftar Perumahan '}}" + $('#developer_id option:selected').text();
                $.ajax({
                    url: "{{ route('konsultan.listPerumahanDeveloperAjax') }}",
                    method: 'GET',
                    headers: headers,
                    data: {developer_id: $('#developer_id').val()},
                    success: function (response) {
                        $("#staticBackdrop").modal("show");
                        $('.modal-title').html(title);
                        $("#modal-content").html(response);
                    },
                    error: function(response) {
                        console.log(response);   
                    }                
                });
            }else{
                $('.modal-content-warning').html('Anda harus memilih developer terlebih dahulu');
                $("#warning-alert-modal").modal("show");
            }

        });

        $('#developer_id').on('change', function () {
            // alert($(this).val());
            $.ajax({
                url: "{{ route('konsultan.getPerumahanDevelopers') }}",
                method: 'GET',
                headers: headers,
                data: {developer_id: $(this).val()},
                success: function (response) {
                    // console.log(response);
                    $('#perumahan_developer_id').empty();
                    $('#perumahan-developer-additional-info').empty();
                    $('#perumahan_developer_id').append(new Option('[- Semua Perumahan -]', ''));
                    $.each(response, function (code, name) {
                        $('#perumahan_developer_id').append(new Option(name, code))
                        // alert(name);
                    })
                },
                error: function(response) {
                    console.log(response);   
                }                
            })

        });

        $(document).on('change', "#perumahan_developer_id", function(event) {            
            // alert($(this).val());
            $('#perumahan-developer-additional-info').empty();
            $.ajax({
                url: "{{ route('konsultan.getPerumahanDeveloperAdditionalInfo', ['id' =>" + $(this).val() + "]) }}",
                method: 'GET',
                headers: headers,
                data: {id: $(this).val()},
                success: function (response) {
                    // console.log(response);
                    $('#perumahan-developer-additional-info').html(response);
                    // alert($('#province_code').val());

                },
                error: function(response) {
                    console.log(response);   
                }                
            })            
        });

        // $('#province_code').on('change', function () {
        $(document).on('change', "#province_code", function(event) {    
            // alert($(this).val());
            $.ajax({
                url: "{{ route('developer.getCities') }}",
                // url : "/dependent-dropdown/store",
                method: 'POST',
                headers: headers,
                data: {code: $(this).val()},
                success: function (response) {
                    // alert(response);
                    $('#city_code').empty();
                    $('#district_code').empty();
                    $('#village_code').empty();

                    $('#city_code').append(new Option('[- Pilih Kabupaten/Kota -]', ''));
                    $('#district_code').append(new Option('[- Pilih Kecamatan -]', ''));
                    $('#village_code').append(new Option('[- Pilih Desa/Kelurahan -]', ''));

                    $.each(response, function (code, name) {
                        $('#city_code').append(new Option(name, code))
                        // alert(name);
                    })
                },
                error: function(response) {
                    console.log(response);   
                }
            })            
        });

        // $('#city_code').on('change', function () {
        $(document).on('change', "#city_code", function(event) {    
            // alert($(this).val());
            $.ajax({
                url: "{{ route('developer.getDistricts') }}",
                // url : "/dependent-dropdown/store",
                method: 'POST',
                headers: headers,
                data: {code: $(this).val()},
                success: function (response) {
                    // alert(response);
                    $('#district_code').empty();
                    $('#village_code').empty();

                    $('#district_code').append(new Option('[- Pilih Kecamatan -]', ''));
                    $('#village_code').append(new Option('[- Pilih Desa/Kelurahan -]', ''));

                    $.each(response, function (code, name) {
                        $('#district_code').append(new Option(name, code))
                        // alert(name);
                    })
                },
                error: function(response) {
                    console.log(response);   
                }                
            })            
        });        

        // $('#district_code').on('change', function () {
        $(document).on('change', "#district_code", function(event) {            
            // alert($(this).val());
            $.ajax({
                url: "{{ route('developer.getVillages') }}",
                // url : "/dependent-dropdown/store",
                method: 'POST',
                headers: headers,
                data: {code: $(this).val()},
                success: function (response) {
                    // alert(response);
                    $('#village_code').empty();

                    $('#village_code').append(new Option('[- Pilih Desa/Kelurahan -]', ''));
                    $.each(response, function (code, name) {
                        $('#village_code').append(new Option(name, code))
                        // alert(name);
                    })
                },
                error: function(response) {
                    console.log(response);   
                }                
            })            
        });     

        // $('#tambah-perumahan-developer').on('click', function () {
        //     alert('test');
        // }); 

        $(document).on('click', "#tambah-perumahan-developer", function(event) {
            // $("#modal-content").empty();
            // alert('test');
            var title = "{{ 'Tambah Perumahan '}}" + $('#developer_id option:selected').text();
            $.ajax({
                url: "{{ route('konsultan.tambahPerumahanDeveloper') }}",
                method: 'GET',
                headers: headers,
                data: {developer_id: $('#developer_id').val(), url_tambah: 'konsultan.tambahPerumahanDeveloper', url_list: 'konsultan.listPerumahanDeveloperAjax'},
                success: function (response) {
                    // $("#staticBackdrop").modal("show");
                    $('.modal-title').html(title);
                    $("#modal-content").empty();
                    $("#modal-content").html(response);                    

                },
                error: function(response) {
                    console.log(response);   
                }
            })

        });                   
        
        $(document).on('submit', "#perumahan-developer-form", function(event) {
            // alert('submit');
            // alert($(this).attr("method"));

            $.ajax({
                // url: $(this).attr("action"),
                url: "{{ route('konsultan.simpanPerumahanDeveloper') }}",
                method: 'POST',
                headers: headers,
                data: $(this).serialize(),
                success: function (response) {
                    // console.log(response);
                    // console.log('Test');
                    $("#modal-content").empty();
                    $("#modal-content").html(response);
                    repopulatePerumahanDeveloperSelect();

                },
                error: function(response) {
                    console.log(response);   
                }    
            })

            return false;
        });   

        function repopulatePerumahanDeveloperSelect() {
            $.ajax({
                url: "{{ route('konsultan.getPerumahanDevelopers') }}",
                method: 'GET',
                data: {developer_id: $('#developer_id').val()},
                success: function (response) {
                    $('#perumahan_developer_id').empty();

                    $('#perumahan_developer_id').append(new Option('[- Pilih Perumahan -]', ''));
                    $.each(response, function (id, nama_perumahan) {
                        $('#perumahan_developer_id').append(new Option(nama_perumahan, id))
                        // alert(nama_perumahan);
                    })                    
                },
                error: function(response) {
                    console.log(response);   
                }
            })
        }


        $(document).on('click', '#kembali', function () {
            // alert('kembali');
            var title = "{{ 'Daftar Perumahan '}}" + $('#developer_id option:selected').text();
            $.ajax({
                url: "{{ route('konsultan.listPerumahanDeveloperAjax') }}",
                method: 'GET',
                headers: headers,
                data: {developer_id: $('#developer_id').val()},
                success: function (response) {
                    $("#staticBackdrop").modal("show");
                    $('.modal-title').html(title);
                    $("#modal-content").html(response);
                },
                error: function(response) {
                    console.log(response);   
                }
            })

        });
        
        $(document).on('click','.page-item a',function(event){
            event.preventDefault();
        
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            // alert(url);
            // var page = $(this).attr('href').split('page=')[1];
            // alert(page);
            getData(url);
        
        });        

        function getData(url) {
            // body...
            $.ajax({
                // url : '?page=' + page,
                url: url,
                type : 'get',
                datatype : 'html',
            }).done(function(data){
                $('#modal-content').empty().html(data);
                // location.hash = page;
            }).fail(function(jqXHR,ajaxOptions,thrownError){
                alert('No response from server');
            });
        }

        $(document).on('submit', "#cari-perumahan-developer-form", function(event) {
            // alert('submit');
            // alert($(this).attr("method"));

            $.ajax({
                // url: $(this).attr("action"),
                url: "{{ route('konsultan.listPerumahanDeveloperAjax') }}",
                method: 'GET',
                headers: headers,
                data: $(this).serialize(),
                success: function (response) {
                    // console.log(response);
                    // console.log('Test');
                    $("#modal-content").empty();
                    $("#modal-content").html(response);

                },
                error: function(response) {
                    console.log(response);   
                }    
            })

            return false;
        });

        $(document).on('click', ".edit", function(event) {
            event.preventDefault();
            var index = $(".edit").index(this);
            var id = $('input[name="id[]"]').eq(index).val();
            // alert(id);
            var title = "{{ 'Edit Perumahan '}}" + $('#developer_id option:selected').text();
            $.ajax({
                // url: $(this).attr('href'),
                url: "{{ route('konsultan.editPerumahanDeveloper') }}",
                method: 'GET',
                headers: headers,
                data: {id: id, url_edit: 'konsultan.editPerumahanDeveloper', url_list: 'konsultan.listPerumahanDeveloperAjax'},
                success: function (response) {
                    // $("#staticBackdrop").modal("show");
                    $('.modal-title').html(title);
                    $("#modal-content").empty();
                    $("#modal-content").html(response);                    

                },
                error: function(response) {
                    console.log(response);   
                }                
            })            
        });

        $(document).on('click', ".delete", function(event) {
            event.preventDefault();        
            // alert('delete');
            var title = "Konfirmasi penghapusan data";
            var index = $(".delete").index(this);
            var currentRow=$(this).closest("tr");
            var namaPerumahan=currentRow.find("td:eq(1)").text(); 
            var id = $('input[name="id[]"]').eq(index).val();
            // alert(id);


            var route = "{!! route('konsultan.deletePerumahanDeveloper', ['id' => 'id-delete', 'url_list' => 'konsultan.listPerumahanDeveloperAjax']) !!}";
            route = route.replace('id-delete', id);
            // alert(route);
            $('.title-confirm').html(title);
            // $('.modal-content-confirm').html(index);
            $('#confirm-value').val(route);
            // $('.modal-content-confirm').html($('#confirm-value').val());
            $('.modal-content-confirm').html('Apakah anda yakin akan menghapus data "'+ namaPerumahan + '"');
            $("#confirm-modal").modal("show");
        });
        
        $(document).on('click', "#confirm-yes", function(event) {
            event.preventDefault();

            $.ajax({
                url: $('#confirm-value').val(),
                // url: "{{ route('konsultan.deletePerumahanDeveloper') }}",
                method: 'POST',
                headers: headers,
                // data: {id: $('#confirm-value').val(), url_list: 'konsultan.listPerumahanDeveloperAjax'},
                success: function (response) {
                    // console.log(response);
                    $("#modal-content").empty();
                    $("#modal-content").html(response);                    

                },
                error: function(response) {
                    console.log(response);   
                }                
            })            
        });        


        $('#show-pengawas').on('click', function () {

            // $("#staticBackdrop").modal("show");
            var title = "Daftar Pengawas";
            $.ajax({
                url: "{{ route('konsultan.listPengawasAjax') }}",
                method: 'GET',
                headers: headers,
                success: function (response) {
                    $("#staticBackdrop").modal("show");
                    $('.modal-title').html(title);
                    $("#modal-content").html(response);
                },
                error: function(response) {
                    console.log(response);   
                }                
            })

        });

        $(document).on('click', "#tambah-pengawas", function(event) {
            // $("#modal-content").empty();
            // alert('test');
            var title = "Tambah Pengawas";
            $.ajax({
                url: "{{ route('konsultan.tambahPengawas') }}",
                method: 'GET',
                headers: headers,
                data: {url_tambah: 'konsultan.tambahPengawas', url_list: 'konsultan.listPengawasAjax'},
                success: function (response) {
                    // $("#staticBackdrop").modal("show");
                    $('.modal-title').html(title);
                    $("#modal-content").empty();
                    $("#modal-content").html(response);                    

                },
                error: function(response) {
                    console.log(response);   
                }
            })

        });

        $(document).on('submit', "#pengawas-form", function(event) {
            // alert('submit');
            // alert($(this).attr("method"));

            $.ajax({
                // url: $(this).attr("action"),
                url: "{{ route('konsultan.simpanPengawas') }}",
                method: 'POST',
                headers: headers,
                data: $(this).serialize(),
                success: function (response) {
                    console.log(response);
                    // console.log('Test');
                    
                    var errFlag = $(response).find("input[name='validation_errors']").val();                    
                    $("#modal-content").empty();
                    $("#modal-content").html(response);
                    
                    if(!errFlag){
                        repopulatePengawasSelect();
                    }   

                },
                error: function(response) {
                    console.log(response);   
                }    
            })

            return false;
        });

        function repopulatePengawasSelect() {
            $.ajax({
                url: "{{ route('konsultan.getPengawas') }}",
                method: 'GET',
                success: function (response) {
                    $('#pengawas_id').empty();

                    $('#pengawas_id').append(new Option('[- Pilih Pengawas -]', ''));
                    $.each(response, function (id, nama_perusahaan) {
                        $('#pengawas_id').append(new Option(nama_perusahaan, id))
                        // alert(nama_perusahaan);
                    })                    
                },
                error: function(response) {
                    console.log(response);   
                }
            })
        }

        $(document).on('click', '#kembali-pengawas-form', function () {
            // alert('kembali');
            var title = "Daftar Pengawas";
            $.ajax({
                url: "{{ route('konsultan.listPengawasAjax') }}",
                method: 'GET',
                headers: headers,
                success: function (response) {
                    $("#staticBackdrop").modal("show");
                    $('.modal-title').html(title);
                    $("#modal-content").html(response);
                },
                error: function(response) {
                    console.log(response);   
                }
            })

        });

        $(document).on('submit', "#cari-pengawas-form", function(event) {
            // alert('submit');
            // alert($(this).attr("method"));

            $.ajax({
                // url: $(this).attr("action"),
                url: "{{ route('konsultan.listPengawasAjax') }}",
                method: 'GET',
                headers: headers,
                data: $(this).serialize(),
                success: function (response) {
                    // console.log(response);
                    // console.log('Test');
                    $("#modal-content").empty();
                    $("#modal-content").html(response);

                },
                error: function(response) {
                    console.log(response);   
                }    
            })

            return false;
        });

        $(document).on('click', ".edit-pengawas", function(event) {
            event.preventDefault();
            var index = $(".edit-pengawas").index(this);
            var id = $('input[name="id[]"]').eq(index).val();
            // alert(id);
            var title = "Edit Pengawas";
            $.ajax({
                // url: $(this).attr('href'),
                url: "{{ route('konsultan.editPengawas') }}",
                method: 'GET',
                headers: headers,
                data: {id: id, url_edit: 'konsultan.editPengawas', url_list: 'konsultan.listPengawasAjax'},
                success: function (response) {
                    // $("#staticBackdrop").modal("show");
                    $('.modal-title').html(title);
                    $("#modal-content").empty();
                    $("#modal-content").html(response);                    

                },
                error: function(response) {
                    console.log(response);   
                }                
            })            
        });

        $(document).on('click', ".delete-pengawas", function(event) {
            event.preventDefault();        
            // alert('delete');
            var title = "Konfirmasi penghapusan data";
            var index = $(".delete-pengawas").index(this);
            var currentRow=$(this).closest("tr");
            var namaPerusahaan=currentRow.find("td:eq(2)").text(); 
            var id = $('input[name="id[]"]').eq(index).val();
            // alert(id);

            var route = "{!! route('konsultan.deletePengawas', ['id' => 'id-delete', 'url_list' => 'konsultan.listPengawasAjax']) !!}";
            route = route.replace('id-delete', id);
            // alert(route);
            $('.title-confirm').html(title);
            // $('.modal-content-confirm').html(index);
            $('#confirm-value').val(route);
            // $('.modal-content-confirm').html($('#confirm-value').val());
            $('.modal-content-confirm').html('Apakah anda yakin akan menghapus data "'+ namaPerusahaan + '"');
            $("#confirm-modal").modal("show");
        });

        $('#pengawas_id').on('change', function () {
            // alert($(this).val());
            
            $.ajax({
                url: "{{ route('konsultan.getPenanggungJawabPengawas') }}",
                method: 'GET',
                headers: headers,
                data: {id: $(this).val()},
                success: function (response) {
                    // console.log(response);
                    $('#penanggung_jawab_pengawas').val(response);
                },
                error: function(response) {
                    console.log(response);   
                }                
            })

        });        


    });


});

</script>
@endpush