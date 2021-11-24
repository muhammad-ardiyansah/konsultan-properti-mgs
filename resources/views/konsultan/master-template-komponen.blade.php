@extends('konsultan.layouts.dash-konsultan-layout-horizontal')
@section('title','Konsultan Properti PT. Mitra Guntur Sarana')

@section('content')

<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <div class="app-search">
                        <form id="cari" method="get" action="{{ route('konsultan.masterTemplateKomponenPemeriksaan') }}">
                            <div class="input-group">
                                <input type="text" name="nama_master"  value="{{ request()->get('nama_master') }}" class="form-control" placeholder="Cari..." />
                                <span class="mdi mdi-magnify search-icon"></span>
                                <button type="submit" class="btn btn-info"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <h4 class="page-title">Master Template <a href="{{ route('konsultan.tambahMasterTemplateKomponenPemeriksaan') }}" class="btn btn-success btn-sm ms-3">Tambah</a></h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">

            @if (Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <i class="dripicons-checkmark me-2"></i> {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::get('fail'))
            <div class="alert alert-danger" role="alert">
                <i class="dripicons-wrong me-2"></i> {{ Session::get('fail') }}
            </div>
            @endif

            <div class="card widget-flat">
                <div class="card-body">

                    <table class="table table-striped table-centered mb-10">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama Master</th>
                                <th>Propinsi Apersi</th>
                                <th>Aktif</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($tluMasterTemplates as $key => $masterTemplate) 
                            <tr>
                                <td>{{ $tluMasterTemplates->firstItem() + $key }}</td>
                                <td>{{ $masterTemplate->nama_master; }}</td>
                                <td>{{ $masterTemplate->province_code !== null ? $masterTemplate->province->name : '' }}</td>
                                <td>{{ $masterTemplate->aktif == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td class="table-action">
                                    <a href="{{ route('konsultan.editMasterTemplateKomponenPemeriksaan', ['id'=> $masterTemplate->id]) }}" class="action-icon edit" title="edit"> <i class="mdi mdi-pencil"></i></a>
                                    <a href="{{ route('konsultan.deleteMasterTemplateKomponenPemeriksaan', ['id'=> $masterTemplate->id]) }}" class="action-icon delete" title="delete" > <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9"> <div class="text-center">Belum ada data</div></td>
                            </tr>
                        @endforelse    
                        </tbody>
                    </table>        

                    {{ $tluMasterTemplates->links('vendor.pagination.custom') }}

                    @include('modals-dialog.modal-confirmation')

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>

</div>

@endsection

@push('scripts')

<script>
window.addEventListener('DOMContentLoaded', function() {
    $(function () {

        // $.ajaxSetup({
        //     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        // });        

        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

        $(document).on('click', ".delete", function(event) {
            event.preventDefault();        
            // alert('delete');
            var title = "Konfirmasi penghapusan data";
            var index = $(".delete").index(this);
            var currentRow=$(this).closest("tr");
            var textDelete=currentRow.find("td:eq(1)").text(); 
            
            $('.title-confirm').html(title);
            // $('.modal-content-confirm').html(index);
            $('#confirm-value').val($(this).attr('href'));
            // $('.modal-content-confirm').html($('#confirm-value').val());
            $('.modal-content-confirm').html('Apakah anda yakin akan menghapus data "'+ textDelete + '"');
            $("#confirm-modal").modal("show");
        });
        
        $(document).on('click', "#confirm-yes", function(event) {
            event.preventDefault();

            window.location.replace($('#confirm-value').val());

            // $.ajax({
            //     url: $('#confirm-value').val(),
            //     method: 'GET',
            //     headers: headers,
            //     success: function (response) {
            //         $("#modal-content").empty();
            //         $("#modal-content").html(response);                    

            //     },
            //     error: function(response) {
            //         console.log('error = ' + response);   
            //     }                
            // })            
        });        

    });
});

</script>
@endpush        

