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
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li> -->
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
                        <form>
                            <div class="row">
                                
                                <div class="col-lg-4 col-xl-4">

                                    <div class="mb-3">
                                        <label for="kode_pengajuan" class="form-label">Kode Pengajuan</label>
                                        <input type="text" name="kode_pengajuan" id="kode_pengajuan" class="form-control">
                                    </div>

                                </div>
                                <div class="col-lg-4 col-xl-4">                                

                                    <div class="mb-3">
                                        <label class="form-label">Periode Pengajuan</label>
                                        <input type="text" class="form-control date" id="singledaterange" data-toggle="date-picker" data-cancel-class="btn-warning">
                                    </div>

                                </div>
                                <div class="col-lg-4 col-xl-4">

                                    <label for="province_code_apersi" class="form-label">Pengajuan DPD Apersi</label>
                                    <select class="form-control select2" name="province_code_apersi" id="province_code_apersi" data-toggle="select2" @error('province_code_apersi') required @enderror >
                                        <option value="">[- Pilih Provinsi -]</option>
                                        @foreach ($provinces as $code => $name)
                                            <option value="{{ $code }}" {{ $code == old('province_code_apersi') ? "selected" : "" }}>{{ $name }}</option>
                                        @endforeach
                                    </select>

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
                                    
                                    <label for="show" class="col-sm-12 col-md-12 col-lg-2 col-form-label">Tampilkan</label>
                                    <div class="col-sm-12 col-md-12 col-lg-3">

                                        <select class="form-select" name="complex-header-datatable_length">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>                                 

                                    </div>
                                    <label for="show" class="col-sm-12 col-md-12 col-lg-3 col-form-label">data per halaman</label>

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
                                        <td>{{ $pengajuan->blok_rumah; }}</td>
                                        <td>{{ $pengajuan->tlu_status_pengajuan_developer->nama_status; }}</td>
                                        <td>{{ $pengajuan->timestamp_pengajuan; }}</td>
                                        <td class="table-action">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9"> <div class="text-center">Belum ada data</div></td>
                                    </tr>
                                @endforelse                        
                            </tbody>
                        </table>
                    </div>


                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->   

</div>

@endsection

@push('scripts')

@endpush

