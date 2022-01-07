@extends('konsultan.layouts.dash-konsultan-layout-horizontal')
@section('title','Konsultan Properti PT. Mitra Guntur Sarana')

@section('content')

<!-- <div class="container-fluid"> -->
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li> -->
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
                <h4 class="page-title">Laporan</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

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

    @if (count($errors) > 0)

        <div class="alert alert-danger">

            <div class="alert alert-danger" role="alert">
                <strong>Error Input - </strong> Mohon periksa kembali input file Anda
            </div>

            {{--
            <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach    

            </ul>
            --}}    

            {{-- $errors --}}    

        </div>

    @endif

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


    <form id="upload-form-all" name="upload-form-all" id="upload-form-all" method="post" action="{{ route('konsultan.uploadLaporanPengajuan') }}" enctype="multipart/form-data" class="{{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
    @csrf
        <div class="row">

            @php
                $index = 0;
            @endphp

            @foreach ($pengajuanDeveloperDetails as $data)
                <div class="col-lg-6 col-xxl-3">
                    <!-- project card -->
                    <div class="card d-block">
                        <div class="card-body">
                            <div class="dropdown card-widgets">
                                <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="dripicons-dots-3"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <!-- <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a> -->
                                    <!-- item-->
                                    <!-- <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a> -->
                                    <!-- item-->
                                    <!-- <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-email-outline me-1"></i>Invite</a> -->
                                    <!-- item-->
                                    <!-- <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a> -->
                                </div>
                            </div>
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
                            
                            <h5 class="card-title mt-3">Data Perumahan</h5>
                            
                            <div class="row mb-0 font-12">
                                <div class="col-lg-12 col-xl-12">
                                    <label for="kode_pengajuan" class="col-form-label">Kode Pengajuan</label>
                                    <input type="text" class="form-control" id="kode_pengajuan" name="kode_pengajuan" disabled value="{{ $pengajuanDeveloper->kode_pengajuan; }}">
                                </div>
                            </div>

                            <div class="row mb-0 font-12">
                                <div class="col-lg-12 col-xl-12">
                                    <label for="developer" class="col-form-label">Developer</label>
                                    <input type="text" class="form-control font-12" id="developer" name="developer" disabled value="{{ $pengajuanDeveloper->developer->nama_perusahaan; }}">
                                </div>
                            </div>
                            
                            <div class="row mb-0 font-12">
                                <div class="col-lg-12 col-xl-12">
                                    <label for="nama_perumahan" class="col-form-label">Nama Perumahan</label>
                                    <input type="text" class="form-control font-12" id="nama_perumahan" name="nama_perumahan" disabled value="{{ $pengajuanDeveloper->perumahan_developer->nama_perumahan; }}">
                                </div>
                            </div>                        

                            <div class="row mb-0 font-12">
                                <div class="col-lg-12 col-xl-12">
                                    <label for="provinsi" class="col-form-label">Provinsi</label>
                                    <input type="text" class="form-control font-12" id="provinsi" name="provinsi" disabled value="{{ $pengajuanDeveloper->perumahan_developer->province->name; }}">
                                </div>
                            </div>

                            <div class="row mb-0 font-12">
                                <div class="col-lg-12 col-xl-12">
                                    <label for="kabupaten_kota" class="col-form-label">Kabupaten/Kota</label>
                                    <input type="text" class="form-control font-12" id="kabupaten_kota" name="kabupaten_kota" disabled value="{{ $pengajuanDeveloper->perumahan_developer->city->name; }}">
                                </div>
                            </div>

                            <div class="row mb-0 font-12">
                                <div class="col-lg-12 col-xl-12">
                                    <label for="kecamatan" class="col-form-label">Kecamatan</label>
                                    <input type="text" class="form-control font-12" id="kecamatan" name="kecamatan" disabled value="{{ $pengajuanDeveloper->perumahan_developer->district->name; }}">
                                </div>
                            </div>

                            <div class="row mb-0 font-12">
                                <div class="col-lg-12 col-xl-12">
                                    <label for="desa" class="col-form-label">Desa</label>
                                    <input type="text" class="form-control font-12" id="desa" name="desa" disabled value="{{ $pengajuanDeveloper->perumahan_developer->village->name; }}">
                                </div>
                            </div>                        

                            @if ($pengajuanDeveloper->province_code_apersi)

                                <div class="row mb-0 font-12">
                                    <div class="col-lg-12 col-xl-12">
                                        <label for="dpd_apersi" class="col-form-label">Wilayah Pengajuan Apersi</label>
                                        <input type="text" class="form-control font-12" id="dpd_apersi" name="dpd_apersi" disabled value="{{ $pengajuanDeveloper->province_apersi->name; }}">
                                    </div>
                                </div>                        

                            @endif

                            <div class="row mb-0 font-12">
                                <div class="col-lg-12 col-xl-12">
                                    <label for="pengawas" class="col-form-label">Pengawas</label>
                                    <input type="text" class="form-control font-12" id="pengawas" name="pengawas" disabled value="{{ $pengajuanDeveloper->pengawas->nama_perusahaan; }}">
                                </div>
                            </div>

                            <div class="row mb-0 font-12">
                                <div class="col-lg-12 col-xl-12">
                                    <label for="penanggung_jawab_pengawas" class="col-form-label">Penanggung Jawab Pengawas</label>
                                    <input type="text" class="form-control font-12" id="penanggung_jawab_pengawas" name="penanggung_jawab_pengawas" disabled value="{{ $pengajuanDeveloper->pengawas->nama_direktur; }}">
                                </div>
                            </div>

                            <div class="row mb-0 font-12">
                                <div class="col-lg-12 col-xl-12">
                                    <label for="status_pengajuan_terakhir" class="col-form-label">Status Pengajuan Terakhir</label>
                                    <input type="text" class="form-control font-12" id="status_pengajuan_terakhir" name="status_pengajuan_terakhir" disabled value="{{ $pengajuanDeveloper->tlu_status_pengajuan_developer->nama_status }} ({{ $pengajuanDeveloper->tlu_status_pengajuan_developer->keterangan }})">
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

                            <h5 class="card-title mb-3 mt-4">Upload Files (Blok Rumah {{ $data->blok_rumah }})</h5>                        

                            @php
                                $bp2btErrorKey = "bp2bt_apersi.".$index;
                                $flppErrorKey = "flpp_apersi.".$index;
                                $simakSlfErrorKey = "simak_slf_apersi.".$index;
                            @endphp

                            <div class="mb-3 mt-3">
                                <input name="pengajuan_developer_id[]" type="hidden" value="{{ $data->pengajuan_developer_id; }}">
                                <input name="pengajuan_developer_detail_id[]" type="hidden" value="{{ $data->id; }}">
                                <input name="id_file_bp2bt_apersi[]" type="hidden" value="{{ $idFileBp2btApersi }}">
                                <input name="old_bp2bt_apersi[]" type="hidden" value="{{ $filenameBp2btApersi }}">
                                <label for="example-fileinput" class="form-label">BP2BT APERSI</label>
                                <input type="file" id="bp2bt_apersi" name="bp2bt_apersi[]" class="form-control" @error($bp2btErrorKey) required @enderror value="">
                                @error($bp2btErrorKey)
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input name="id_file_flpp_apersi[]" type="hidden" value="{{ $idFileFlppApersi }}">
                                <input name="old_flpp_apersi[]" type="hidden" value="{{ $filenameFlppApersi }}">
                                <label for="example-fileinput" class="form-label">FLPP APERSI</label>
                                <input type="file" id="flpp_apersi" name="flpp_apersi[]" class="form-control" @error($flppErrorKey) required @enderror>
                                @error($flppErrorKey)
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input name="id_file_simak_slf_apersi[]" type="hidden" value="{{ $idFileSimakSlfApersi }}">
                                <input name="old_simak_slf_apersi[]" type="hidden" value="{{ $filenameSimakSlfApersi }}">
                                <label for="example-fileinput" class="form-label">SIMAK SLF APERSI</label>
                                <input type="file" id="simak_slf_apersi" name="simak_slf_apersi[]" class="form-control" @error($simakSlfErrorKey) required @enderror>
                                @error($simakSlfErrorKey)
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror                            
                            </div>

                            <div class="row">
                                <div class="col-12 text-end">
                                    <button type="Submit" id="upload" class="btn btn-success upload"><i class="mdi mdi-upload"></i> Upload</button>
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

        <div class="row">
            <div class="col-12">
                <div class="card widget-flat">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 text-center">
                                <input name="blok_rumah_filter" type="hidden" value="{{ old('blok_rumah_filter', request()->get('blok_rumah')) }}">
                                <input name="first_index" id="first_index" type="hidden" value="0">
                                <input name="last_index" id="last_index" type="hidden" value="{{ $index - 1 }}">
                                <button type="Submit" id="upload-all" class="btn btn-success"><i class="mdi mdi-upload"></i> Upload Semua</button>
                            </div>
                        </div>                

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>

    </form>

    <form id="upload-form-satuan" name="upload-form-satuan" id="upload-form-satuan" method="post" action="{{ route('konsultan.uploadLaporanPengajuan') }}" enctype="multipart/form-data">
    @csrf
            

    </form>

<!-- </div> -->

@endsection

@push('scripts')

<script>
window.addEventListener('DOMContentLoaded', function() {
    $(function () {
    
        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }            
    
        $('.upload').on('click', function () {    
            var index = $(".upload").index(this);
            // alert(index);
            $('#first_index').val(index);
            $('#last_index').val(index);
        });    
    
    });
});    
</script>

@endpush
