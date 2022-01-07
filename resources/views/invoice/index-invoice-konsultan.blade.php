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
                        <li class="breadcrumb-item active">List Invoice</li>
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
                        <form id="cari-invoice" name="cari-invoice" method="get" action="{{ route('konsultan.indexInvoiceKonsultan') }}">
                            
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
                                        <label for="developer_id" class="form-label">Developer</label>
                                        <select class="form-control select2" name="developer_id" id="developer_id" data-toggle="select2" @error('developer_id') required @enderror >
                                            <option value="">[- Semua Developer -]</option>
                                            @foreach ($developers as $id => $nama_perusahaan)
                                                <option value="{{ $id }}" {{ $id == request()->get('developer_id') ? "selected" : "" }}>{{ $nama_perusahaan }}</option>
                                            @endforeach
                                        </select>                                
                                    </div>

                                </div>
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
                                        <label class="form-label">Periode Pengajuan</label>
                                        <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#selectedValue"  data-cancel-class="btn-light">
                                            <i class="mdi mdi-calendar"></i>&nbsp;
                                            <span id="selectedValue">{{ request()->get('periode_pengajuan') }}</span> <i class="mdi mdi-menu-down"></i>
                                            <input name="periode_pengajuan" id="periode_pengajuan" type="hidden" value="{{ request()->get('periode_pengajuan') }}">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-12 col-xl-12">                                

                                    <label for="approval" class="form-label">Status Invoice</label>
                                    <div class="mt mb-3">
                                        <div class="row">

                                            <div class="col-lg-4 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="status_invoice" name="status_invoice" class="form-check-input" value="0" @if (request()->get('status_invoice')==0) checked @endif>
                                                    <label class="form-check-label" for="customRadio3">Semua Data</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="status_invoice" name="status_invoice" class="form-check-input" value="1" @if (request()->get('status_invoice')==1) checked @endif >
                                                    <label class="form-check-label" for="customRadio4">Belum Dibuat</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="status_invoice" name="status_invoice" class="form-check-input" value="2" @if (request()->get('status_invoice')==2) checked @endif >
                                                    <label class="form-check-label" for="customRadio4">Sudah Dibuat</label>
                                                </div>      
                                            </div>

                                        </div>                       
                                    </div>                                

                                </div>

                            </div>    

                            <div class="row">

                                <div class="col-lg-6 col-xl-6">                                
    
                                    <div class="mb-3">
                                        <label for="no_invoice" class="form-label">No. Invoice</label>
                                        <input type="text" name="no_invoice" id="no_invoice" class="form-control" value="{{ request()->get('no_invoice') }}">
                                    </div>

                                </div>

                                <div class="col-lg-6 col-xl-6">                                
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Periode Invoice</label>
                                        <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#selectedPeriodeInvoiceValue"  data-cancel-class="btn-light">
                                            <i class="mdi mdi-calendar"></i>&nbsp;
                                            <span id="selectedPeriodeInvoiceValue">{{ request()->get('periode_invoice') }}</span> <i class="mdi mdi-menu-down"></i>
                                            <input name="periode_invoice" id="periode_invoice" type="hidden" value="{{ request()->get('periode_invoice') }}">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 text-end">
                                    <input name="data_per_halaman" id="data_per_halaman" type="hidden" value="{{ request()->get('data_per_halaman') }}">
                                    <a href="{{ route('konsultan.indexInvoiceKonsultan') }}" class="btn btn-warning btn-m ms-3"> Reset</a>
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
                    </div>                


                    <div class="table-responsive">
                        <table id="scroll-horizontal-datatable" class="table table-hover w-100 wrap font-14">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>@sortablelink('kode_pengajuan', 'Kode Pengajuan')</th>
                                    <th>Pengajuan DPD Apersi</th>
                                    <th>Nama Developer</th>
                                    <th>@sortablelink('perumahan_developer.nama_perumahan', 'Nama Perumahan')</th>
                                    <th>Status Terakhir</th>
                                    <th>@sortablelink('timestamp_pengajuan', 'Tanggal Pengajuan')</th>
                                    <th>No. Invoice</th>
                                    <th>Tanggal Invoice</th>
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
                                        <td>{{ $pengajuan->tlu_status_pengajuan_developer->nama_status; }}</td>
                                        <td>@format_tgl_dMYHis($pengajuan->timestamp_pengajuan)</td>
                                        <td>{{ $pengajuan->invoice_header->no_invoice; }}</td>
                                        <td> @if ($pengajuan->invoice_header->timestamp_pembuatan) @format_tgl_dMYHis($pengajuan->invoice_header->timestamp_pembuatan) @endif </td>
                                        <td class="table-action">
                                            <a href="{{ route('konsultan.invoicePageKonsultan', ['id' => $pengajuan->id]) }}" class="action-icon view" title="Lihat detail"> <i class="mdi mdi-eye"></i></a>
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
    
        var headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }            
    
        $('input[type=radio][name=approval]').change(function() {
            // alert($(this).val());
            if ($(this).val()==2) {
                $('#province_code_apersi').prop("disabled", false);
            }else{
                $('#province_code_apersi').prop("disabled", true);
            }
        });

        $('#cari-invoice').submit(function() {
            alert($('#selectedPeriodeInvoiceValue').text());    
            $('#periode_pengajuan').val($('#selectedValue').text());
            $('#periode_invoice').val($('#selectedPeriodeInvoiceValue').text());
            $('#data_per_halaman').val($('#per_halaman').val());
            // return false;
        });

        $('#per_halaman').on('change', function () {
            // alert($(this).val());
            $('#cari-pengajuan').submit();
        });    
        
        $('#developer_id').on('change', function () {
            // alert($(this).val());
            $.ajax({
                url: "{{ route('konsultan.getPerumahanDevelopers') }}",
                method: 'GET',
                headers: headers,
                data: {developer_id: $(this).val()},
                success: function (response) {
                    // console.log(response);
                    $('#perumahan_developer_id').empty();

                    $('#perumahan_developer_id').append(new Option('[- Semua Perumahan -]', ''));
                    $.each(response, function (code, name) {
                        $('#perumahan_developer_id').append(new Option(name, code))
                        // alert(name);
                    })
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
