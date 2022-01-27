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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Developer</a></li>
                        <li class="breadcrumb-item active">Registrasi Developer</li>
                    </ol>
                </div>
                <h4 class="page-title">Registrasi Developer</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">

            <div class="tab-content">

                <div class="tab-pane show active" id="bordered-tabs-preview">
                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="{{ route('konsultan.indexRegistrasiDeveloper', ['active'=>'developer']) }}" aria-expanded="@if ($developerTabActive) true @else false @endif" class="nav-link {{ $developerTabActive }}">
                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                <span class="d-none d-md-block">List Developer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('konsultan.indexRegistrasiDeveloper', ['active'=>'user']) }}" aria-expanded="@if ($userTabActive) true @else false @endif" class="nav-link {{ $userTabActive }}">
                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                <span class="d-none d-md-block">List User Developer</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="tab">

                            @if($developerTabActive)
                                @include('konsultan.sub-dev-index-registrasi-developer', ['datas' => $datas, 'provinces' => $provinces])
                            @endif

                            @if($userTabActive)
                                @include('konsultan.sub-dev-user-index-registrasi-developer', ['datas' => $datas])
                            @endif

                        </div>
                    </div>                                          
                </div> <!-- end preview-->

            </div> 

            <form method="post" name="form-delete" id="form-delete">
            @csrf
            </form>
            @include('modals-dialog.modal-confirmation')

        </div>
    </div>

</div>



@endsection

@push('scripts')

<script>
window.addEventListener('DOMContentLoaded', function() {
    $(function () {
    
        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }            
        
        $('#cari-developer').submit(function() {
            // alert($('#selectedValue').text());    
            $('#data_per_halaman').val($('#per_halaman_developer').val());
            // return false;
        });

        $('#per_halaman_developer').on('change', function () {
            // alert($(this).val());
            $('#cari-developer').submit();
        });

        $('#cari-user-developer').submit(function() {
            // alert($('#selectedValue').text());    
            $('#data_per_halaman').val($('#per_halaman_user').val());
            // return false;
        });

        $('#per_halaman_user').on('change', function () {
            // alert($(this).val());
            $('#cari-user-developer').submit();
        });


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
            $('.modal-content-confirm').html('Apakah anda yakin akan menghapus '+ textDelete + ' ? ');
            $("#confirm-modal").modal("show");
        });
        
        $(document).on('click', "#confirm-yes", function(event) {
            event.preventDefault();

            // window.location.replace($('#confirm-value').val());

            $('#form-delete').attr('action', $('#confirm-value').val());
            $('#form-delete').submit();
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
