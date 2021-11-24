<div class="row">
    <div class="col-12">


        <form id="template-komponen-form"  method="POST" action="{{ route('konsultan.simpanKomponenTemplateStrukturalFondasi') }}" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
        @csrf
            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Tambah</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                    <div class="ribbon-content">    
                            
                        <div class="row mb-3">
                            <label for="no_komponen" class="col-3 col-form-label">No Komponen</label>
                            <div class="col-3">
                                <input type="text" class="form-control" id="no_komponen" name="no_komponen" placeholder="" @error('no_komponen') required @enderror value="{{ old('no_komponen', $templateStrukturalFondasi->no_komponen) }}" >
                                @error('no_komponen')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>                    

                        <div class="row mb-3">
                            <label for="nama_komponen" class="col-3 col-form-label">Nama Komponen</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" placeholder="" @error('nama_komponen') required @enderror value="{{ old('nama_komponen', $templateStrukturalFondasi->nama_komponen) }}" >
                                @error('nama_komponen')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>                         

                        <div class="row mb-3">
                            <label for="label_1" class="col-3 col-form-label">Label 1</label>
                            <div class="col-5">
                                <input type="text" class="form-control" id="label_1" name="label_1" placeholder="" value="{{ old('label_1', $templateStrukturalFondasi->label_1) }}" >
                                @error('label_1')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_input_pengukuran_1" class="col-3 col-form-label">Jenis Input Pengukuran 1</label>
                            <div class="col-5">    
                                <select class="form-control select2" name="jenis_input_pengukuran_1" id="jenis_input_pengukuran_1" data-toggle="select2" @error('jenis_input_pengukuran_1') required @enderror >
                                    @foreach ($tluJenisInputPengukurans as $id => $jenis_input)
                                        <option value="{{ $id }}" {{ $id == old('jenis_input_pengukuran_1', $templateStrukturalFondasi->jenis_input_pengukuran_1) ? "selected" : "" }}>{{ $jenis_input }}</option>
                                    @endforeach
                                </select>          
                                @error('jenis_input_pengukuran_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                      
                        </div>
                                        
                        <div id="kelompok-input-angka-pengukuran-1-content">
                        
                            @if (old('jenis_input_pengukuran_1', $templateStrukturalFondasi->jenis_input_pengukuran_1)==1)
                                @include('konsultan.struktural-fondasi.edit.kelompok-input-angka-pengukuran-1')
                            @endif

                            @if (old('jenis_input_pengukuran_1', $templateStrukturalFondasi->jenis_input_pengukuran_1)==2)
                                @include('konsultan.struktural-fondasi.edit.kelompok-input-text-pengukuran-1')
                            @endif

                            @if (old('jenis_input_pengukuran_1', $templateStrukturalFondasi->jenis_input_pengukuran_1)==3 || old('jenis_input_pengukuran_1', $templateStrukturalFondasi->jenis_input_pengukuran_1)==4)
                                @include('konsultan.struktural-fondasi.edit.kelompok-input-checkbox-pengukuran-1')
                            @endif



                        </div>
                        
                        <div class="row mb-3">
                            <label for="label_2" class="col-3 col-form-label">Label 2</label>
                            <div class="col-5">
                                <input type="text" class="form-control" id="label_2" name="label_2" placeholder="" value="{{ old('label_2', $templateStrukturalFondasi->label_2) }}" >
                                @error('label_2')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_input_pengukuran_2" class="col-3 col-form-label">Jenis Input Pengukuran 2</label>
                            <div class="col-5">    
                                <select class="form-control select2" name="jenis_input_pengukuran_2" id="jenis_input_pengukuran_2" data-toggle="select2" @error('jenis_input_pengukuran_2') required @enderror >
                                    @foreach ($tluJenisInputPengukurans as $id => $jenis_input)
                                        <option value="{{ $id }}" {{ $id == old('jenis_input_pengukuran_2', $templateStrukturalFondasi->jenis_input_pengukuran_2) ? "selected" : "" }}>{{ $jenis_input }}</option>
                                    @endforeach
                                </select>          
                                @error('jenis_input_pengukuran_2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                      
                        </div>                        

                        <div id="kelompok-input-angka-pengukuran-2-content">

                            @if (old('jenis_input_pengukuran_2', $templateStrukturalFondasi->jenis_input_pengukuran_2)==1)
                                @include('konsultan.struktural-fondasi.edit.kelompok-input-angka-pengukuran-2')
                            @endif

                            @if (old('jenis_input_pengukuran_2', $templateStrukturalFondasi->jenis_input_pengukuran_2)==2)
                                @include('konsultan.struktural-fondasi.edit.kelompok-input-text-pengukuran-2')
                            @endif

                            @if (old('jenis_input_pengukuran_2', $templateStrukturalFondasi->jenis_input_pengukuran_2)==3 || old('jenis_input_pengukuran_2', $templateStrukturalFondasi->jenis_input_pengukuran_2)==4)
                                @include('konsultan.struktural-fondasi.edit.kelompok-input-checkbox-pengukuran-2')
                            @endif

                        </div>

                        <div class="row mb-3">
                            <label for="label_3" class="col-3 col-form-label">Label 3</label>
                            <div class="col-5">
                                <input type="text" class="form-control" id="label_3" name="label_3" placeholder="" value="{{ old('label_3', $templateStrukturalFondasi->label_3) }}" >
                                @error('label_3')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_input_pengukuran_3" class="col-3 col-form-label">Jenis Input Pengukuran 3</label>
                            <div class="col-5">    
                                <select class="form-control select2" name="jenis_input_pengukuran_3" id="jenis_input_pengukuran_3" data-toggle="select2" @error('jenis_input_pengukuran_3') required @enderror >
                                    @foreach ($tluJenisInputPengukurans as $id => $jenis_input)
                                        <option value="{{ $id }}" {{ $id == old('jenis_input_pengukuran_3', $templateStrukturalFondasi->jenis_input_pengukuran_3) ? "selected" : "" }}>{{ $jenis_input }}</option>
                                    @endforeach
                                </select>          
                                @error('jenis_input_pengukuran_3')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                      
                        </div>

                        <div id="kelompok-input-angka-pengukuran-3-content">

                            @if (old('jenis_input_pengukuran_3', $templateStrukturalFondasi->jenis_input_pengukuran_3)==1)
                                @include('konsultan.struktural-fondasi.edit.kelompok-input-angka-pengukuran-3')
                            @endif

                            @if (old('jenis_input_pengukuran_3', $templateStrukturalFondasi->jenis_input_pengukuran_3)==2)
                                @include('konsultan.struktural-fondasi.edit.kelompok-input-text-pengukuran-3')
                            @endif

                            @if (old('jenis_input_pengukuran_3', $templateStrukturalFondasi->jenis_input_pengukuran_3)==3 || old('jenis_input_pengukuran_3', $templateStrukturalFondasi->jenis_input_pengukuran_3)==4)
                                @include('konsultan.struktural-fondasi.edit.kelompok-input-checkbox-pengukuran-3')
                            @endif

                        </div>
                        
                        <div class="row mb-3">
                            <label for="label_4" class="col-3 col-form-label">Label 4</label>
                            <div class="col-5">
                                <input type="text" class="form-control" id="label_4" name="label_4" placeholder="" value="{{ old('label_4', $templateStrukturalFondasi->label_4) }}" >
                                @error('label_4')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_input_pengukuran_4" class="col-3 col-form-label">Jenis Input Pengukuran 4</label>
                            <div class="col-5">    
                                <select class="form-control select2" name="jenis_input_pengukuran_4" id="jenis_input_pengukuran_4" data-toggle="select2" @error('jenis_input_pengukuran_4') required @enderror >
                                    @foreach ($tluJenisInputPengukurans as $id => $jenis_input)
                                        <option value="{{ $id }}" {{ $id == old('jenis_input_pengukuran_4', $templateStrukturalFondasi->jenis_input_pengukuran_4) ? "selected" : "" }}>{{ $jenis_input }}</option>
                                    @endforeach
                                </select>          
                                @error('jenis_input_pengukuran_4')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                      
                        </div>

                        <div id="kelompok-input-angka-pengukuran-4-content">

                            @if (old('jenis_input_pengukuran_4', $templateStrukturalFondasi->jenis_input_pengukuran_4)==1)
                                @include('konsultan.struktural-fondasi.edit.kelompok-input-angka-pengukuran-4')
                            @endif

                            @if (old('jenis_input_pengukuran_4', $templateStrukturalFondasi->jenis_input_pengukuran_4)==2)
                                @include('konsultan.struktural-fondasi.edit.kelompok-input-text-pengukuran-4')
                            @endif

                            @if (old('jenis_input_pengukuran_4', $templateStrukturalFondasi->jenis_input_pengukuran_4)==3 || old('jenis_input_pengukuran_3', $templateStrukturalFondasi->jenis_input_pengukuran_4)==4)
                                @include('konsultan.struktural-fondasi.tambah.kelompok-input-checkbox-pengukuran-4')
                            @endif

                        </div>

                        <div class="row mb-3">
                            <label for="print_on_template" class="col-3 col-form-label">Print pada template</label>
                            <div class="col-9">
                                <textarea class="form-control" placeholder="" id="print_on_template" name="print_on_template" rows="10" @error('print_on_template') required @enderror >{{ old('print_on_template', $templateStrukturalFondasi->print_on_template) }}</textarea>                                    
                                @error('print_on_template')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror                       
                            </div>
                        </div>

                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->                       

            <div class="card widget-flat">
                <div class="card-body">
                    <div class="justify-content-end row">
                        <div class="col-9">
                            <input name="id" id="id"  type="hidden" value="{{ old('id', $templateStrukturalFondasi->id) }}">
                            {{-- <input name="parent_id" id="parent_id"  type="hidden" value="{{ old('parent_id', $templateStrukturalFondasi->parent_id) }}"> --}}
                            <input name="tlu_master_template_id" id="tlu_master_template_id" type="hidden" value="{{ old('tlu_master_template_id', $templateStrukturalFondasi->tlu_master_template_id) }}">                        
                            <input name="validation_errors" id="validation_errors"  type="hidden" value="{{ $errors->any() ? 1 : '' }}">
                            <button type="Submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->

        </form> 

    </div>
</div>

<script>
    $('#jenis_input_pengukuran_1').select2({
        dropdownParent: $('#staticBackdrop')
    });

    $('#jenis_input_pengukuran_2').select2({
        dropdownParent: $('#staticBackdrop')
    });

    $('#jenis_input_pengukuran_3').select2({
        dropdownParent: $('#staticBackdrop')
    });

    $('#jenis_input_pengukuran_4').select2({
        dropdownParent: $('#staticBackdrop')
    });    

</script>