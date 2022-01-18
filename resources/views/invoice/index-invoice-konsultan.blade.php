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
                <h4 class="page-title">List Invoice</h4>
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
                                        <label for="no_invoice" class="form-label">No. Invoice</label>
                                        <input type="text" name="no_invoice" id="no_invoice" class="form-control" value="{{ request()->get('no_invoice') }}">
                                    </div>

                                </div>

                                <div class="col-lg-4 col-xl-4">                                
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Invoice Date</label>
                                        <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#selectedInvoiceDateValue" data-cancel-class="btn-light">
                                            <i class="mdi mdi-calendar"></i>&nbsp;
                                            <span id="selectedInvoiceDateValue">{{ request()->get('invoice_date') }}</span> <i class="mdi mdi-menu-down"></i>
                                            <input name="invoice_date" id="invoice_date" type="hidden" value="{{ request()->get('invoice_date') }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-4 col-xl-4">                                
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Invoice Due Date</label>
                                        <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#selectedInvoiceDueDateValue" data-cancel-class="btn-light">
                                            <i class="mdi mdi-calendar"></i>&nbsp;
                                            <span id="selectedInvoiceDueDateValue">{{ request()->get('invoice_due_date') }}</span> <i class="mdi mdi-menu-down"></i>
                                            <input name="invoice_due_date" id="invoice_due_date" type="hidden" value="{{ request()->get('invoice_due_date') }}">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-12 col-xl-12">                                

                                    <label for="approval" class="form-label mb-2">Status Konfirmasi Bayar</label>
                                    <div class="mt mb-3">
                                        <div class="row">

                                            <div class="col-lg-4 col-xl-4 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="status_konfirmasi_bayar" name="status_konfirmasi_bayar" class="form-check-input" value="0" @if (request()->get('status_konfirmasi_bayar')==0) checked @endif>
                                                    <label class="form-check-label" for="customRadio3">Semua Data</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-xl-4 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="status_konfirmasi_bayar" name="status_konfirmasi_bayar" class="form-check-input" value="1" @if (request()->get('status_konfirmasi_bayar')==1) checked @endif >
                                                    <label class="form-check-label" for="customRadio4">Belum Dikonfirmasi</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-xl-4 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="status_konfirmasi_bayar" name="status_konfirmasi_bayar" class="form-check-input" value="2" @if (request()->get('status_konfirmasi_bayar')==2) checked @endif >
                                                    <label class="form-check-label" for="customRadio4">Sudah Dikonfirmasi</label>
                                                </div>      
                                            </div>

                                        </div>                       
                                    </div>                                

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-12 col-xl-12">                                

                                    <label for="approval" class="form-label mb-2">Status Bayar</label>
                                    <div class="mt mb-3">
                                        <div class="row">

                                            <div class="col-lg-4 col-xl-4 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="status_bayar" name="status_bayar" class="form-check-input" value="0" @if (request()->get('status_bayar')==0) checked @endif>
                                                    <label class="form-check-label" for="customRadio3">Semua Data</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-xl-4 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="status_bayar" name="status_bayar" class="form-check-input" value="1" @if (request()->get('status_bayar')==1) checked @endif >
                                                    <label class="form-check-label" for="customRadio4">Belum Dibayar</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-xl-4 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" id="status_bayar" name="status_bayar" class="form-check-input" value="2" @if (request()->get('status_bayar')==2) checked @endif >
                                                    <label class="form-check-label" for="customRadio4">Sudah Dibayar</label>
                                                </div>      
                                            </div>

                                        </div>                       
                                    </div>                                

                                </div>

                            </div>                             

                            <div class="row mt-3">
                                
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

                            <div class="row mt-2">
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
                                
                                    <!-- <div class="mb-3">
                                        <label class="form-label">Periode Pengajuan</label>
                                        <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#selectedValue"  data-cancel-class="btn-light">
                                            <i class="mdi mdi-calendar"></i>&nbsp;
                                            <span id="selectedValue">{{ request()->get('periode_pengajuan') }}</span> <i class="mdi mdi-menu-down"></i>
                                            <input name="periode_pengajuan" id="periode_pengajuan" type="hidden" value="{{ request()->get('periode_pengajuan') }}">
                                        </div>
                                    </div> -->

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
                        <div class="col-sm-12 col-md-6 text-end">
                            <a href="{{ route('konsultan.tambahInvoiceKonsultan') }}" class="btn btn-primary btn-m ms-3"><i class="mdi mdi-plus"></i> Buat Invoice Baru</a>
                        </div>


                    </div>                


                    <div class="table-responsive">
                        <table id="scroll-horizontal-datatable" class="table table-hover w-100 wrap font-14">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Invoice</th>
                                    <th>@sortablelink('invoice_date', 'Invoice Date')</th>
                                    <th>@sortablelink('invoice_due_date', 'Invoice Due Date')</th>
                                    <th>Kode Pengajuan</th>
                                    <th>Pengajuan DPD Apersi</th>
                                    <th>Nama Developer</th>
                                    <th>@sortablelink('perumahan_developer.nama_perumahan', 'Nama Perumahan')</th>
                                    <th>Blok Rumah dlm Invoice</th>
                                    <th>Status Bayar</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @forelse ($invoiceHeaders as $key => $invoice) 
                                    <tr>
                                        <td>{{ $invoiceHeaders->firstItem() + $key }}</td>
                                        <td>{{ $invoice->no_invoice }}</td>
                                        <td>@format_tgl_dMY($invoice->invoice_date)</td>
                                        <td>@format_tgl_dMY($invoice->invoice_due_date)</td>
                                        <td>{{ $invoice->pengajuan_developer->kode_pengajuan }}</td>
                                        <td>{{ $invoice->pengajuan_developer->province_apersi->name; }}</td>
                                        <td>{{ $invoice->pengajuan_developer->developer->nama_perusahaan; }}</td>
                                        <td>{{ $invoice->pengajuan_developer->perumahan_developer->nama_perumahan; }}</td>
                                        <td>{{ $invoice->blok_invoice }}</td>
                                        <td></td>
                                        <td></td>
                                        <td class="table-action">
                                            <a href="{{ route('konsultan.viewInvoiceKonsultan', ['id' => $invoice->id]) }}" class="action-icon view" title="Lihat invoice"> <i class="mdi mdi-eye"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12"> <div class="text-center">Tidak ada data</div></td>
                                    </tr>
                                @endforelse
                                                        
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3">    
                        {{ $invoiceHeaders->links('vendor.pagination.custom') }}
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
            // alert($('#selectedPeriodeInvoiceValue').text());    
            $('#invoice_date').val($('#selectedInvoiceDateValue').text());
            $('#invoice_due_date').val($('#selectedInvoiceDueDateValue').text());
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

