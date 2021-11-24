<div class="card border-secondary border">
    <div class="card-body">

        <div class="row mb-3">
            <label for="list_data_input_pengukuran_1" class="col-3 col-form-label">List data pengukuran 1</label>
            <div class="col-9">    
                <select class="form-control select2" name="list_data_input_pengukuran_1" id="list_data_input_pengukuran_1" data-toggle="select2" >
                <option value="">[- Pilih List -]</option>
                    @foreach ($tluLists as $id => $list)
                        <option value="{{ $list }}" {{ $list == old('list_data_input_pengukuran_1', $templateStrukturalFondasi->list_data_input_pengukuran_1) ? "selected" : "" }}>{{ $list }}</option>
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