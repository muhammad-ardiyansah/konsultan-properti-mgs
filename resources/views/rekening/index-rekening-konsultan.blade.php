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
                        <li class="breadcrumb-item active">Nomor Rekening</li>
                    </ol>
                </div>
                <h4 class="page-title">Nomor Rekening</h4>
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
                        <form id="cari-rekening" name="cari-rekening" method="get" action="{{ route('konsultan.indexRekeningKonsultan') }}">
                            <div class="row">
                                
                                <div class="col-lg-4 col-xl-4">

                                    <div class="mb-3">
                                        <label for="tlu_bank_id" class="form-label">Bank</label>
                                        <select class="form-control select2" name="tlu_bank_id" id="tlu_bank_id" data-toggle="select2" @error('tlu_bank_id') required @enderror >
                                            <option value="">[- Semua Bank -]</option>
                                            @foreach ($tluBanks as $id => $nama_bank)
                                                <option value="{{ $id }}" {{ $id == request()->get('tlu_bank_id') ? "selected" : "" }}>{{ $nama_bank }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
           
                                <div class="col-lg-4 col-xl-4">   
                                
                                    <div class="mb-3">
                                        <label for="no_rekening" class="form-label">Nomor Rekening</label>
                                        <input type="text" name="no_rekening" id="no_rekening" class="form-control" value="{{ request()->get('no_rekening') }}">
                                    </div>                                
                                    
                                </div>
                                <div class="col-lg-4 col-xl-4">
                                    
                                 <div class="mb-3">
                                        <label for="nama_pemilik_rekening" class="form-label">Nama Pemilik Rekening</label>
                                        <input type="text" name="nama_pemilik_rekening" id="nama_pemilik_rekening" class="form-control" value="{{ request()->get('nama_pemilik_rekening') }}">
                                    </div>

                                </div>                                
                                
                            </div>    

                            <div class="row">
                                <div class="col-12 text-end">
                                    <a href="{{ route('konsultan.indexRekeningKonsultan') }}" class="btn btn-warning btn-m ms-3"> Reset</a>
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

                        <div class="col-sm-12 col-md-12 text-end">
                            <a href="{{ route('konsultan.tambahRekeningKonsultan') }}" class="btn btn-primary btn-m ms-3"><i class="mdi mdi-plus"></i> Tambah Rekening</a>
                        </div>

                    </div>                

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

                    <div class="table-responsive">
                        <table id="scroll-horizontal-datatable" class="table table-hover w-100 wrap font-14">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bank</th>
                                    <th>Nomor Rekening</th>
                                    <th>Nama Pemilik Rekening</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tluNoRekenings as $key => $data) 
                                    <tr>
                                        <td>{{ $tluNoRekenings->firstItem() + $key }}</td>
                                        <td>{{ $data->tlu_bank->nama_bank; }}</td>
                                        <td>{{ $data->no_rekening; }}</td>
                                        <td>{{ $data->nama_pemilik_rekening; }}</td>
                                        <td class="table-action">
                                            <a href="{{ route('konsultan.editRekeningKonsultan', ['id' => $data->id]) }}" class="action-icon edit" title="edit"> <i class="mdi mdi-pencil"></i></a>
                                            <a href="{{ route('konsultan.deleteRekeningKonsultan', ['id'=> $data->id]) }}" class="action-icon delete" title="delete" > <i class="mdi mdi-delete"></i></a>

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

                    <form method="post" name="form-delete" id="form-delete">
                    @csrf
                    </form>                    

                    <div class="row mt-3">    
                        {{ $tluNoRekenings->links('vendor.pagination.custom') }}
                    </div>

                    @include('modals-dialog.modal-confirmation')


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
    
        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }            
        
        $(document).on('click', ".delete", function(event) {
            event.preventDefault();        
            // alert('delete');
            var title = "Konfirmasi penghapusan data";
            var index = $(".delete").index(this);
            var currentRow=$(this).closest("tr");
            var textDelete=currentRow.find("td:eq(2)").text() + ' ' + currentRow.find("td:eq(1)").text(); 
            
            $('.title-confirm').html(title);
            // $('.modal-content-confirm').html(index);
            $('#confirm-value').val($(this).attr('href'));
            // $('.modal-content-confirm').html($('#confirm-value').val());
            $('.modal-content-confirm').html('Apakah anda yakin akan menghapus No. Rekening '+ textDelete + ' ? ');
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

