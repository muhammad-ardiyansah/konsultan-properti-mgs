<div class="card border-secondary border">
    <div class="card-body">

        <div class="row mb-3">
            <label for="satuan_input_keterangan" class="col-3 col-form-label">Satuan Input Keterangan</label>
            <div class="col-9">    
                <select class="form-control select2" name="satuan_input_keterangan" id="satuan_input_keterangan" data-toggle="select2">
                    <option value="">Tidak punya satuan</option>
                    @foreach ($tluSatuanInputPengukurans as $id => $lambang)
                        <option value="{{ $lambang }}" {{ $lambang == old('satuan_input_keterangan', $templateKomponenPemeriksaan->satuan_input_keterangan) ? "selected" : "" }}>{{ $lambang }}</option>
                    @endforeach
                </select>          
                @error('satuan_input_keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>                      
        </div>


        <div class="row mb-3">
            <label for="text_sebelum_input_keterangan" class="col-3 col-form-label">Text Sebelum Input Keterangan</label>
            <div class="col-9">
                <input type="text" class="form-control" id="text_sebelum_input_keterangan" name="text_sebelum_input_keterangan" placeholder="" value="{{ old('text_sebelum_input_keterangan', $templateKomponenPemeriksaan->text_sebelum_input_keterangan) }}" >
                @error('text_sebelum_input_keterangan')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

    </div> <!-- end card-body-->
</div> <!-- end card-->        

<script>
    $('#satuan_input_keterangan').select2({
        dropdownParent: $('#staticBackdrop')
    });    
</script>    