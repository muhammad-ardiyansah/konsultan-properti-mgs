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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pengaturan</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Template SIMAK</a></li>
                        <li class="breadcrumb-item active">Template Pemeriksaan Kelaikan Fungsi Bangunan</li>
                    </ol>
                </div>
                <h4 class="page-title">Template Komponen Pemeriksaan Kelaikan Fungsi Bangunan Rumah </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row justify-content-center">
        <div class="col-10">

            <div class="card widget-flat">
                <div class="card-body">

                    <div class="row mb-3">
                        <label for="master_template_id" class="col-3 col-form-label">Master Template</label>
                        <div class="col-9">    
                            <select class="form-control select2" name="master_template_id" id="master_template_id" data-toggle="select2" @error('master_template_id') required @enderror >
                            <option value="">[- Pilih Master Template -]</option>
                                @foreach ($tluMasterTemplates as $id => $nama_master)
                                    <option value="{{ $id }}" {{ $id == old('master_template') ? "selected" : "" }}>{{ $nama_master }}</option>
                                @endforeach
                            </select>          
                        </div>                      
                    </div>                

                    <div id="data-template-komponen"></div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->        


        </div> <!-- end col-->
    </div>

</div>

@include('modals-dialog.modal-static-full-width')
@include('modals-dialog.modal-confirmation')

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

        $(document).on('change', "#master_template_id", function(event) {    
            // alert($(this).val());
            $("#data-template-komponen").empty();
            var tluMasterTemplateId = $(this).val();
            if ($(this).val()) {

                $.ajax({
                    url: "{{ route('konsultan.getDataTemplateKomponenPemeriksaan') }}",
                    method: 'GET',
                    data: {tlu_master_template_id: $(this).val()},
                    success: function (response) {
                        // alert(response);
                        $("#data-template-komponen").html(response);                   
                    },
                    error: function(response) {
                        console.log(response);   
                    }
                })            
            
            }
        });


        // $('#tambah-header-komponen').on('click', function () {
            $(document).on('click', "#tambah-header-komponen", function(event) {    

               event.preventDefault();     

                var title = $(this).text();
                $.ajax({
                    url: $(this).attr("href"),
                    method: 'GET',
                    headers: headers,
                    success: function (response) {
                        $("#staticBackdrop").modal("show");
                        $('.modal-title').html(title);
                        $("#modal-content").html(response);
                    },
                    error: function(response) {
                        console.log(response);   
                    }                
                })

        });

        $(document).on('change', "#jenis_input_pengukuran_1", function(event) {    
            // alert($(this).val());
            $("#kelompok-input-angka-pengukuran-1-content").empty();

            if ($(this).val() !== "0") {
                
                var url = '{{ route('konsultan.getKelompokInputAngkaPengukuran1') }}'; 
                if ($(this).val() == "2") {
                    url = '{{ route('konsultan.getKelompokInputTextPengukuran1') }}';
                }    

                if ($(this).val() == "3") {
                    url = '{{ route('konsultan.getKelompokInputCheckboxPengukuran1') }}';
                }

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        // alert(response);
                        $("#kelompok-input-angka-pengukuran-1-content").html(response);                    
                    },
                    error: function(response) {
                        console.log(response);   
                    }
                })            
            
            }
        });

        $(document).on('change', "#jenis_input_pengukuran_2", function(event) {    
            // alert($(this).val());
            $("#kelompok-input-angka-pengukuran-2-content").empty();

            if ($(this).val() !== "0") {
                
                var url = '{{ route('konsultan.getKelompokInputAngkaPengukuran2') }}'; 
                if ($(this).val() == "2") {
                    url = '{{ route('konsultan.getKelompokInputTextPengukuran2') }}';
                }    

                if ($(this).val() == "3") {
                    url = '{{ route('konsultan.getKelompokInputCheckboxPengukuran2') }}';
                }

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        // alert(response);
                        $("#kelompok-input-angka-pengukuran-2-content").html(response);                    
                    },
                    error: function(response) {
                        console.log(response);   
                    }
                })            
            
            }
        });        

        $(document).on('change', "#jenis_input_pengukuran_3", function(event) {    
            // alert($(this).val());
            $("#kelompok-input-angka-pengukuran-3-content").empty();

            if ($(this).val() !== "0") {
                
                var url = '{{ route('konsultan.getKelompokInputAngkaPengukuran3') }}'; 
                if ($(this).val() == "2") {
                    url = '{{ route('konsultan.getKelompokInputTextPengukuran3') }}';
                }    

                if ($(this).val() == "3") {
                    url = '{{ route('konsultan.getKelompokInputCheckboxPengukuran3') }}';
                }

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        // alert(response);
                        $("#kelompok-input-angka-pengukuran-3-content").html(response);                    
                    },
                    error: function(response) {
                        console.log(response);   
                    }
                })            
            
            }
        });

        $(document).on('change', "#jenis_input_keterangan", function(event) {    
            // alert($(this).val());
            $("#kelompok-input-keterangan").empty();

            if ($(this).val() !== "0") {
                
                var url = '{{ route('konsultan.getKelompokInputAngkaKeterangan') }}'; 
                if ($(this).val() == "2") {
                    url = '{{ route('konsultan.getKelompokInputTextKeterangan') }}';
                }    

                if ($(this).val() == "3") {
                    url = '{{ route('konsultan.getKelompokInputCheckboxKeterangan') }}';
                }

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        // alert(response);
                        $("#kelompok-input-keterangan").html(response);                    
                    },
                    error: function(response) {
                        console.log(response);   
                    }
                })            
            
            }
        });        

        $(document).on('submit', "#template-komponen-form", function(event) {
            // alert('submit');
            // alert($(this).attr("action"));

            $.ajax({
                url: $(this).attr("action"),
                method: 'POST',
                headers: headers,
                data: $(this).serialize(),
                success: function (response) {
                    // console.log(response);
                    var errFlag = $(response).find("input[name='validation_errors']").val();
                    // alert(errFlag);
                    if(errFlag){
                        // console.log(response);
                        $("#modal-content").html(response);
                    }else{
                        $("#data-template-komponen").empty();
                        $("#data-template-komponen").html(response);
                        $("#staticBackdrop").modal("hide");
                        // console.log(response);
                    }

                },
                error: function(response) {   
                    console.log(response);
                }    
            })

            return false;
        });

        // $(document).on('keypress keyup blur', ".input_angka_pengukuran_1", function(event) {
            $(document).on('keypress', ".input_angka_pengukuran_1", function(event) {    

            // alert(event.which);
                
            $(this).val($(this).val().replace(/[^0-9\,]/g,''));
            if ((event.which != 44 || $(this).val().indexOf(',') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
            
        });    

        $(document).on('keypress', ".input_angka_keterangan", function(event) {    

        // alert(event.which);
            
            $(this).val($(this).val().replace(/[^0-9\,]/g,''));
            if ((event.which != 44 || $(this).val().indexOf(',') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }

        });

        $(document).on('click', ".tambah-sub", function(event) {
            event.preventDefault();        
            // alert('delete');
            
            var index = $(".tambah-sub").index(this);
            // alert(index);
            var currentRow=$(this).closest("tr");
            var text1=currentRow.find("td:eq(0)").text();
            var text2=currentRow.find("td:eq(1)").text();
            var title = "Tambah sub komponen \"" + text1 + " " + text2 + "\"";
            var parentId = $('.parent_id_temp').eq(index).val();
            // alert(parentId);
            var tluMasterTemplateId = $('#master_template_id').val();
            // alert(tluMasterTemplateId);
            $.ajax({
                url: $(this).attr("href"),
                method: 'GET',
                success: function (response) {
                    $("#staticBackdrop").modal("show");
                    $('.modal-title').html(title);
                    $("#modal-content").html(response);
                    $('#tlu_master_template_id').val(tluMasterTemplateId);
                    $('#parent_id').val(parentId);
                },
                error: function(response) {
                    console.log(response);   
                }                
            })



        });

        $(document).on('click', ".edit", function(event) {
            event.preventDefault();        
            var index = $(".edit").index(this);
            var id = $('.id').eq(index).val();
            // alert('id : ' + id);
            // alert($(this).attr("href"));

            $.ajax({
                url: $(this).attr("href"),
                method: 'GET',
                success: function (response) {
                    $("#staticBackdrop").modal("show");
                    // $('.modal-title').html(title);
                    $("#modal-content").html(response);
                    // $('#tlu_master_template_id').val(tluMasterTemplateId);
                    // $('#parent_id').val(parentId);
                },
                error: function(response) {
                    console.log(response);   
                }                
            })


        });


        $(document).on('click', ".delete", function(event) {
            event.preventDefault();        
            // alert('delete');
            var title = "Konfirmasi penghapusan data";
            var index = $(".delete").index(this);
            var currentRow=$(this).closest("tr");
            var noKomponen=currentRow.find("td:eq(0)").text();
            var namaKomponen=currentRow.find("td:eq(1)").text(); 
            
            $('.title-confirm').html(title);
            // $('.modal-content-confirm').html(index);
            $('#confirm-value').val($(this).attr('href'));
            // $('.modal-content-confirm').html($('#confirm-value').val());
            $('.modal-content-confirm').html('Apakah anda yakin akan menghapus data "'+ noKomponen + ' ' + namaKomponen + '"');
            $("#confirm-modal").modal("show");
        });
        
        $(document).on('click', "#confirm-yes", function(event) {
            event.preventDefault();

            // window.location.replace($('#confirm-value').val());

            $.ajax({
                url: $('#confirm-value').val(),
                method: 'GET',
                headers: headers,
                success: function (response) {
                    $("#data-template-komponen").empty();
                    $("#data-template-komponen").html(response);                    

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

