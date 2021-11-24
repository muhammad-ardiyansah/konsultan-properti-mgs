<div class="card border-secondary border">
    <div class="card-body">

        <div class="row mb-3">
            <label for="satuan_input_pengukuran_1" class="col-3 col-form-label">Satuan Input Pengukuran 1</label>
            <div class="col-9">    
                <select class="form-control select2" name="satuan_input_pengukuran_1" id="satuan_input_pengukuran_1" data-toggle="select2" >
                    <option value="">Tidak punya satuan</option>
                    @foreach ($tluSatuanInputPengukurans as $id => $lambang)
                        <option value="{{ $lambang }}" {{ $lambang == old('satuan_input_pengukuran_1') ? "selected" : "" }}>{{ $lambang }}</option>
                    @endforeach
                </select>          
                @error('satuan_input_pengukuran_1')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>                      
        </div>

    </div> <!-- end card-body-->
</div> <!-- end card-->        

<script>
    $('#satuan_input_pengukuran_1').select2({
        dropdownParent: $('#staticBackdrop')
    });    
</script>    