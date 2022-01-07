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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoice</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('konsultan.indexInvoiceKonsultan') }}">List Invoice</a></li>
                        <li class="breadcrumb-item active">Invoice Pengajuan</li>
                    </ol>
                </div>
                <h4 class="page-title">Invoice Pengajuan</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">

        @if (Session::get('success'))
        <div class="alert alert-success" role="alert">
            <i class="dripicons-checkmark me-2"></i> {{ Session::get('success') }} </a> 
        </div>
        @endif

        @if (Session::get('fail'))
        <div class="alert alert-danger" role="alert">
            <i class="dripicons-wrong me-2"></i> {{ Session::get('fail') }}
        </div>
        @endif

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Info Data Developer</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                    <div class="ribbon-content">

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

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Info Data Administrasi</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                    <div class="ribbon-content">

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

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Info Data Perumahan</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                    <div class="ribbon-content">   

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

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i> Info Pengawas</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                    <div class="ribbon-content">  

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
                </div> <!-- end card-body -->
            </div> <!-- end card-->          

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Info Wilayah Pengajuan Apersi</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                    <div class="ribbon-content">

                        <div class="row mb-3">
                            <label for="dpd_apersi" class="col-lg-3 col-xl-3 col-form-label">Provinsi</label>
                            <div class="col-lg-9 col-xl-9">
                                <input type="text" class="form-control" id="dpd_apersi" name="dpd_apersi" disabled value="{{ $pengajuanDeveloper->province_apersi->name }}">
                            </div>
                        </div>                        
    
                    </div>
                </div>
            </div>    

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Info Status Pengajuan Terakhir</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                    <div class="ribbon-content">

                        <div class="row mb-3">
                            <label for="status_pengajuan_terakhir" class="col-lg-3 col-xl-3 col-form-label">Status</label>
                            <div class="col-lg-9 col-xl-9">
                                <input type="text" class="form-control" id="status_pengajuan_terakhir" name="status_pengajuan_terakhir" disabled value="{{ $pengajuanDeveloper->tlu_status_pengajuan_developer->nama_status }} ({{ $pengajuanDeveloper->tlu_status_pengajuan_developer->keterangan }})">
                            </div>
                        </div>                        
    
                    </div>
                </div>
            </div>

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Invoice</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                    <div class="ribbon-content">
                        
                        @php

                            $oldNamaPerusahaanValue = old('nama_perusahaan');
                            $msgErrNamaPerusahaan = "";
                            if ($errors->has('nama_perusahaan') && !empty($oldNamaPerusahaanValue)) {
                                $msgErrNamaPerusahaan = "\"".$oldNamaPerusahaanValue."\"";
                                $oldNamaPerusahaanValue = "";
                            }

                            $oldNoTelponValue = old('no_telpon');
                            $msgErrNoTelpon = "";
                            if ($errors->has('no_telpon') && !empty($oldNoTelponValue)) {
                                $msgErrNoTelpon = "\"".$oldNoTelponValue."\"";
                                $oldNoTelponValue = "";
                            }

                            $oldNamaValue = old('nama');
                            $msgErrNama = "";
                            if ($errors->has('nama') && !empty($oldNamaValue)) {
                                $msgErrNama = "\"".$oldNamaValue."\"";
                                $oldNamaValue = "";
                            }                            

                            $oldAlamatValue = old('alamat');
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

                        @endphp


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
                            <label for="referensi" class="col-lg-3 col-xl-3 col-form-label">Email</label>
                            <div class="col-lg-6 col-xl-6">
                                <input type="text" class="form-control" id="referensi" name="referensi" placeholder="" @error('referensi') required @enderror value="{{ $oldEmailValue }}" >
                                @error('referensi')
                                    <div class="invalid-feedback">
                                    {{ $msgErrEmail.' '.$message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-success float-start"><i class="mdi mdi-access-point me-1"></i>Filtering Blok Rumah</div>
                    <h5 class="text-success float-end mt-0"><i class="mdi mdi-filter-menu"></i></h5>
                    <div class="ribbon-content">
                        <form id="filter-blok-rumah" name="filter-blok-rumah" method="get" action="{{ route('konsultan.laporanPengajuan') }}">


                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="blok_rumah" class="form-label">Pisahkan dengan koma bila ingin memfilter lebih dari satu blok rumah</label>
                                    <input type="text" name="blok_rumah" id="blok_rumah" class="form-control" value="{{ request()->get('blok_rumah') }}">
                                </div>
                            </div>                       

                            <div class="row">
                                <div class="col-12 text-end">
                                    <input name="id" id="id" type="hidden" value="{{ $pengajuanDeveloper->id }}">
                                    <a href="{{ route('konsultan.laporanPengajuan', ['id' => $pengajuanDeveloper->id]) }}" class="btn btn-warning btn-m ms-3"> Reset</a>
                                    <button type="Submit" class="btn btn-success"><i class="mdi mdi-filter-menu"></i> Filter Blok</button>
                                </div>
                            </div>                   
                        
                        </form>    
                    </div>
                </div>
            </div>            

        <div class="row">

            @php
                $index = 0;
            @endphp

            @foreach ($pengajuanDeveloperDetails as $data)
                <div class="col-lg-6 col-xxl-3">
                    <!-- project card -->
                    <div class="card d-block">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-6 col-xl-6">
                                    <!-- project title-->
                                    <h4 class="mt-0">
                                        <a href="javascript:void(0);" class="text-title">Nama Blok : {{ $data->blok_rumah }}</a>
                                    </h4>

                                    @if (!empty($data->tlu_sts_peng_blk_rmh_id))
                                        @if (($data->tlu_sts_peng_blk_rmh_id === 21) || ($pengajuanDeveloper->tlu_sts_peng_blk_rmh_id === 41) || ($pengajuanDeveloper->tlu_sts_peng_blk_rmh_id === 67)) 
                                        <div class="badge bg-danger">
                                        @else
                                            <div class="badge bg-success">
                                        @endif
                                            {{ $data->tlu_status_pengajuan_blok_rumah->nama_status }} {{ $data->tlu_status_pengajuan_blok_rumah->role }}
                                        </div>
                                    @endif

                                </div>
                                <div class="col-lg-6 col-xl-6 text-end">
                                    <button type="button" class="btn btn-success"><i class="mdi mdi-plus"></i> Tambahkan ke invoice</button>
                                </div>
                            </div>                       

                            <h5 class="card-title mb-3 mt-4">Download Files (Blok Rumah {{ $data->blok_rumah }})</h5>
                            @php
                                $idFileBp2btApersi = App\Http\Controllers\HasilLaporanController::getIdHasilLaporan($data->pengajuan_developer_id, $data->id, 'BP2BT_APERSI');
                                $filenameBp2btApersi = App\Http\Controllers\HasilLaporanController::getFilenameHasilLaporan($data->pengajuan_developer_id, $data->id, 'BP2BT_APERSI');
                                
                                $idFileFlppApersi = App\Http\Controllers\HasilLaporanController::getIdHasilLaporan($data->pengajuan_developer_id, $data->id, 'FLPP_APERSI');
                                $filenameFlppApersi = App\Http\Controllers\HasilLaporanController::getFilenameHasilLaporan($data->pengajuan_developer_id, $data->id, 'FLPP_APERSI');

                                $idFileSimakSlfApersi = App\Http\Controllers\HasilLaporanController::getIdHasilLaporan($data->pengajuan_developer_id, $data->id, 'SIMAK_SLF_APERSI');
                                $filenameSimakSlfApersi = App\Http\Controllers\HasilLaporanController::getFilenameHasilLaporan($data->pengajuan_developer_id, $data->id, 'SIMAK_SLF_APERSI');                                
                            @endphp


                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col auto">
                                            <a href="javascript:void(0);" class="text-muted fw-bold">BP2BT APERSI</a>
                                            <p class="mb-0">@if ($filenameBp2btApersi) {{ $filenameBp2btApersi }} @endif</p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->

                                            @if ($filenameBp2btApersi)
                                            <a href="{{ url('hasil_laporan/'.$filenameBp2btApersi) }}" class="btn btn-link btn-lg text-muted">
                                                <i class="dripicons-download"></i>
                                            </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col auto">
                                            <a href="javascript:void(0);" class="text-muted fw-bold">FLPP APERSI</a>
                                            <p class="mb-0">@if ($filenameFlppApersi) {{ $filenameFlppApersi }} @endif</p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->

                                            @if ($filenameFlppApersi)
                                            <a href="{{ url('hasil_laporan/'.$filenameFlppApersi) }}" class="btn btn-link btn-lg text-muted">
                                                <i class="dripicons-download"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>                        

                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col auto">
                                            <a href="javascript:void(0);" class="text-muted fw-bold">SIMAK SLF APERSI</a>
                                            <p class="mb-0">@if ($filenameSimakSlfApersi) {{ $filenameSimakSlfApersi }} @endif</p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->

                                            @if ($filenameSimakSlfApersi)
                                            <a href="{{ url('hasil_laporan/'.$filenameSimakSlfApersi) }}" class="btn btn-link btn-lg text-muted">
                                                <i class="dripicons-download"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->    
                
                @php
                    $index++;
                @endphp
            
            @endforeach

        </div>


        </div>
    </div>

</div>

@include('modals-dialog.modal-warning')

@endsection

@push('scripts')

<script>
window.addEventListener('DOMContentLoaded', function() {
    $(function () {
    
        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }            

        $("input:checkbox[name=pilih_semua]").click(function(){
           
           $("input:checkbox[name=blok_rumah_chk_box]").prop('checked', $(this).prop('checked'));

       });        

        $('#jalankan-aksi').submit(function() {    

            if ($('#pilihan_status').val()) {
                // alert($('#pilihan_status').val());
                $(this).attr('action', $('#pilihan_status').val());

                // console.log($('input[name=blok_rumah_chk_box[]]').val());
                var array = [];
                $("input:checkbox[name=blok_rumah_chk_box]").each(function() {
                    // array.push($(this).val());
                    var checked = $(this).prop('checked');


                    // if ($(this).prop('checked')==true) $checked = 1;
                    array.push({
                        id: $(this).val(),
                        checked: checked,
                    });
                });
                $('#blok_rumah_approval').val(JSON.stringify(array));
                // $('#blok_rumah').val(array);
                // console.log($('#blok_rumah_approval').val());
                // return false;

            }else{
                $('.modal-content-warning').html('Anda belum memilih aksi yang akan dijalankan');
                $("#warning-alert-modal").modal("show");
                return false;
            }

        });        
    

    });
});    
</script>

@endpush

