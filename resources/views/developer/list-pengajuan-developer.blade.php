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
        <div class="card widget-flat">
            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-hover table-centered mb-10 table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%">No. </th>
                                <th style="width: 15%">@sortablelink('kode_pengajuan', 'Kode Pengajuan')</th>
                                <th style="width: 10%">Provinsi</th>
                                <th style="width: 10%">Nama Perusahaan</th>
                                <th style="width: 12%">@sortablelink('perumahan_developer.nama_perumahan', 'Nama Perumahan')</th>
                                <th style="width: 10%">@sortablelink('blok_rumah', 'Blok Rumah')</th>
                                <th style="width: 12%">Status</th>
                                <th style="width: 11%">@sortablelink('timestamp_pengajuan', 'Tanggal Pengajuan')</th>
                                <th style="width: 15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($pengajuanDevelopers as $key => $pengajuan) 
                            <tr>
                                <td>{{ $pengajuanDevelopers->firstItem() + $key }}</td>
                                <td>{{ $pengajuan->kode_pengajuan; }}</td>
                                <td>{{ $pengajuan->perumahan_developer->province->name; }}</td>
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

                {{-- $pengajuanDevelopers->links() --}}
                
                {{ $pengajuanDevelopers->links('vendor.pagination.custom') }}


            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

</div>

@endsection