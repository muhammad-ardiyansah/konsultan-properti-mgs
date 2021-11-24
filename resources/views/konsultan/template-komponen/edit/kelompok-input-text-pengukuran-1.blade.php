<div class="card border-secondary border">
    <div class="card-body">

        <div class="row mb-3">
            <label for="text_sebelum_input_pengukuran_1" class="col-3 col-form-label">Text Sebelum Input Pengukuran 1</label>
            <div class="col-9">
                <input type="text" class="form-control" id="text_sebelum_input_pengukuran_1" name="text_sebelum_input_pengukuran_1" placeholder="" value="{{ old('text_sebelum_input_pengukuran_1', $templateKomponenPemeriksaan->text_sebelum_input_pengukuran_1) }}" >
                @error('text_sebelum_input_pengukuran_1')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

    </div> <!-- end card-body-->
</div> <!-- end card-->        
    