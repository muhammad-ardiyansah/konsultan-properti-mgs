<div class="row">
    <div class="col-12">


        <form id="template-komponen-form"  method="POST" action="{{ route('konsultan.simpanTemplateKomponenPemeriksaan') }}" class="form-horizontal {{ $errors->any() ? 'needs-validation was-validated' : '' }}" novalidate>
        @csrf
            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon ribbon-primary float-start"><i class="mdi mdi-access-point me-1"></i>Tambah</div>
                    <h5 class="text-primary float-end mt-0"><i class="uil-file-plus-alt"></i></h5>
                    <div class="ribbon-content">    
                            
                        <div class="row mb-3">
                            <label for="no_komponen" class="col-3 col-form-label">No Komponen</label>
                            <div class="col-3">
                                <input type="text" class="form-control" id="no_komponen" name="no_komponen" placeholder="" @error('no_komponen') required @enderror value="{{ old('no_komponen') }}" >
                                @error('no_komponen')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>                    

                        <div class="row mb-3">
                            <label for="nama_komponen" class="col-3 col-form-label">Nama Komponen</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" placeholder="" @error('nama_komponen') required @enderror value="{{ old('nama_komponen') }}" >
                                @error('nama_komponen')
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
                                        <option value="{{ $id }}" {{ $id == old('jenis_input_pengukuran_1') ? "selected" : "" }}>{{ $jenis_input }}</option>
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
                        
                            @if (old('jenis_input_pengukuran_1')==1)
                                @include('konsultan.template-komponen.tambah.kelompok-input-angka-pengukuran-1')
                            @endif

                            @if (old('jenis_input_pengukuran_1')==2)
                                @include('konsultan.template-komponen.tambah.kelompok-input-text-pengukuran-1')
                            @endif

                            @if (old('jenis_input_pengukuran_1')==3)
                                @include('konsultan.template-komponen.tambah.kelompok-input-checkbox-pengukuran-1')
                            @endif

                        </div>
                        
                        <div class="row mb-3">
                            <label for="jenis_input_pengukuran_2" class="col-3 col-form-label">Jenis Input Pengukuran 2</label>
                            <div class="col-5">    
                                <select class="form-control select2" name="jenis_input_pengukuran_2" id="jenis_input_pengukuran_2" data-toggle="select2" @error('jenis_input_pengukuran_2') required @enderror >
                                    @foreach ($tluJenisInputPengukurans as $id => $jenis_input)
                                        <option value="{{ $id }}" {{ $id == old('jenis_input_pengukuran_2') ? "selected" : "" }}>{{ $jenis_input }}</option>
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

                            @if (old('jenis_input_pengukuran_2')==1)
                                @include('konsultan.template-komponen.tambah.kelompok-input-angka-pengukuran-2')
                            @endif

                            @if (old('jenis_input_pengukuran_2')==2)
                                @include('konsultan.template-komponen.tambah.kelompok-input-text-pengukuran-2')
                            @endif

                            @if (old('jenis_input_pengukuran_2')==3)
                                @include('konsultan.template-komponen.tambah.kelompok-input-checkbox-pengukuran-2')
                            @endif

                        </div>

                        <div class="row mb-3">
                            <label for="jenis_input_pengukuran_3" class="col-3 col-form-label">Jenis Input Pengukuran 3</label>
                            <div class="col-5">    
                                <select class="form-control select2" name="jenis_input_pengukuran_3" id="jenis_input_pengukuran_3" data-toggle="select2" @error('jenis_input_pengukuran_3') required @enderror >
                                    @foreach ($tluJenisInputPengukurans as $id => $jenis_input)
                                        <option value="{{ $id }}" {{ $id == old('jenis_input_pengukuran_3') ? "selected" : "" }}>{{ $jenis_input }}</option>
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

                            @if (old('jenis_input_pengukuran_3')==1)
                                @include('konsultan.template-komponen.tambah.kelompok-input-angka-pengukuran-3')
                            @endif

                            @if (old('jenis_input_pengukuran_3')==2)
                                @include('konsultan.template-komponen.tambah.kelompok-input-text-pengukuran-3')
                            @endif

                            @if (old('jenis_input_pengukuran_3')==3)
                                @include('konsultan.template-komponen.tambah.kelompok-input-checkbox-pengukuran-3')
                            @endif

                        </div>

                        <div class="row mb-3">
                            <div class="col-3">Tampilkan Checklist Kesesuaian</div>    

                            <div class="col-9">
                                <div class="form-check form-checkbox-success mb-2">
                                    <input type="checkbox" class="form-check-input" id="checklist_kesesuaian" name="checklist_kesesuaian" @if (old('checklist_kesesuaian')) checked @endif>
                                    <label class="form-check-label" for="checklist_kesesuaian">Checklist Kesesuaian Kondisi Faktual Dengan Rencana Teknis dan Gambar Terbangun</label>
                                </div>
                            </div>    
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_input_keterangan" class="col-3 col-form-label">Jenis Input Keterangan</label>
                            <div class="col-5">    
                                <select class="form-control select2" name="jenis_input_keterangan" id="jenis_input_keterangan" data-toggle="select2" @error('jenis_input_keterangan') required @enderror >
                                    @foreach ($tluJenisInputPengukurans as $id => $jenis_input)
                                        <option value="{{ $id }}" {{ $id == old('jenis_input_keterangan') ? "selected" : "" }}>{{ $jenis_input }}</option>
                                    @endforeach
                                </select>          
                                @error('jenis_input_keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                      
                        </div>

                        <div id="kelompok-input-keterangan">

                            @if (old('jenis_input_keterangan')==1)
                                @include('konsultan.template-komponen.tambah.kelompok-input-angka-keterangan')
                            @endif

                            @if (old('jenis_input_keterangan')==2)
                                @include('konsultan.template-komponen.tambah.kelompok-input-text-keterangan')
                            @endif

                            @if (old('jenis_input_keterangan')==3)
                                @include('konsultan.template-komponen.tambah.kelompok-input-checkbox-keterangan')
                            @endif

                        </div>                        
                        
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->                       

            <div class="card widget-flat">
                <div class="card-body">
                    <div class="justify-content-end row">
                        <div class="col-9">
                            <input name="parent_id" id="parent_id"  type="hidden" value="{{ $parentId }}">
                            <input name="tlu_master_template_id" id="tlu_master_template_id" type="hidden" value="{{ $tluMasterTemplateId }}">                        
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

    $('#jenis_input_keterangan').select2({
        dropdownParent: $('#staticBackdrop')
    });    

</script>