@extends('konsultan.layouts.dash-konsultan-layout-horizontal')
@section('title','Konsultan Properti PT. Mitra Guntur Sarana')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Invoice</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('developer.indexInvoiceDeveloper') }}">List Invoice</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('developer.viewInvoiceDeveloper', ['id' => $invoiceHeader->id]) }}">View Invoice</a></li>
                    <li class="breadcrumb-item active">Konfirmasi</li>
                </ol>
            </div>
            <h4 class="page-title">View Invoice</h4>
        </div>
    </div>
</div>


@if (Session::get('success'))
<div class="alert alert-success" role="alert">
    <i class="dripicons-checkmark me-2"></i> {{ Session::get('success') }}  
</div>
@endif

<div class="row">
    <div class="col-12">

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

            <div class="card mb-1">
                <div class="card-header" id="headingSeven">
                    <h5 class="m-0">
                        <a class="custom-accordion-title collapsed d-block pt-1 pb-1"
                            data-bs-toggle="collapse" href="#collapseSeven" role="button"
                            aria-expanded="false" aria-controls="collapseSeven">
                            Info Pengajuan Blok Rumah
                        </a>
                    </h5>
                </div>
                <div id="collapseSeven" class="collapse multi-collapse">
                    <div class="card-body">

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

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">

                    <!-- Invoice Logo-->
                    <div class="clearfix">
                        <div class="float-start mb-3">
                            <img src="assets/images/logo-light.png" alt="" height="18">
                        </div>
                        <div class="float-end">
                            <h4 class="m-0 d-print-none">Invoice</h4>
                        </div>
                    </div>

                    <!-- Invoice Detail-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="float-end mt-3">
                                <p><h4>PT. Mitra Guntur Sarana</h4></p>
                                <p class="text-muted font-13">Ruko, Jalan Perintis Kemerdekaan No. 18A, RT. 004 RW 003 Kelurahan Kebon Kalapa, Kecamatan Bogor Tengah, Kota Bogor, Provinsi Jawa Barat, Kode Pos 16125</p>
                                <div class="text-muted font-13">Telpon&nbsp;: 0251-839 6066, 0251-839 6646</div>
                                <div class="text-muted font-13 mt-0">Email&nbsp;&nbsp;&nbsp;: mitrags001@gmail.com</div>
                                <div class="text-muted font-13">Npwp&nbsp;&nbsp;: 96.252.750.3-404.000</div>
                            </div>

                        </div><!-- end col -->
                        <div class="col-sm-5 offset-sm-2">
                            <div class="mt-3 float-sm-end">
                                <p class="font-13"><strong>Invoice Number: </strong>&nbsp;{{ $invoiceHeader->no_invoice }}</p>
                                <p class="font-13"><strong>Invoice Date: </strong>&nbsp;@format_tgl_dMY($invoiceHeader->invoice_date)</p>
                                <p class="font-13"><strong>Due Date: </strong>&nbsp;@format_tgl_dMY($invoiceHeader->invoice_due_date)</p>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>BILL TO</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <h6>Nama Perusahaan</h6>
                            <address>
                                {{ $invoiceHeader->nama_perusahaan }}
                            </address>
                        </div>

                        <div class="col-lg-4 col-xl-4">
                            <h6>Kontak/Telepon</h6>
                            <address>
                                {{ $invoiceHeader->no_telpon }}
                            </address>
                        </div>
            
                        <div class="col-lg-4 col-xl-4">
                            <h6>Nama</h6>
                            <address>
                                {{ $invoiceHeader->nama }}
                            </address>
                        </div>
                    </div>    
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <h6>Alamat</h6>
                            <address>
                                {{ $invoiceHeader->alamat }}
                            </address>
                        </div>

                        <div class="col-lg-4 col-xl-4">
                            <h6>NPWP/KTP</h6>
                            <address>
                                {{ $invoiceHeader->npwp }}
                                /
                                {{ $invoiceHeader->ktp_nik }}
                            </address>
                        </div>

                        <div class="col-lg-4 col-xl-4">
                            <h6>Email</h6>
                            <address>
                                {{ $invoiceHeader->email }}
                            </address>
                        </div>                        

                    </div>    
                    <!-- end row -->

                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <h6>Keterangan</h6>
                            <address>
                                {{ $invoiceHeader->keterangan }}
                            </address>
                        </div>

                        <div class="col-lg-4 col-xl-4">

                        </div>

                        <div class="col-lg-4 col-xl-4">

                        </div>                        

                    </div>    
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table mt-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Unit</th>
                                            <th>Qty</th>
                                            <th>Unit Price</th>
                                            <th class="text-end">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $no = 0;
                                            $subTotal = 0;
                                        @endphp

                                        @foreach ($invoiceDetailsGroupBy as $headers)  
                                            
                                            @php
                                                $no++;
                                                $blokRumah = 'Blok rumah ';
                                                $quantity = 0;
                                                $hargaSatuan = 0;
                                                $totalHarga = 0;
                                                $idx = 0;
                                            @endphp

                                            @foreach ($headers as $data)
                                                @php
                                                    $quantity++;
                                                    $idx++;
                                                    $blokRumah .= $data->pengajuan_developer_detail->blok_rumah;
                                                    if ($idx != count($headers)) {
                                                        $blokRumah .= ", ";
                                                    }
                                                    $hargaSatuan = $data->harga_satuan;
                                                    $totalHarga += $data->harga_satuan;
                                                @endphp
                                            @endforeach
                                        
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>
                                                    <b>{{ $blokRumah }}</b> <br/>
                                                </td>
                                                <td>{{ $quantity }}</td>
                                                <td>@format_rupiah_tanpa_rp($hargaSatuan)</td>
                                                <td class="text-end">@format_rupiah_tanpa_rp($totalHarga)</td>
                                            </tr>                                            
                                        
                                            @php
                                                $subTotal += $totalHarga;            
                                            @endphp
                                        @endforeach   

                                        @php
                                            $total = $subTotal + $invoiceHeader->kode_unik;
                                        @endphp                                        

                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="clearfix pt-3">
                                <h6 class="text-muted">Notes:</h6>
                                <small>
                                    Bank Transfer:
                                    <ul class="list-group">
                                        @foreach ($tluNoRekenings as $noRekening)
                                            <li class="list-group-item"><i class="mdi mdi-bank-transfer"></i> 
                                            {{ $noRekening->tlu_bank->nama_bank }}, No. Rek {{ $noRekening->no_rekening }} a.n.  {{ $noRekening->nama_pemilik_rekening }}
                                            </li>
                                        @endforeach
                                    </ul>
                                                
                                </small>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-sm-6">
                            <div class="float-end mt-3 mt-sm-0">
                                <p><b>Subtotal(Rp.):</b>&nbsp;<span class="float-end"><b>@format_rupiah_tanpa_rp($subTotal)</b></span></p>
                                <p><b>Kode Admin:</b> <span class="float-end"><b>@format_rupiah_tanpa_rp($invoiceHeader->kode_unik)</b></span></p>
                                <p><b>Total Transfer(Rp.):</b>&nbsp; <span class="float-end"><b>@format_rupiah_tanpa_rp($total)</b></span></p>
                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row-->

                </div> <!-- end card-body-->
            </div> <!-- end card -->

            <form id="tambah-konfirmasi-pembayaran" name="tambah-konfirmasi-pembayaran" method="post" action="{{ route('developer.simpanKonfirmasiDeveloper') }}" class="{{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
                @csrf    
                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Konfirmasi Pembayaran</div>
                        <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                        <div class="ribbon-content">
                            
                            @php
                                $oldTluNoRekeningIdValue = old('tlu_no_rekening_id');
                                $msgErrTluNoRekeningId = "";
                                if ($errors->has('tlu_no_rekening_id') && !empty($oldTluNoRekeningIdValue)) {
                                    $msgErrTluNoRekeningId = "\"".$oldTluNoRekeningIdValue."\"";
                                    $oldTluNoRekeningIdValue = "";
                                }                    

                                $oldBankPengirimValue = old('bank_pengirim');
                                $msgErrBankPengirim = "";
                                if ($errors->has('bank_pengirim') && !empty($oldBankPengirimValue)) {
                                    $msgErrBankPengirim = "\"".$oldBankPengirimValue."\"";
                                    $oldBankPengirimValue = "";
                                }

                                $oldNoRekeningPengirimValue = old('no_rekening_pengirim');
                                $msgErrNoRekeningPengirim = "";
                                if ($errors->has('no_rekening_pengirim') && !empty($oldNoRekeningPengirimValue)) {
                                    $msgErrNoRekeningPengirim = "\"".$oldNoRekeningPengirimValue."\"";
                                    $oldNoRekeningPengirimValue = "";
                                }

                                $oldNamaPemilikRekeningPengirimValue = old('nama_pemilik_rekening_pengirim');
                                $msgErrNamaPemilikRekeningPengirim = "";
                                if ($errors->has('nama_pemilik_rekening_pengirim') && !empty($oldNamaPemilikRekeningPengirimValue)) {
                                    $msgErrNamaPemilikRekeningPengirim = "\"".$oldNamaPemilikRekeningPengirimValue."\"";
                                    $oldNamaPemilikRekeningPengirimValue = "";
                                }

                                $oldBuktiTransferValue = old('bukti_transfer');
                                $msgErrBuktiTransfer = "";
                                if ($errors->has('bukti_transfer') && !empty($oldBuktiTransferValue)) {
                                    $msgErrBuktiTransfer = "\"".$oldBuktiTransferValue."\"";
                                    $oldBuktiTransferValue = "";
                                }                                

                                $oldJumlahKonfirmasiValue = old('jumlah_konfirmasi');
                                $msgErrJumlahKonfirmasi = "";
                                if ($errors->has('jumlah_konfirmasi') && !empty($oldJumlahKonfirmasiValue)) {
                                    $msgErrJumlahKonfirmasi = "\"".$oldJumlahKonfirmasiValue."\"";
                                    $oldJumlahKonfirmasiValue = "";
                                }

                            @endphp

                            <div class="row mb-3">
                                <label for="tlu_no_rekening_id" class="col-lg-3 col-xl-3 col-form-label">No. Rekening Tujuan</label>
                                <div class="col-lg-9 col-xl-9">    
                                    <select class="form-control select2" name="tlu_no_rekening_id" id="tlu_no_rekening_id" data-toggle="select2" @error('tlu_no_rekening_id') required @enderror >
                                    <option value="">[- Pilih No. Rekening Tujuan -]</option>
                                        @foreach ($tluNoRekenings as $noRekening)
                                            <option value="{{ $noRekening->id }}" {{ $noRekening->id == $oldTluNoRekeningIdValue ? "selected" : "" }}>{{ $noRekening->no_rekening }} {{ $noRekening->tlu_bank->nama_bank }} {{ $noRekening->nama_pemilik_rekening }}  </option>
                                        @endforeach
                                    </select>          
                                    @error('tlu_no_rekening_id')
                                        <div class="invalid-feedback">
                                            {{ $msgErrTluNoRekeningId.' '.$message }}
                                        </div>
                                    @enderror
                                </div>                      
                            </div>

                            <div class="row mb-3">
                                <label for="bank_pengirim" class="col-lg-3 col-xl-3 col-form-label">Nama Bank Pengirim </label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control" id="bank_pengirim" name="bank_pengirim" placeholder="" @error('bank_pengirim') required @enderror value="{{ $oldBankPengirimValue }}" >
                                    @error('bank_pengirim')
                                        <div class="invalid-feedback">
                                        {{ $msgErrBankPengirim.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_rekening_pengirim" class="col-lg-3 col-xl-3 col-form-label">No. Rekening Pengirim </label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control" id="no_rekening_pengirim" name="no_rekening_pengirim" placeholder="" @error('no_rekening_pengirim') required @enderror value="{{ $oldNoRekeningPengirimValue }}" >
                                    @error('no_rekening_pengirim')
                                        <div class="invalid-feedback">
                                        {{ $msgErrNoRekeningPengirim.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nama_pemilik_rekening_pengirim" class="col-lg-3 col-xl-3 col-form-label">Nama Pemilik Rekening </label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control" id="nama_pemilik_rekening_pengirim" name="nama_pemilik_rekening_pengirim" placeholder="" @error('nama_pemilik_rekening_pengirim') required @enderror value="{{ $oldNamaPemilikRekeningPengirimValue }}" >
                                    @error('nama_pemilik_rekening_pengirim')
                                        <div class="invalid-feedback">
                                        {{ $msgErrNamaPemilikRekeningPengirim.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tgl_transfer" class="col-lg-3 col-xl-3 col-form-label">Tanggal Transfer</label>
                                <div class="col-lg-6 col-xl-6">
                                    <input class="form-control" type="date" id="tgl_transfer" name="tgl_transfer" >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bukti_transfer" class="col-lg-3 col-xl-3 col-form-label">Bukti Transfer </label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="file" id="bukti_transfer" name="bukti_transfer" class="form-control" @error('bukti_transfer') required @enderror>
                                    @error('bukti_transfer')
                                        <div class="invalid-feedback">
                                        {{ $msgErrBuktiTransfer.' '.$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jumlah_konfirmasi" class="col-lg-3 col-xl-3 col-form-label">Jumlah Konfirmasi (Rp.)</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input type="text" class="form-control" id="jumlah_konfirmasi" name="jumlah_konfirmasi" placeholder="" @error('jumlah_konfirmasi') required @enderror value="{{ $oldJumlahKonfirmasiValue }}" data-toggle="input-mask" data-mask-format="000.000.000.000.000" data-reverse="true">
                                    @error('jumlah_konfirmasi')
                                        <div class="invalid-feedback">
                                            {{ $msgErrJumlahKonfirmasi." ".$message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

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
                                <button type="submit" id="simpan" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Simpan</button>
                            </div>
                        </div>                

                    </div> <!-- end card-body-->
                </div> <!-- end card-->

            </form>

        </div>

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
        $('#tgl_transfer').val(todayDate);
       

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