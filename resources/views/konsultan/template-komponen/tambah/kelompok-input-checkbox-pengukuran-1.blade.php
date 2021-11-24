<div class="card border-secondary border">
    <div class="card-body">

        <div class="row mb-3">
            <label for="text_sebelum_input_pengukuran_1" class="col-3 col-form-label">Text Sebelum Input Pengukuran 1</label>
            <div class="col-9">
                <input type="text" class="form-control" id="text_sebelum_input_pengukuran_1" name="text_sebelum_input_pengukuran_1" placeholder="" value="{{ old('text_sebelum_input_pengukuran_1') }}" >
                @error('text_sebelum_input_pengukuran_1')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="list_data_input_pengukuran_1" class="col-3 col-form-label">List data</label>
            <div class="col-9">    
                <select class="form-control select2" name="list_data_input_pengukuran_1" id="list_data_input_pengukuran_1" data-toggle="select2" >
                <option value="">[- Pilih List -]</option>
                    @foreach ($tluListCheckboxes as $id => $list_checkbox)
                        <option value="{{ $list_checkbox }}" {{ $list_checkbox == old('list_data_input_pengukuran_1') ? "selected" : "" }}>{{ $list_checkbox }}</option>
                    @endforeach
                </select>          
                @error('list_data_input_pengukuran_1')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>                      
        </div>

    </div> <!-- end card-body-->
</div> <!-- end card-->        
    
<script>
    $('#list_data_input_pengukuran_1').select2({
        dropdownParent: $('#staticBackdrop')
    });
</script>