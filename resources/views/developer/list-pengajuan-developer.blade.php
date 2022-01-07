@extends('developer.layouts.dash-developer-layout-horizontal')
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
                        <li class="breadcrumb-item active">List Pengajuan</li>
                    </ol>
                </div>
                <h4 class="page-title">List Pengajuan</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">


            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-success float-start"><i class="mdi mdi-access-point me-1"></i>Pencarian</div>
                    <h5 class="text-success float-end mt-0"><i class="mdi mdi-magnify-scan"></i></h5>
                    <div class="ribbon-content">   
                        <form id="cari-pengajuan" name="cari-pengajuan" method="get" action="{{ route('developer.listPengajuan') }}">
                            <div class="row">
                                
                                <div class="col-lg-4 col-xl-4">

                                    <div class="mb-3">
                                        <label for="kode_pengajuan" class="form-label">Kode Pengajuan</label>
                                        <input type="text" name="kode_pengajuan" id="kode_pengajuan" class="form-control" value="{{ request()->get('kode_pengajuan') }}">
                                    </div>

                                </div>
                                <div class="col-lg-4 col-xl-4">   
                                
                                    <label for="approval" class="form-label">Approval</label>
                                    <div class="mt mb-3">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="approval" name="approval" class="form-check-input" value="0" @if (request()->get('approval')==0) checked @endif>
                                            <label class="form-check-label" for="customRadio3">Semua Data</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="approval" name="approval" class="form-check-input" value="1" @if (request()->get('approval')==1) checked @endif >
                                            <label class="form-check-label" for="customRadio4">Tanpa Apersi</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="approval" name="approval" class="form-check-input" value="2" @if (request()->get('approval')==2) checked @endif>
                                            <label class="form-check-label" for="customRadio4">Apersi</label>
                                        </div>                                        
                                    </div>                                    
                                    
                                </div>
                                <div class="col-lg-4 col-xl-4">
                                    
                                    <div class="mb-3">
                                        <label for="province_code_apersi" class="form-label">Pengajuan DPD Apersi</label>
                                        <select class="form-control select2" name="province_code_apersi" id="province_code_apersi" data-toggle="select2" @error('province_code_apersi') required @enderror @if (request()->get('approval')!=2) disabled @endif>
                                            <option value="">[- Semua Provinsi -]</option>
                                            @foreach ($provinces as $code => $name)
                                                <option value="{{ $code }}" {{ $code == request()->get('province_code_apersi') ? "selected" : "" }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>                                
                                
                            </div>    
                            <div class="row">
                                <div class="col-lg-4 col-xl-4">                                

                                    <div class="mb-3">
                                        <label for="perumahan_developer_id" class="form-label">Perumahan</label>
                                        <select class="form-control select2" name="perumahan_developer_id" id="perumahan_developer_id" data-toggle="select2" @error('perumahan_developer_id') required @enderror >
                                            <option value="">[- Semua Perumahan -]</option>
                                            @foreach ($perumahanDevelopers as $id => $nama_perumahan)
                                                <option value="{{ $id }}" {{ $id == request()->get('perumahan_developer_id') ? "selected" : "" }}>{{ $nama_perumahan }}</option>
                                            @endforeach
                                        </select>                                
                                    </div>

                                </div>
                                <div class="col-lg-4 col-xl-4">                                
                                    <div class="mb-3">
                                        <label for="blok_rumah" class="form-label">Blok Rumah</label>
                                        <input type="text" name="blok_rumah" id="blok_rumah" class="form-control" placeholder="Pisahkan dengan koma bila blok lebih dari 1" value="{{ request()->get('blok_rumah') }}">
                                    </div>                                
                                </div>
                                <div class="col-lg-4 col-xl-4">                                
                                
                                    <div class="mb-3">
                                        <label for="status_pengajuan" class="form-label">Status Pengajuan</label>
                                        <select class="form-control select2" name="status_pengajuan" id="status_pengajuan" data-toggle="select2" @error('status_pengajuan') required @enderror >
                                            <option value="">[- Semua Status -]</option>
                                            @foreach ($statusPengajuanLists as $id => $nama_status)
                                                <option value="{{ $id }}" {{ $id == request()->get('status_pengajuan') ? "selected" : "" }}>{{ $nama_status }}</option>
                                            @endforeach
                                        </select>                                
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-xl-4">                                
                                
                                    <div class="mb-3">
                                        <label class="form-label">Periode Pengajuan</label>
                                        <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#selectedValue"  data-cancel-class="btn-light">
                                            <i class="mdi mdi-calendar"></i>&nbsp;
                                            <span id="selectedValue">{{ request()->get('periode_pengajuan') }}</span> <i class="mdi mdi-menu-down"></i>
                                            <input name="periode_pengajuan" id="periode_pengajuan" type="hidden" value="{{ request()->get('periode_pengajuan') }}">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-4 col-xl-4">                                
                                
                                </div>
                                <div class="col-lg-4 col-xl-4">                                
                                
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-12 text-end">
                                    <input name="developer_id" id="developer_id" type="hidden" value="{{ $developerId; }}">
                                    <input name="data_per_halaman" id="data_per_halaman" type="hidden" value="{{ request()->get('data_per_halaman') }}">
                                    <a href="{{ route('developer.listPengajuan') }}" class="btn btn-warning btn-m ms-3"> Reset</a>
                                    <button type="Submit" class="btn btn-success"><i class="mdi mdi-magnify-scan"></i> Cari Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>        

        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-sm-12 col-md-6">

                            <form class="form-horizontal">
                                <div class="row ms-1">
                                    
                                    <label for="show" class="col-sm-12 col-md-12 col-lg-3 col-xl-3 col-form-label">Tampilkan</label>
                                    <div class="col-sm-12 col-md-12 col-lg-3">

                                        <select class="form-select" id="per_halaman" name="per_halaman">
                                            @foreach ($perPageLists as $id => $per_page)
                                                <option value="{{ $id }}" {{ $id == request()->get('data_per_halaman') ? "selected" : "" }}>{{ $per_page }}</option>
                                            @endforeach
                                        </select>                                 

                                    </div>
                                    <label for="show" class="col-sm-12 col-md-12 col-lg-3 col-xl-4 col-form-label">data per halaman</label>

                                </div>
                            </form>         

                        </div>
                        <div class="col-sm-12 col-md-6 text-end">
                            <a href="{{ route('developer.formPengajuan') }}" class="btn btn-primary btn-m ms-3"><i class="mdi mdi-plus"></i> Buat Pengajuan Baru</a>
                        </div>

                    </div>                


                    <div class="table-responsive">
                        <table id="scroll-horizontal-datatable" class="table w-100 wrap font-14">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>@sortablelink('kode_pengajuan', 'Kode Pengajuan')</th>
                                    <th>Pengajuan DPD Apersi</th>
                                    <th>Nama Developer</th>
                                    <th>@sortablelink('perumahan_developer.nama_perumahan', 'Nama Perumahan')</th>
                                    <th style="width: 10%">@sortablelink('blok_rumah', 'Blok Rumah')</th>
                                    <th>Status</th>
                                    <th>@sortablelink('timestamp_pengajuan', 'Tanggal Pengajuan')</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengajuanDevelopers as $key => $pengajuan) 
                                    <tr>
                                        <td>{{ $pengajuanDevelopers->firstItem() + $key }}</td>
                                        <td>{{ $pengajuan->kode_pengajuan; }}</td>
                                        <td>{{ $pengajuan->province_apersi->name; }}</td>
                                        <td>{{ $pengajuan->developer->nama_perusahaan; }}</td>
                                        <td>{{ $pengajuan->perumahan_developer->nama_perumahan; }}</td>
                                        <td>@baris_baru_stlh_9_chr($pengajuan->blok_rumah)</td>
                                        <td>{{ $pengajuan->tlu_status_pengajuan_developer->nama_status; }}</td>
                                        <td>{{ $pengajuan->timestamp_pengajuan; }}</td>
                                        <td class="table-action">
                                            <a href="{{ route('developer.detailPengajuan', ['id' => $pengajuan->id]) }}" class="action-icon view" title="Lihat detail"> <i class="mdi mdi-eye"></i></a> 
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9"> <div class="text-center">Tidak ada data</div></td>
                                    </tr>
                                @endforelse                        
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3">    
                        {{ $pengajuanDevelopers->links('vendor.pagination.custom') }}
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->   

</div>

@endsection

@push('scripts')

<script>
window.addEventListener('DOMContentLoaded', function() {
    $(function () {
    
        // $(document).on('change', "#selectedValue", function(event) {            
        // $('#selectedValue').on('DOMSubtreeModified', function () {
        //     alert($(this).text());
        //     // $('#periode_pengajuan').val($(this).text());    
        // });            
    
        $('input[type=radio][name=approval]').change(function() {
            // alert($(this).val());
            if ($(this).val()==2) {
                $('#province_code_apersi').prop("disabled", false);
            }else{
                $('#province_code_apersi').prop("disabled", true);
            }
        });

        $('#cari-pengajuan').submit(function() {
            // alert($('#selectedValue').text());    
            $('#periode_pengajuan').val($('#selectedValue').text());
            $('#data_per_halaman').val($('#per_halaman').val());
            // return false;
        });

        $('#per_halaman').on('change', function () {
            // alert($(this).val());
            $('#cari-pengajuan').submit();
        });    

    
    });
});    
</script>

@endpush

