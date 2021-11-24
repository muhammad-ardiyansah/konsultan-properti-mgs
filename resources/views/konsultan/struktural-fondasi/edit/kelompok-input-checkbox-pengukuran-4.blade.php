<div class="card border-secondary border">
    <div class="card-body">

        <div class="row mb-3">
            <label for="list_data_input_pengukuran_4" class="col-3 col-form-label">List data pengukuran 4</label>
            <div class="col-9">    
                <select class="form-control select2" name="list_data_input_pengukuran_4" id="list_data_input_pengukuran_4" data-toggle="select2" >
                <option value="">[- Pilih List -]</option>
                    @foreach ($tluLists as $id => $list)
                        <option value="{{ $list }}" {{ $list == old('list_data_input_pengukuran_4', $templateStrukturalFondasi->list_data_input_pengukuran_4) ? "selected" : "" }}>{{ $list }}</option>
                    @endforeach
                </select>          
                @error('list_data_input_pengukuran_4')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>                      
        </div>

    </div> <!-- end card-body-->
</div> <!-- end card-->        
    
<script>
    $('#list_data_input_pengukuran_4').select2({
        dropdownParent: $('#staticBackdrop')
    });
</script>