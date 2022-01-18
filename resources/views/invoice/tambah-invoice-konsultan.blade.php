@extends('konsultan.layouts.dash-konsultan-layout-horizontal')
@section('title','Konsultan Properti PT. Mitra Guntur Sarana')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Invoice</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('konsultan.indexInvoiceKonsultan') }}">List Invoice</a></li>
                    <li class="breadcrumb-item active">Tambah Invoice</li>
                </ol>
            </div>
            <h4 class="page-title">Tambah Invoice</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card widget-flat">
            <div class="card-body">
                <form id="tampilkan-pengajuan" name="tampilkan-pengajuan" method="get" action="{{ route('konsultan.tambahInvoiceKonsultan') }}">

                    <div class="row mb-3">
                        <label for="kode_pengajuan" class="col-lg-3 col-xl-3 col-form-label">Masukkan Kode Pengajuan</label>
                        <div class="col-lg-9 col-xl-9">
                            <input type="text" class="form-control" id="kode_pengajuan" name="kode_pengajuan" value="{{ request()->get('kode_pengajuan') }}">
                        </div>
                    </div>      
                    <div class="row">          
                        <div class="col-lg-3 col-xl-3"></div>
                        <div class="col-lg-9 col-xl-9 text-end">          
                            <button type="Submit" id="tampilkan" class="btn btn-success"><i class="mdi mdi-post"></i> Tampilkan</button>
                        </div>
                    </div>

                </form>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>

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

{{-- 
<ul>

@foreach ($errors->all() as $error)

    <li>{{ $error }}</li>

@endforeach    

</ul>
--}}

<div class="row">
    <div class="col-12">

        @if ($isKodePengajuanWasSet)
            
            @if ($isPengajuanExist)

                <div class="accordion" id="accordionExample">
                    <div class="card mb-1">
                        <div class="card-header" id="headingOne">
                            <h5 class="m-0">
                                <a class="custom-accordion-title d-block pt-1 pb-1" data-bs-toggle="collapse" href="#collapseOne" role="button" aria-expanded="false" aria-controls="collapseOne">
                                    Info Developer
                                </a>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse multi-collapse">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label for="nama_developer" class="col-lg-3 col-xl-3 col-form-label">Developer</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="nama_developer" name="nama_developer" disabled value="{{ $pengajuanDeveloper->developer->nama_perusahaan }}">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="no_telpon" class="col-lg-3 col-xl-3 col-form-label">Nomor Telpon</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="no_telpon" name="no_telpon" disabled value="{{ $pengajuanDeveloper->developer->no_hp }}">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="nama_direktur" class="col-lg-3 col-xl-3 col-form-label">Nama Direktur</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="nama_direktur" name="nama_direktur" disabled value="{{ $pengajuanDeveloper->developer->nama_direktur }}">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="no_kta" class="col-lg-3 col-xl-3 col-form-label">No. KTA</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="no_kta" name="no_kta" disabled value="{{ $pengajuanDeveloper->developer->no_kta_apersi }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card mb-1">
                        <div class="card-header" id="headingTwo">
                            <h5 class="m-0">
                                <a class="custom-accordion-title collapsed d-block pt-1 pb-1"
                                    data-bs-toggle="collapse" href="#collapseTwo" role="button"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    Info Administrasi
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse multi-collapse">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label for="sertifikat_hak_atas_tanah" class="col-lg-3 col-xl-3 col-form-label">Sertifikat hak atas tanah</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="sertifikat_hak_atas_tanah" name="sertifikat_hak_atas_tanah" disabled value="{{ $pengajuanDeveloper->sertifikat_hak_atas_tanah }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="izin_pemanfaatan_tanah" class="col-lg-3 col-xl-3 col-form-label">Izin pemanfataan tanah</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="izin_pemanfaatan_tanah" name="izin_pemanfaatan_tanah" disabled value="{{ $pengajuanDeveloper->izin_pemanfaatan_tanah }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="pengesahan_site_plan" class="col-lg-3 col-xl-3 col-form-label">Pengesahan site plan</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="pengesahan_site_plan" name="pengesahan_site_plan" disabled value="{{ $pengajuanDeveloper->pengesahan_site_plan }}">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="nomor_imb" class="col-lg-3 col-xl-3 col-form-label">Nomor IMB</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="nomor_imb" name="nomor_imb" disabled value="{{ $pengajuanDeveloper->nomor_imb }}">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="nomor_izin_lainnya" class="col-lg-3 col-xl-3 col-form-label">Nomor izin lainnya</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <input type="text" class="form-control" id="jenis_nomor_izin_lainnya" name="jenis_nomor_izin_lainnya" disabled value="{{ $pengajuanDeveloper->jenis_nomor_izin_lainnya }}">
                                    </div>
                                    <div class="col-lg-5 col-xl-5">
                                        <input type="text" class="form-control" id="nomor_izin_lainnya" name="nomor_izin_lainnya" disabled value="{{ $pengajuanDeveloper->nomor_izin_lainnya }}">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card mb-1">
                        <div class="card-header" id="headingThree">
                            <h5 class="m-0">
                                <a class="custom-accordion-title collapsed d-block pt-1 pb-1"
                                    data-bs-toggle="collapse" href="#collapseThree" role="button"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    Info Perumahan
                                </a>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse multi-collapse">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label for="kode_pengajuan" class="col-lg-3 col-xl-3 col-form-label">Kode Pengajuan</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="kode_pengajuan" name="kode_pengajuan" disabled value="{{ $pengajuanDeveloper->kode_pengajuan; }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="no_registrasi" class="col-lg-3 col-xl-3 col-form-label">No.Registrasi</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="no_registrasi" name="no_registrasi" disabled value="{{ $pengajuanDeveloper->no_registrasi; }}">
                                    </div>
                                </div>                        

                                <div class="row mb-3">
                                    <label for="fungsi_bangunan" class="col-lg-3 col-xl-3 col-form-label">Fungsi Bangunan</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="fungsi_bangunan" name="fungsi_bangunan" disabled value="{{ $pengajuanDeveloper->tlu_fungsi_bangunan->fungsi_bangunan; }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tipe_bangunan" class="col-lg-3 col-xl-3 col-form-label">Tipe Bangunan</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="tipe_bangunan" name="tipe_bangunan" disabled value="{{ $pengajuanDeveloper->tlu_tipe_rumah->tipe_rumah; }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="luas_tanah" class="col-lg-3 col-xl-3 col-form-label">Luas Tanah (m2)</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="luas_tanah" name="luas_tanah" disabled value="@decimal_dipisah_koma($pengajuanDeveloper->luas_tanah)" >
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="posisi_koordinat" class="col-lg-3 col-xl-3 col-form-label">Posisi Koordinat</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="posisi_koordinat" name="posisi_koordinat" disabled value="{{ $pengajuanDeveloper->posisi_koordinat; }}" >
                                    </div>
                                </div>                        

                                <div class="row mb-3">
                                    <label for="klasifikasi_kompleksitas" class="col-lg-3 col-xl-3 col-form-label">Klasifikasi Kompleksitas</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="klasifikasi_kompleksitas" name="klasifikasi_kompleksitas" disabled value="{{ $pengajuanDeveloper->klasifikasi_kompleksitas; }}" >
                                    </div>
                                </div>                    

                                <div class="row mb-3">
                                    <label for="ketinggian_bangunan" class="col-lg-3 col-xl-3 col-form-label">Ketinggian Bangunan (m)</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="ketinggian_bangunan" name="ketinggian_bangunan" disabled value="@decimal_dipisah_koma($pengajuanDeveloper->ketinggian_bangunan)" >
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="jumlah_lantai" class="col-lg-3 col-xl-3 col-form-label">Jumlah Lantai</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="jumlah_lantai" name="jumlah_lantai" disabled value="@decimal_ke_integer($pengajuanDeveloper->jumlah_lantai)" >
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="luas_lantai" class="col-lg-3 col-xl-3 col-form-label">Luas Lantai (m2)</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="luas_lantai" name="luas_lantai" disabled value="@decimal_dipisah_koma($pengajuanDeveloper->luas_lantai)" >
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="blok_rumah" class="col-lg-3 col-xl-3 col-form-label">Letak Bangunan (blok) </label>
                                    <div class="col-lg-9 col-xl-9">
                                        <textarea class="form-control" placeholder="" id="blok_rumah" name="blok_rumah" rows="3" disabled >{{ $pengajuanDeveloper->blok_rumah }}</textarea>
                                    </div>
                                </div>                        

                                <div class="row mb-3">
                                    <label for="developer" class="col-lg-3 col-xl-3 col-form-label">Developer</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="developer" name="developer" disabled value="{{ $pengajuanDeveloper->developer->nama_perusahaan; }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nama_perumahan" class="col-lg-3 col-xl-3 col-form-label">Nama Perumahan</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="nama_perumahan" name="nama_perumahan" disabled value="{{ $pengajuanDeveloper->perumahan_developer->nama_perumahan; }}">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="provinsi" class="col-lg-3 col-xl-3 col-form-label">Provinsi</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="provinsi" name="provinsi" disabled value="{{ $pengajuanDeveloper->perumahan_developer->province->name; }}">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="kabupaten_kota" class="col-lg-3 col-xl-3 col-form-label">Kabupaten/Kota</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="kabupaten_kota" name="kabupaten_kota" disabled value="{{ $pengajuanDeveloper->perumahan_developer->city->name; }}">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="kecamatan" class="col-lg-3 col-xl-3 col-form-label">Kecamatan</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" disabled value="{{ $pengajuanDeveloper->perumahan_developer->district->name; }}">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="desa" class="col-lg-3 col-xl-3 col-form-label">Desa</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="desa" name="desa" disabled value="{{ $pengajuanDeveloper->perumahan_developer->village->name; }}">
                                    </div>
                                </div>                        

                                <div class="row mb-3">
                                    <label for="kampung" class="col-lg-3 col-xl-3 col-form-label">Kampung</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="kampung" name="kampung" disabled value="{{ $pengajuanDeveloper->perumahan_developer->kampung }}">
                                    </div>
                                </div>                        

                                <div class="row mb-3">
                                    <label for="alamat" class="col-lg-3 col-xl-3 col-form-label">Alamat </label>
                                    <div class="col-lg-9 col-xl-9">
                                        <textarea class="form-control" placeholder="" id="alamat" name="alamat" rows="3" disabled >{{ $pengajuanDeveloper->perumahan_developer->alamat }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="rumah_sample" class="col-lg-3 col-xl-3 col-form-label">Rumah Sample</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="rumah_sample" name="rumah_sample" disabled value="{{ $pengajuanDeveloper->rumah_sample }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="harga_jual_per_unit" class="col-lg-3 col-xl-3 col-form-label">Harga Jual Per Unit</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="harga_jual_per_unit" name="harga_jual_per_unit" disabled value="@format_rupiah_dengan_rp($pengajuanDeveloper->harga_jual_per_unit)">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card mb-1">
                        <div class="card-header" id="headingFour">
                            <h5 class="m-0">
                                <a class="custom-accordion-title collapsed d-block pt-1 pb-1"
                                    data-bs-toggle="collapse" href="#collapseFour" role="button"
                                    aria-expanded="false" aria-controls="collapseFour">
                                    Info Pengawas
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse multi-collapse">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label for="pengawas" class="col-lg-3 col-xl-3 col-form-label">Pengawas</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="pengawas" name="pengawas" disabled value="{{ $pengajuanDeveloper->pengawas->nama_perusahaan }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="penanggung_jawab_pengawas" class="col-lg-3 col-xl-3 col-form-label">Penanggung Jawab</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="penanggung_jawab_pengawas" name="penanggung_jawab_pengawas" disabled value="{{ $pengajuanDeveloper->pengawas->nama_direktur }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    @if ($pengajuanDeveloper->province_code_apersi)
                    <div class="card mb-1">
                        <div class="card-header" id="headingSix">
                            <h5 class="m-0">
                                <a class="custom-accordion-title collapsed d-block pt-1 pb-1"
                                    data-bs-toggle="collapse" href="#collapseSix" role="button"
                                    aria-expanded="false" aria-controls="collapseSix">
                                    Wilayah Pengajuan Apersi
                                </a>
                            </h5>
                        </div>
                        <div id="collapseSix" class="collapse multi-collapse">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label for="dpd_apersi" class="col-lg-3 col-xl-3 col-form-label">Provinsi</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="dpd_apersi" name="dpd_apersi" disabled value="{{ $pengajuanDeveloper->province_apersi->name }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> 
                    @endif                   

                    <div class="card mb-1">
                        <div class="card-header" id="headingFive">
                            <h5 class="m-0">
                                <a class="custom-accordion-title collapsed d-block pt-1 pb-1"
                                    data-bs-toggle="collapse" href="#collapseFive" role="button"
                                    aria-expanded="false" aria-controls="collapseFive">
                                    Status Pengajuan Terakhir
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse multi-collapse">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label for="status_pengajuan_terakhir" class="col-lg-3 col-xl-3 col-form-label">Status</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="status_pengajuan_terakhir" name="status_pengajuan_terakhir" disabled value="{{ $pengajuanDeveloper->tlu_status_pengajuan_developer->nama_status }} ({{ $pengajuanDeveloper->tlu_status_pengajuan_developer->keterangan }})">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <form id="tambah-invoice" name="tambah-invoice" method="post" action="{{ route('konsultan.simpanInvoiceKonsultan') }}" class="{{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
                @csrf    
                    <div class="card ribbon-box">
                        <div class="card-body">
                            <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Invoice Header</div>
                            <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                            <div class="ribbon-content">
                                
                                @php

                                    $oldNoInvoiceValue = old('no_invoice');
                                    $msgErrNoInvoice = "";
                                    if ($errors->has('no_invoice') && !empty($oldNoInvoiceValue)) {
                                        $msgErrNoInvoice = "\"".$oldNoInvoiceValue."\"";
                                        $oldNoInvoiceValue = "";
                                    }                    

                                    $oldNamaPerusahaanValue = old('nama_perusahaan', $pengajuanDeveloper->developer->nama_perusahaan);
                                    $msgErrNamaPerusahaan = "";
                                    if ($errors->has('nama_perusahaan') && !empty($oldNamaPerusahaanValue)) {
                                        $msgErrNamaPerusahaan = "\"".$oldNamaPerusahaanValue."\"";
                                        $oldNamaPerusahaanValue = "";
                                    }

                                    $oldNoTelponValue = old('no_telpon', $pengajuanDeveloper->developer->no_hp);
                                    $msgErrNoTelpon = "";
                                    if ($errors->has('no_telpon') && !empty($oldNoTelponValue)) {
                                        $msgErrNoTelpon = "\"".$oldNoTelponValue."\"";
                                        $oldNoTelponValue = "";
                                    }

                                    $oldNamaValue = old('nama', $pengajuanDeveloper->developer->nama_direktur);
                                    $msgErrNama = "";
                                    if ($errors->has('nama') && !empty($oldNamaValue)) {
                                        $msgErrNama = "\"".$oldNamaValue."\"";
                                        $oldNamaValue = "";
                                    }                            

                                    $oldAlamatValue = old('alamat', $pengajuanDeveloper->developer->alamat);
                                    $msgErrAlamat = "";
                                    if ($errors->has('alamat') && !empty($oldAlamatValue)) {
                                        $msgErrAlamat = "\"".$oldAlamatValue."\"";
                                        $oldAlamatValue = "";
                                    }

                                    $oldNpwpValue = old('npwp');
                                    $msgErrNpwp = "";
                                    if ($errors->has('npwp') && !empty($oldNpwpValue)) {
                                        $msgErrNpwp = "\"".$oldNpwpValue."\"";
                                        $oldNpwpValue = "";
                                    }

                                    $oldKtpnikValue = old('ktp_nik');
                                    $msgErrKtpnik = "";
                                    if ($errors->has('ktp_nik') && !empty($oldKtpnikValue)) {
                                        $msgErrKtpnik = "\"".$oldKtpnikValue."\"";
                                        $oldKtpnikValue = "";
                                    }

                                    $oldEmailValue = old('email');
                                    $msgErrEmail = "";
                                    if ($errors->has('email') && !empty($oldEmailValue)) {
                                        $msgErrEmail = "\"".$oldEmailValue."\"";
                                        $oldEmailValue = "";
                                    }

                                    $oldReferensiValue = old('referensi');
                                    $msgErrReferensi = "";
                                    if ($errors->has('referensi') && !empty($oldReferensiValue)) {
                                        $msgErrReferensi = "\"".$oldReferensiValue."\"";
                                        $oldReferensiValue = "";
                                    }

                                    $oldNoReferensiValue = old('no_referensi');
                                    $msgErrNoReferensi = "";
                                    if ($errors->has('no_referensi') && !empty($oldNoReferensiValue)) {
                                        $msgErrNoReferensi = "\"".$oldNoReferensiValue."\"";
                                        $oldNoReferensiValue = "";
                                    }

                                    $oldKeteranganValue = old('keterangan');
                                    $msgErrKeterangan = "";
                                    if ($errors->has('keterangan') && !empty($oldKeteranganValue)) {
                                        $msgErrKeterangan = "\"".$oldKeteranganValue."\"";
                                        $oldKeteranganValue = "";
                                    }

                                @endphp


                                <div class="row mb-3">
                                    <label for="no_invoice" class="col-lg-3 col-xl-3 col-form-label">Invoice Number </label>
                                    <div class="col-lg-6 col-xl-6">
                                        <input type="text" class="form-control" id="no_invoice" name="no_invoice" placeholder="" @error('no_invoice') required @enderror value="{{ $oldNoInvoiceValue }}" >
                                        @error('no_invoice')
                                            <div class="invalid-feedback">
                                            {{ $msgErrNoInvoice.' '.$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="invoice_date" class="col-lg-3 col-xl-3 col-form-label">Invoice Date</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <input class="form-control" type="date" id="invoice_date" name="invoice_date" >
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="invoice_due_date" class="col-lg-3 col-xl-3 col-form-label">Due Date</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <input class="form-control" type="date" id="invoice_due_date" name="invoice_due_date" >
                                    </div>
                                </div>                    

                                <div class="row mb-3">
                                    <label for="nama_perusahaan" class="col-lg-3 col-xl-3 col-form-label">Nama Perusahaan</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="" @error('nama_perusahaan') required @enderror value="{{ $oldNamaPerusahaanValue }}" >
                                        @error('nama_perusahaan')
                                            <div class="invalid-feedback">
                                            {{ $msgErrNamaPerusahaan.' '.$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>    

                                <div class="row mb-3">
                                    <label for="no_telpon" class="col-lg-3 col-xl-3 col-form-label">Kontak/Telpon</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <input type="text" class="form-control" id="no_telpon" name="no_telpon" placeholder="" @error('no_telpon') required @enderror value="{{ $oldNoTelponValue }}" >
                                        @error('no_telpon')
                                            <div class="invalid-feedback">
                                            {{ $msgErrNoTelpon.' '.$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nama" class="col-lg-3 col-xl-3 col-form-label">Nama</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="" @error('nama') required @enderror value="{{ $oldNamaValue }}" >
                                        @error('nama')
                                            <div class="invalid-feedback">
                                            {{ $msgErrNama.' '.$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="alamat" class="col-lg-3 col-xl-3 col-form-label">Alamat</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <textarea class="form-control" placeholder="" id="alamat" name="alamat" rows="5">{{ $oldAlamatValue }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                            {{ $msgErrAlamat.' '.$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="npwp" class="col-lg-3 col-xl-3 col-form-label">NPWP</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <input type="text" class="form-control" id="npwp" name="npwp" placeholder="" @error('npwp') required @enderror value="{{ $oldNpwpValue }}" >
                                        @error('npwp')
                                            <div class="invalid-feedback">
                                            {{ $msgErrNpwp.' '.$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="ktp_nik" class="col-lg-3 col-xl-3 col-form-label">KTP/NIK</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <input type="text" class="form-control" id="ktp_nik" name="ktp_nik" placeholder="" @error('ktp_nik') required @enderror value="{{ $oldKtpnikValue }}" >
                                        @error('ktp_nik')
                                            <div class="invalid-feedback">
                                            {{ $msgErrKtpnik.' '.$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-lg-3 col-xl-3 col-form-label">Email</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="" @error('email') required @enderror value="{{ $oldEmailValue }}" >
                                        @error('email')
                                            <div class="invalid-feedback">
                                            {{ $msgErrEmail.' '.$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="referensi" class="col-lg-3 col-xl-3 col-form-label">Referensi</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <input type="text" class="form-control" id="referensi" name="referensi" placeholder="" @error('referensi') required @enderror value="{{ $oldEmailValue }}" >
                                        @error('referensi')
                                            <div class="invalid-feedback">
                                            {{ $msgErrReferensi.' '.$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="no_referensi" class="col-lg-3 col-xl-3 col-form-label">No. Referensi</label>
                                    <div class="col-lg-6 col-xl-6">
                                        <input type="text" class="form-control" id="no_referensi" name="no_referensi" placeholder="" @error('no_referensi') required @enderror value="{{ $oldNoReferensiValue }}" >
                                        @error('no_referensi')
                                            <div class="invalid-feedback">
                                            {{ $msgErrNoReferensi.' '.$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="keterangan" class="col-lg-3 col-xl-3 col-form-label">Keterangan</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <textarea class="form-control" placeholder="" id="keterangan" name="keterangan" rows="3">{{ $oldKeteranganValue }}</textarea>
                                        @error('keterangan')
                                            <div class="invalid-feedback">
                                            {{ $msgErrKeterangan.' '.$message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="card ribbon-box">
                        <div class="card-body">
                            <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Invoice Detail (Harga Jasa Per Blok Rumah)</div>
                            <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                            <div class="ribbon-content">
            
                                <div class="row mb-3">
                                    <label for="blok_rumah_diajukan" class="col-lg-3 col-xl-3 col-form-label">Blok rumah yang diajukan </label>
                                    <div class="col-lg-9 col-xl-9">
                                        <textarea class="form-control" placeholder="" id="blok_rumah_diajukan" name="blok_rumah_diajukan" rows="3" disabled >{{ $pengajuanDeveloper->blok_rumah }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="jml_blok_rumah_diajukan" class="col-lg-3 col-xl-3 col-form-label">Jumlah yang diajukan</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="jml_blok_rumah_diajukan" name="jml_blok_rumah_diajukan" disabled value="{{ $jmlBlokRumahDiajukan }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="blok_rumah_disetujui" class="col-lg-3 col-xl-3 col-form-label">Blok rumah yang disetujui </label>
                                    <div class="col-lg-9 col-xl-9">
                                        <textarea class="form-control" placeholder="" id="blok_rumah_disetujui" name="blok_rumah_disetujui" rows="3" disabled >{{ $blokRumahDisetujui }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="jml_blok_rumah_disetujui" class="col-lg-3 col-xl-3 col-form-label">Jumlah yang disetujui</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input type="text" class="form-control" id="jml_blok_rumah_disetujui" name="jml_blok_rumah_disetujui" disabled value="{{ $jmlBlokRumahDisetujui }}">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="harga_jasa" class="col-lg-3 col-xl-3 col-form-label">Harga jasa per unit (Rp.)</label>
                                    <div class="col-lg-4 col-xl-4">
                                        <input type="text" class="form-control" id="harga_jasa" name="harga_jasa" placeholder="" @error('harga_jasa') required @enderror value="" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                        @error('harga_jasa')
                                            <div class="invalid-feedback">
                                                {{-- $msgAddErrHargaJualPerUnit." ".$message --}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                @if ($pengajuanDeveloperDetails->count() > 0)

                                    <div class="row mb-3">
                                        <div class="col-lg-3 col-xl-3"></div>
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="form-check form-checkbox-success mb-2">
                                                <input type="checkbox" class="form-check-input" name="pilih_semua" @if (old('pilih_semua')) checked @endif value="1">
                                                <label class="form-check-label" for="customCheckcolor2">Pilih Semua</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">

                                        @php
                                            $index = 0;
                                        @endphp

                                        @foreach ($pengajuanDeveloperDetails as $data)
                                        
                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">

                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6 col-xl-6">
                                                        <div class="form-check form-checkbox-success mb-2">
                                                            <input type="checkbox" class="form-check-input blok_rumah_chk_box" name="blok_rumah_chk_box[]" value="{{ $data->id }}" @if (old('blok_rumah_inv.'.$index)) checked @endif>
                                                            <label class="form-check-label" for="customCheckcolor2">
                                                                {{ $data->blok_rumah }} 
                                                                @if ($denganApersi) 
                                                                
                                                                    @if ($data->tlu_sts_peng_blk_rmh_id == 21)
                                                                        {{ '(Ditolak DPD)' }}
                                                                    @elseif ($data->tlu_sts_peng_blk_rmh_id == 31)
                                                                        {{ '(Disetujui DPD)' }}
                                                                    @else
                                                                        {{ '(Menunggu persetujuan DPD)' }}
                                                                    @endif
                                                                
                                                                @else

                                                                    @if ($data->tlu_sts_peng_blk_rmh_id == 67)
                                                                        {{ '(Ditolak Konsultan)' }}
                                                                    @elseif ($data->tlu_sts_peng_blk_rmh_id == 71)
                                                                        {{ '(Disetujui Konsultan)' }}
                                                                    @else
                                                                        {{ '(Menunggu persetujuan Konsultan)' }}
                                                                    @endif

                                                                @endif
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 col-xl-3">
                                                        <input type="text" @if (old('blok_rumah_inv.'.$index)) '' @else style="display: none;" @endif class="form-control harga_jasa_satuan" id="harga_jasa_satuan" name="harga_jasa_satuan[]" placeholder="" @error('harga_jasa_satuan.'.$index) required @enderror value="{{ old('harga_jasa_satuan.'.$index) }}" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                                        @error('harga_jasa_satuan.'.$index)
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>                                        
                                                    
                                                </div>

                                            </div>  

                                        @php
                                            $index++;
                                        @endphp

                                        @endforeach
                                    </div>

                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="card widget-flat">
                        <div class="card-body">

                            <div id="newRow"></div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <input name="developer_id" type="hidden" value="{{ $pengajuanDeveloper->developer_id; }}">
                                    <input name="pengajuan_developer_id" type="hidden" value="{{ $pengajuanDeveloper->id; }}">
                                    @if ($pengajuanDeveloperDetails->count() > 0)
                                        <button type="button" id="simpan" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Simpan</button>
                                    @endif
                                </div>
                            </div>                

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->

                </form>
            @else            

                <div class="alert alert-danger" role="alert">
                    <i class="dripicons-wrong me-2"></i> Data pengajuan tidak ditemukan
                </div>


            @endif

        @endif


    </div>
</div>

@endsection

@push('scripts')

<script>
window.addEventListener('DOMContentLoaded', function() {
    $(function () {
        
        var dateNow = Date.now();
        // var invoiceDate = new Date(dateNow);
        // alert(invoiceDate.toDateString());
        var todayDate = new Date().toISOString().slice(0, 10);
        // alert(todayDate);

        var days = 3;
        var newDate = new Date(Date.now() + days * 24*60*60*1000);        
        newDate = newDate.toISOString().slice(0, 10);

        // $('.harga_jasa_satuan').hide();

        // alert(newDate);
        $('#invoice_date').val(todayDate);
        $('#invoice_due_date').val(newDate);

        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }                

        $(document).on('keyup', "#harga_jasa", function(event) {
            $('.harga_jasa_satuan').val($(this).val());
        });    

        $(document).on('change', ".blok_rumah_chk_box", function(event) {
            
            var index = $(".blok_rumah_chk_box").index(this);
            // alert(index);
            if ($(this).prop("checked")) {
                // alert('checked');
                $('.harga_jasa_satuan').eq(index).show();
            }else{
                // alert('unchecked');
                $('.harga_jasa_satuan').eq(index).hide();
                $('.harga_jasa_satuan').eq(index).attr('required', false); 
                $('.invalid-feedback').eq(index).remove();
            }

        });    
    
        $("input:checkbox[name=pilih_semua]").click(function(){
           
           $("input:checkbox[name='blok_rumah_chk_box[]']").prop('checked', $(this).prop('checked'));
            
            if ($(this).prop("checked")) {
                // alert('checked');
                $('.harga_jasa_satuan').show();
            }else{
                // alert('unchecked');
                $('.harga_jasa_satuan').hide();
            }            

        });

        // $('#tambah-invoice').submit(function() {    
        $('#simpan').click(function() {    
            // alert('simpan');
            // console.log($('input[name=blok_rumah_chk_box[]]').val());
            $('#newRow').empty();
            $("input:checkbox[name='blok_rumah_chk_box[]']").each(function() {
                // array.push($(this).val());
                // var checked = $(this).prop('checked');
                // alert($(this).val());
                
                var chkBoxVal = '';
                if ($(this).prop('checked')) {
                    chkBoxVal = $(this).val();
                }    
                var blokRmhInv = '<input id="blok_rumah_inv" name="blok_rumah_inv[]" type="hidden" value="' + chkBoxVal + '">'; 
                $('#newRow').append(blokRmhInv);
            
            });

            $('#tambah-invoice').submit();
            // return false;

        });


    });
});    
</script>

@endpush