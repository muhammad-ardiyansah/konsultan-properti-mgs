<div class="card border-secondary border">
    <div class="card-body">

        <div class="row mb-3">
            <div class="col-3"></div>    

            <div class="col-9">
                <div class="form-check form-checkbox-success mb-2">
                    <input type="checkbox" class="form-check-input" id="input_pengukuran_2_baris_baru" name="input_pengukuran_2_baris_baru"  @if (old('input_pengukuran_2_baris_baru')) checked @endif>
                    <label class="form-check-label" for="input_pengukuran_2_baris_baru">Jadikan input pengukuran 2 sebagai baris baru</label>
                </div>
            </div>    
        </div>    

        <div class="row mb-3">
            <label for="satuan_input_pengukuran_2" class="col-3 col-form-label">Satuan Input Pengukuran 2</label>
            <div class="col-9">    
                <select class="form-control select2" name="satuan_input_pengukuran_2" id="satuan_input_pengukuran_2" data-toggle="select2" >
                    <option value="">Tidak punya satuan</option>
                    @foreach ($tluSatuanInputPengukurans as $id => $lambang)
                        <option value="{{ $lambang }}" {{ $lambang == old('satuan_input_pengukuran_2') ? "selected" : "" }}>{{ $lambang }}</option>
                    @endforeach
                </select>          
                @error('satuan_input_pengukuran_2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>                      
        </div>


        <div class="row mb-3">
            <label for="text_sebelum_input_pengukuran_2" class="col-3 col-form-label">Text Sebelum Input Pengukuran 2</label>
            <div class="col-9">
                <input type="text" class="form-control" id="text_sebelum_input_pengukuran_2" name="text_sebelum_input_pengukuran_2" placeholder="" value="{{ old('text_sebelum_input_pengukuran_2') }}" >
                @error('text_sebelum_input_pengukuran_2')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

    </div> <!-- end card-body-->
</div> <!-- end card-->        

<script>
    $('#satuan_input_pengukuran_2').select2({
        dropdownParent: $('#staticBackdrop')
    });    
</script>    