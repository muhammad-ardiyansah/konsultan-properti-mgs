@extends('dpp.layouts.dash-dpp-layout-horizontal')
@section('title','Konsultan Properti PT. Mitra Guntur Sarana')

@section('content')

<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Developer</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pengajuan</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dpp.listPengajuan') }}">List Pengajuan</a></li>
                        <li class="breadcrumb-item active">Detail Pengajuan</li>
                    </ol>
                </div>
                <h4 class="page-title">Detail Pengajuan</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Data Developer</div>
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
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Data Administrasi</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                    <div class="ribbon-content">

                        <div class="row mb-3">
                            <label for="sertifikat_hak_atas_tanah" class="col-lg-3 col-xl-3 col-form-label">Sertifikat hak atas tanah</label>
                            <div class="col-lg-9 col-xl-9">
                                <input type="text" class="form-control" id="sertifikat_hak_atas_tanah" name="sertifikat_hak_atas_tanah" disabled value="{{ $pengajuanDeveloper->sertifikat_hak_atas_tanah }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="izin_pemanfataan_tanah" class="col-lg-3 col-xl-3 col-form-label">Izin pemanfataan tanah</label>
                            <div class="col-lg-9 col-xl-9">
                                <input type="text" class="form-control" id="izin_pemanfataan_tanah" name="izin_pemanfataan_tanah" disabled value="{{ $pengajuanDeveloper->izin_pemanfataan_tanah }}">
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
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Data Perumahan</div>
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

                        <div class="row mb-3">
                            <label for="persetujuan_pengajuan_blok_rumah" class="col-lg-6 col-xl-6 col-form-label">Status Persetujuan Pengajuan Blok Rumah :</label>
                            <div class="col-lg-6 col-xl-6">

                            </div>
                        </div>

                        <div class="row mb-3">
                            @foreach ($pengajuanDeveloperDetails as $data)
                            
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-2">

                                    <div class="form-check form-checkbox-success mb-2">
                                        <input type="checkbox" class="form-check-input" name="blok_rumah_chk_box" value="{{ $data->id }}" @if ($data->tlu_sts_peng_blk_rmh_id == 31) checked @endif disabled>
                                        <label class="form-check-label" for="customCheckcolor2">
                                            {{ $data->blok_rumah }} 
                                            @if ($data->tlu_sts_peng_blk_rmh_id == 21)
                                                {{ '(Ditolak DPD)' }}
                                            @elseif ($data->tlu_sts_peng_blk_rmh_id == 31)
                                                {{ '(Disetujui DPD)' }}
                                            @else
                                                {{ '(Menunggu persetujuan DPD)' }}
                                            @endif
                                        </label>
                                    </div>

                                </div>  

                            @endforeach
                        </div>


                    </div>
                </div>
            </div>        


            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i> Pengawas</div>
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
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Wilayah Pengajuan Apersi</div>
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
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Status Pengajuan Terakhir</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                    <div class="ribbon-content">

                        <div class="row mb-3">
                            <label for="dpd_apersi" class="col-lg-3 col-xl-3 col-form-label">Status</label>
                            <div class="col-lg-9 col-xl-9">
                                <input type="text" class="form-control" id="dpd_apersi" name="dpd_apersi" disabled value="{{ $pengajuanDeveloper->tlu_status_pengajuan_developer->nama_status }}">
                            </div>
                        </div>                        

                    </div>
                </div>
            </div>

            {{-- 
            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Aksi</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                    <div class="ribbon-content">
                        <div class="row">    

                            <div class="col-lg-12 col-xl-12">                        
                                <form id="jalankan-aksi" name="jalankan-aksi" method="post" action="">
                                @csrf   

                                    <div class="row mb-4">
                                        <div class="col-lg-12 col-xl-12">
                                            <label for="catatan" class="form-label">Catatan (bila diperlukan, berikan catatan untuk pengajuan ini terutama bila pengajuan ditolak)</label>
                                            <textarea class="form-control" placeholder="" id="catatan" name="catatan" rows="10"></textarea>
                                        </div>
                                    </div>                                


                                    <div class="row d-flex justify-content-center">

                                        <div class="col-lg-4 col-xl-4 mb-3">
                                        
                                            <select class="form-control select2" name="pilihan_status" id="pilihan_status" data-toggle="select2" >
                                            <option value="">[- Pilih Status -]</option>
                                                @foreach ($roleStatus as $status)
                                                    <option value="{{ route($status['route'], ['id_status' => $status['id_status']]) }}" data="{{ $status['id_status'] }}">{{ $status['text'] }}</option>
                                                @endforeach
                                            </select>          


                                        </div>

                                        <div class="col-lg-2 col-xl-2 mb-3">
                                            <input name="id" type="hidden" value="{{ $pengajuanDeveloper->id; }}">
                                            <input id="blok_rumah_approval" name="blok_rumah_approval" type="hidden" value="">
                                            <button type="Submit" class="btn btn-primary"><i class="mdi mdi-book-edit-outline"></i> Jalankan</button>
                                        </div>                  
                                    
                                    </div>
                                </form>    
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            --}}

            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Log Pengajuan</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-alt"></i></h5>
                    <div class="ribbon-content">

                        <div class="table-responsive">
                            <table id="scroll-horizontal-datatable" class="table table-hover w-100 wrap font-14">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($logPengajuanDevelopers as $key => $log) 
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $log->user->name; }}</td>
                                            <td>{{ $log->keterangan_status_peng_dev; }}</td>
                                            <td>{{ $log->catatan }}</td>
                                            <td>@format_tgl_dMYHis($log->created_at)</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9"> <div class="text-center">Tidak ada data</div></td>
                                        </tr>
                                    @endforelse                        
                                </tbody>
                            </table>
                        </div>                        

                    </div>
                </div>
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
                $(this).attr('action', $('#pilihan_status').val());
                // console.log($('input[name=blok_rumah_chk_box[]]').val());
                var array = [];
                $("input:checkbox[name=blok_rumah_chk_box]").each(function() {
                    // array.push($(this).val());
                    var checked = $(this).prop('checked');

                    id_status = 21;
                    if ($(this).prop('checked')) {
                        id_status = 31;
                    }
                    // if ($(this).prop('checked')==true) $checked = 1;
                    array.push({
                        blok_rumah: $(this).val(),
                        checked: checked,
                        id_status: id_status
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

