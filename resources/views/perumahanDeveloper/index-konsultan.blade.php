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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Perumahan</a></li>
                        <li class="breadcrumb-item active">List Perumahan</li>
                    </ol>
                </div>
                <h4 class="page-title">List Perumahan Developer</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div id="ajax-update">   
        <div class="row">
            <div class="col-12">


                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-success float-start"><i class="mdi mdi-access-point me-1"></i>Pencarian</div>
                        <h5 class="text-success float-end mt-0"><i class="mdi mdi-magnify-scan"></i></h5>
                        <div class="ribbon-content">   
                            <form id="cari-perumahan" name="cari-perumahan" method="get" action="{{ route('konsultan.listPerumahanDeveloper') }}">
                                <div class="row">
                                    
                                    <div class="col-lg-6 col-xl-6">

                                        <div class="mb-3">
                                            <label for="developer_id" class="form-label">Developer</label>
                                            <select class="form-control select2" name="developer_id" id="developer_id" data-toggle="select2" @error('developer_id') required @enderror >
                                                <option value="">[- Semua Developer -]</option>
                                                @foreach ($developers as $id => $nama_perusahaan)
                                                    <option value="{{ $id }}" {{ $id == request()->get('developer_id') ? "selected" : "" }}>{{ $nama_perusahaan }}</option>
                                                @endforeach
                                            </select>                                
                                        </div>

                                    </div>
                                    
                                    <div class="col-lg-6 col-xl-6">   
                                    
                                        <div class="mb-3">
                                            <label for="nama_perumahan" class="form-label">Nama Perumahan</label>
                                            <input type="text" name="nama_perumahan" id="nama_perumahan" class="form-control" value="{{ request()->get('nama_perumahan') }}">
                                        </div>                                    
                                        
                                    </div>                             
                                    
                                </div>    


                                <div class="row">
                                    <div class="col-12 text-end">
                                        <input name="data_per_halaman" id="data_per_halaman" type="hidden" value="{{ request()->get('data_per_halaman') }}">
                                        <a href="{{ route('konsultan.listPerumahanDeveloper') }}" class="btn btn-warning btn-m ms-3"> Reset</a>
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
                                <a href="javascript:void(0);" class="btn btn-primary btn-m ms-3" id="tambah-perumahan-developer"><i class="mdi mdi-plus"></i> Tambah Perumahan Developer</a>
                            </div>

                        </div>                

                        <div id="table-data">
                            <div class="table-responsive">
                                <table id="scroll-horizontal-datatable" class="table table-hover w-100 wrap font-14">
                                    <thead>
                                        <tr>
                                            <th>No. </th>
                                            <th>Developer</th>
                                            <th>Nama Perumahan</th>
                                            <th>Provinsi</th>
                                            <th>Kabupaten/Kota</th>
                                            <th>Kecamatan</th>
                                            <th>Desa</th>
                                            <th>Kampung</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($perumahanDevelopers as $key => $perumahan) 
                                        <tr>
                                            <td>{{ $perumahanDevelopers->firstItem() + $key }}</td>
                                            <td>{{ $perumahan->developer->nama_perusahaan; }}</td>
                                            <td>{{ $perumahan->nama_perumahan; }}</td>
                                            <td>{{ $perumahan->province->name; }}</td>
                                            <td>{{ $perumahan->city->name; }}</td>
                                            <td>{{ $perumahan->district->name; }}</td>
                                            <td>{{ $perumahan->village->name; }}</td>
                                            <td>{{ $perumahan->kampung; }}</td>
                                            <td>{{ $perumahan->alamat; }}</td>
                                            <td class="table-action">
                                                <input name="id[]" type="hidden" value="{{ $perumahan->id; }}">
                                                <a href="javascript:void(0);" class="action-icon edit" title="edit"> <i class="mdi mdi-pencil"></i></a>
                                                <a href="javascript:void(0);" class="action-icon delete" title="delete" > <i class="mdi mdi-delete"></i></a>
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
                            <div class="row mt-3">    
                                {{ $perumahanDevelopers->links('vendor.pagination.custom') }}
                            </div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div> <!-- end row-->   
    </div>

</div>

@include('modals-dialog.modal-static-full-width')
@include('modals-dialog.modal-confirmation')
@include('modals-dialog.modal-warning')

@endsection

@push('scripts')

<script>
window.addEventListener('DOMContentLoaded', function() {
    $(function () {
    
        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }            

        // $('#cari-perumahan').submit(function() {
        $(document).on('submit', "#cari_perumahan", function(event) {    
            $('#data_per_halaman').val($('#per_halaman').val());
            // return false;
        });

        // $('#per_halaman').on('change', function () {
        $(document).on('change', "#per_halaman", function(event) {    
            // alert($(this).val());
            $('#data_per_halaman').val($('#per_halaman').val());
            $('#cari-perumahan').submit();
        });    
        
        $('#developer_id').on('change', function () {
            // alert($(this).val());
            // $.ajax({
            //     url: "{{ route('konsultan.getPerumahanDevelopers') }}",
            //     method: 'GET',
            //     headers: headers,
            //     data: {developer_id: $(this).val()},
            //     success: function (response) {
            //         // console.log(response);
            //         $('#perumahan_developer_id').empty();

            //         $('#perumahan_developer_id').append(new Option('[- Semua Perumahan -]', ''));
            //         $.each(response, function (code, name) {
            //             $('#perumahan_developer_id').append(new Option(name, code))
            //             // alert(name);
            //         })
            //     },
            //     error: function(response) {
            //         console.log(response);   
            //     }                
            // })

        });

        $(document).on('change', "#province_code", function(event) {    
            // alert($(this).val());
            $.ajax({
                url: "{{ route('developer.getCities') }}",
                // url : "/dependent-dropdown/store",
                method: 'POST',
                headers: headers,
                data: {code: $(this).val()},
                success: function (response) {
                    // alert(response);
                    $('#city_code').empty();
                    $('#district_code').empty();
                    $('#village_code').empty();

                    $('#city_code').append(new Option('[- Pilih Kabupaten/Kota -]', ''));
                    $('#district_code').append(new Option('[- Pilih Kecamatan -]', ''));
                    $('#village_code').append(new Option('[- Pilih Desa/Kelurahan -]', ''));

                    $.each(response, function (code, name) {
                        $('#city_code').append(new Option(name, code))
                        // alert(name);
                    })
                },
                error: function(response) {
                    console.log(response);   
                }
            })            
        });

        // $('#city_code').on('change', function () {
        $(document).on('change', "#city_code", function(event) {    
            // alert($(this).val());
            $.ajax({
                url: "{{ route('developer.getDistricts') }}",
                // url : "/dependent-dropdown/store",
                method: 'POST',
                headers: headers,
                data: {code: $(this).val()},
                success: function (response) {
                    // alert(response);
                    $('#district_code').empty();
                    $('#village_code').empty();

                    $('#district_code').append(new Option('[- Pilih Kecamatan -]', ''));
                    $('#village_code').append(new Option('[- Pilih Desa/Kelurahan -]', ''));

                    $.each(response, function (code, name) {
                        $('#district_code').append(new Option(name, code))
                        // alert(name);
                    })
                },
                error: function(response) {
                    console.log(response);   
                }                
            })            
        });        

        // $('#district_code').on('change', function () {
        $(document).on('change', "#district_code", function(event) {            
            // alert($(this).val());
            $.ajax({
                url: "{{ route('developer.getVillages') }}",
                // url : "/dependent-dropdown/store",
                method: 'POST',
                headers: headers,
                data: {code: $(this).val()},
                success: function (response) {
                    // alert(response);
                    $('#village_code').empty();

                    $('#village_code').append(new Option('[- Pilih Desa/Kelurahan -]', ''));
                    $.each(response, function (code, name) {
                        $('#village_code').append(new Option(name, code))
                        // alert(name);
                    })
                },
                error: function(response) {
                    console.log(response);   
                }                
            })            
        });

        $(document).on('click', "#tambah-perumahan-developer", function(event) {
        // $('#tambah-perumahan-developer').on('click', function () {    
            if ($('#developer_id').val()) {

                var title = "{{ 'Tambah Perumahan '}}" + $('#developer_id option:selected').text();
                $.ajax({
                    url: "{{ route('konsultan.tambahPerumahanDeveloper') }}",
                    method: 'GET',
                    headers: headers,
                    data: {developer_id: $('#developer_id').val(), url_tambah: 'konsultan.tambahPerumahanDeveloper', url_list: 'konsultan.listPerumahanDeveloper'},
                    success: function (response) {
                        $("#staticBackdrop").modal("show");
                        // console.log(response);
                        $('.modal-title').html(title);
                        $("#modal-content").empty();
                        $("#modal-content").html(response);                    

                    },
                    error: function(response) {
                        console.log(response);   
                    }
                });
            
            }else{
                $('.modal-content-warning').html('Pilih dahulu developer pada bagian pencarian');
                $("#warning-alert-modal").modal("show");
            }

        });

        $(document).on('click', ".edit", function(event) {
        // $('.edit').on('click', function () {    
 
            event.preventDefault();
            var index = $(".edit").index(this);
            var id = $('input[name="id[]"]').eq(index).val();
            // alert(id);
            
            if ($('#developer_id').val()) {
                var title = 'Edit Perumahan ' + $('#developer_id option:selected').text();
            }else{
                var title = 'Edit Perumahan';
            }

            $.ajax({
                // url: $(this).attr('href'),
                url: "{{ route('konsultan.editPerumahanDeveloper') }}",
                method: 'GET',
                headers: headers,
                data: {id: id, url_edit: 'konsultan.editPerumahanDeveloper', url_list: 'konsultan.listPerumahanDeveloper'},
                success: function (response) {
                    $("#staticBackdrop").modal("show");
                    $('.modal-title').html(title);
                    $("#modal-content").empty();
                    $("#modal-content").html(response);                    

                },
                error: function(response) {
                    console.log(response);   
                }                
            })            
        });

        // $('#kembali').on('click', function () {    
        $(document).on('click', '#kembali', function () {            
            // alert('kembali');
            $("#staticBackdrop").modal("hide");
        });            

        $(document).on('submit', "#perumahan-developer-form", function(event) {
            // alert('submit');
            // alert($(this).attr("method"));

            $.ajax({
                // url: $(this).attr("action"),
                url: "{{ route('konsultan.simpanPerumahanDeveloper') }}",
                method: 'POST',
                headers: headers,
                data: $(this).serialize(),
                success: function (response) {
                    // console.log(response);
                    var errFlag = $(response).find("input[name='validation_errors']").val();

                    $("#modal-content").empty();
                    if(errFlag){
                        $("#modal-content").html(response);
                    }else{
                        $("#ajax-update").empty();
                        $("#ajax-update").html(response);
                        $("#staticBackdrop").modal("hide");
                    }

                },
                error: function(response) {
                    console.log(response);   
                }    
            });

            return false;
        });            
    
        $(document).on('click', ".delete", function(event) {
            event.preventDefault();        
            // alert('delete');
            var title = "Konfirmasi penghapusan data";
            var index = $(".delete").index(this);
            var currentRow=$(this).closest("tr");
            var namaPerumahan=currentRow.find("td:eq(2)").text();
            var id = $('input[name="id[]"]').eq(index).val();
            // alert(id);

            $('.title-confirm').html(title);
            // $('.modal-content-confirm').html(index);
            $('#confirm-value').val(id);
            // $('.modal-content-confirm').html($('#confirm-value').val());
            $('.modal-content-confirm').html('Apakah anda yakin akan menghapus data "'+ namaPerumahan + '"');
            $("#confirm-modal").modal("show");
        });
        
        $(document).on('click', "#confirm-yes", function(event) {
            event.preventDefault();

            $.ajax({
                // url: $('#confirm-value').val(),
                url: "{{ route('konsultan.deletePerumahanDeveloper') }}",
                method: 'POST',
                headers: headers,
                data: {id: $('#confirm-value').val(), url_list: 'konsultan.listPerumahanDeveloper', is_ajax: 1},
                success: function (response) {
                    $("#ajax-update").empty();
                    $("#ajax-update").html(response);                    

                },
                error: function(response) {
                    console.log(response);   
                }                
            })            
        });    


    });
});    
</script>

@endpush

