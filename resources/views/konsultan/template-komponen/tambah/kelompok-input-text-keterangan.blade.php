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

    </div> <!-- end card-body-->
</div> <!-- end card-->        
    