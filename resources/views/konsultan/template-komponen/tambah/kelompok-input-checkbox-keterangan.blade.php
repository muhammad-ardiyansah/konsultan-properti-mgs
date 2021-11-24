<div class="card border-secondary border">
    <div class="card-body">

        <div class="row mb-3">
            <label for="text_sebelum_input_keterangan" class="col-3 col-form-label">Text Sebelum Input Keterangan</label>
            <div class="col-9">
                <input type="text" class="form-control" id="text_sebelum_input_keterangan" name="text_sebelum_input_keterangan" placeholder="" value="{{ old('text_sebelum_input_keterangan') }}" >
                @error('text_sebelum_input_keterangan')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="list_data_input_keterangan" class="col-3 col-form-label">List data</label>
            <div class="col-9">    
                <select class="form-control select2" name="list_data_input_keterangan" id="list_data_input_keterangan" data-toggle="select2">
                <option value="">[- Pilih List -]</option>
                    @foreach ($tluListCheckboxes as $id => $list_checkbox)
                        <option value="{{ $list_checkbox }}" {{ $list_checkbox == old('list_data_input_keterangan') ? "selected" : "" }}>{{ $list_checkbox }}</option>
                    @endforeach
                </select>          
                @error('list_data_input_keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>                      
        </div>

    </div> <!-- end card-body-->
</div> <!-- end card-->        

<script>
    $('#list_data_input_keterangan').select2({
        dropdownParent: $('#staticBackdrop')
    });
</script>