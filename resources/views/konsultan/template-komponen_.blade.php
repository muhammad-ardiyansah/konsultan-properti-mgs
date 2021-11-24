@extends('konsultan.layouts.dash-konsultan-layout')
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
                <h4 class="page-title">Template Komponen Pemeriksaan <a href="{{ route('konsultan.tambahTemplateKomponenPemeriksaan') }}" class="btn btn-success btn-sm ms-3">Tambah</a></h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">


        <div class="card">
            <div class="card-header">Categories</div>
            <div class="card-body">
                @foreach($templateKomponenPemeriksaans as $templateKomponen)
                    <ul>
                        <li>{{ $templateKomponen->no_komponen_pemeriksaan }} {{ $templateKomponen->nama_komponen_pemeriksaan }}</li>
                        @if(count($templateKomponen->subtemplatekomponen))
                            @include('konsultan.sub-template-komponen_', ['subtemplatekomponens' => $templateKomponen->subtemplatekomponen])
                        @endif 
                    </ul>
                @endforeach
            </div>
        </div>        


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

