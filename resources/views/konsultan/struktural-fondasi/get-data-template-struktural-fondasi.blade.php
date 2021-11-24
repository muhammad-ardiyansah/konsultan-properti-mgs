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

<div class="row mb-3">
    <div class="col-12 text-end">
        <a href="{{ route('konsultan.tambahKomponenTemplateStrukturalFondasi', ['tlu_master_template_id'=>$tluMasterTemplateId]) }}" id="tambah-header-komponen" class="btn btn-outline-info btn-m ms-3"><i class="mdi mdi-beaker-plus"></i> Tambah Header Komponen</a>
    </div>
</div>


{!! $printOnTemplate !!}

<script>
    $('.input_selectbox_pengukuran_1').select2({
        dropdownParent: $('.content')
    });    
</script>