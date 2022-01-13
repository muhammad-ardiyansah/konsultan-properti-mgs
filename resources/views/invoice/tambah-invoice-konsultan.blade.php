@extends('konsultan.layouts.dash-konsultan-layout-horizontal')
@section('title','Konsultan Properti PT. Mitra Guntur Sarana')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Invoice</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('konsultan.indexInvoiceKonsultan') }}">List Invoice</a></li>
                    <li class="breadcrumb-item active">Tambah Invoice</li>
                </ol>
            </div>
            <h4 class="page-title">Tambah Invoice</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card widget-flat">
            <div class="card-body">
                <form id="tampilkan-pengajuan" name="tampilkan-pengajuan" id="tampilkan-pengajuan" method="get" action="{{ route('konsultan.tambahInvoiceKonsultan') }}" class="{{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>

                    <div class="row mb-3">
                        <label for="kode_pengajuan" class="col-lg-3 col-xl-3 col-form-label">Masukkan Kode Pengajuan</label>
                        <div class="col-lg-9 col-xl-9">
                            <input type="text" class="form-control" id="kode_pengajuan" name="kode_pengajuan" value="">
                        </div>
                    </div>      
                    <div class="row">          
                        <div class="col-lg-3 col-xl-3"></div>
                        <div class="col-lg-9 col-xl-9 text-end">          
                            <button type="Submit" id="tampilkan" class="btn btn-success"><i class="mdi mdi-post"></i> Tampilkan</button>
                        </div>
                    </div>

                </form>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>

<div class="row">
    <div class="col-12">

        @if ($isPengajuanFound)

        <div class="accordion" id="accordionExample">
            <div class="card mb-1">
                <div class="card-header" id="headingOne">
                    <h5 class="m-0">
                        <a class="custom-accordion-title d-block pt-1 pb-1" data-bs-toggle="collapse" href="#collapseOne" role="button" aria-expanded="false" aria-controls="collapseOne">
                            Info Developer
                        </a>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse multi-collapse">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                        accusamus terry richardson ad squid. 3 wolf moon officia
                        aute, non cupidatat skateboard dolor brunch. Food truck
                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                        sunt aliqua put a bird on it squid single-origin coffee
                        nulla assumenda shoreditch et. Nihil anim keffiyeh
                        helvetica, craft beer labore wes anderson cred nesciunt
                        sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                        Leggings occaecat craft beer farm-to-table, raw denim
                        aesthetic synth nesciunt you probably haven't heard of them
                        accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>

            <div class="card mb-1">
                <div class="card-header" id="headingTwo">
                    <h5 class="m-0">
                        <a class="custom-accordion-title collapsed d-block pt-1 pb-1"
                            data-bs-toggle="collapse" href="#collapseTwo" role="button"
                            aria-expanded="false" aria-controls="collapseTwo">
                            Info Administrasi
                        </a>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse multi-collapse" 
                >
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                        accusamus terry richardson ad squid. 3 wolf moon officia
                        aute, non cupidatat skateboard dolor brunch. Food truck
                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                        sunt aliqua put a bird on it squid single-origin coffee
                        nulla assumenda shoreditch et. Nihil anim keffiyeh
                        helvetica, craft beer labore wes anderson cred nesciunt
                        sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                        Leggings occaecat craft beer farm-to-table, raw denim
                        aesthetic synth nesciunt you probably haven't heard of them
                        accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>

            <div class="card mb-1">
                <div class="card-header" id="headingThree">
                    <h5 class="m-0">
                        <a class="custom-accordion-title collapsed d-block pt-1 pb-1"
                            data-bs-toggle="collapse" href="#collapseThree" role="button"
                            aria-expanded="false" aria-controls="collapseThree">
                            Info Perumahan
                        </a>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse multi-collapse"
                    >
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                        accusamus terry richardson ad squid. 3 wolf moon officia
                        aute, non cupidatat skateboard dolor brunch. Food truck
                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                        sunt aliqua put a bird on it squid single-origin coffee
                        nulla assumenda shoreditch et. Nihil anim keffiyeh
                        helvetica, craft beer labore wes anderson cred nesciunt
                        sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                        Leggings occaecat craft beer farm-to-table, raw denim
                        aesthetic synth nesciunt you probably haven't heard of them
                        accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>

            <div class="card mb-1">
                <div class="card-header" id="headingFour">
                    <h5 class="m-0">
                        <a class="custom-accordion-title collapsed d-block pt-1 pb-1"
                            data-bs-toggle="collapse" href="#collapseFour" role="button"
                            aria-expanded="false" aria-controls="collapseFour">
                            Info Pengawas
                        </a>
                    </h5>
                </div>
                <div id="collapseFour" class="collapse multi-collapse"
                    >
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                        accusamus terry richardson ad squid. 3 wolf moon officia
                        aute, non cupidatat skateboard dolor brunch. Food truck
                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                        sunt aliqua put a bird on it squid single-origin coffee
                        nulla assumenda shoreditch et. Nihil anim keffiyeh
                        helvetica, craft beer labore wes anderson cred nesciunt
                        sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                        Leggings occaecat craft beer farm-to-table, raw denim
                        aesthetic synth nesciunt you probably haven't heard of them
                        accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>

            <div class="card mb-1">
                <div class="card-header" id="headingFive">
                    <h5 class="m-0">
                        <a class="custom-accordion-title collapsed d-block pt-1 pb-1"
                            data-bs-toggle="collapse" href="#collapseFive" role="button"
                            aria-expanded="false" aria-controls="collapseFive">
                            Status Pengajuan Terakhir
                        </a>
                    </h5>
                </div>
                <div id="collapseFive" class="collapse multi-collapse"
                    >
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life
                        accusamus terry richardson ad squid. 3 wolf moon officia
                        aute, non cupidatat skateboard dolor brunch. Food truck
                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                        sunt aliqua put a bird on it squid single-origin coffee
                        nulla assumenda shoreditch et. Nihil anim keffiyeh
                        helvetica, craft beer labore wes anderson cred nesciunt
                        sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                        Leggings occaecat craft beer farm-to-table, raw denim
                        aesthetic synth nesciunt you probably haven't heard of them
                        accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>

        </div>

        @endif

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
    
        $('.upload').on('click', function () {    
            var index = $(".upload").index(this);
            // alert(index);
            $('#first_index').val(index);
            $('#last_index').val(index);
        });    
    
    });
});    
</script>

@endpush