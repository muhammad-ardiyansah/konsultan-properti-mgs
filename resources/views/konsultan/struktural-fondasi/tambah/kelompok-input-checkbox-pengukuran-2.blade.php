<div class="card border-secondary border">
    <div class="card-body">
        
        {{-- 
        <div class="row mb-3">
            <div class="col-3"></div>    

            <div class="col-9">
                <div class="form-check form-checkbox-success mb-2">
                    <input type="checkbox" class="form-check-input" id="input_pengukuran_2_baris_baru" name="input_pengukuran_2_baris_baru" @if (old('input_pengukuran_2_baris_baru')) checked @endif>
                    <label class="form-check-label" for="input_pengukuran_2_baris_baru">Jadikan input pengukuran 2 sebagai baris baru</label>
                </div>
            </div>    
        </div>    
        --}}     

        <div class="row mb-3">
            <label for="list_data_input_pengukuran_2" class="col-3 col-form-label">List data</label>
            <div class="col-9">    
                <select class="form-control select2" name="list_data_input_pengukuran_2" id="list_data_input_pengukuran_2" data-toggle="select2" >
                <option value="">[- Pilih List -]</option>
                    @foreach ($tluLists as $id => $list)
                        <option value="{{ $list }}" {{ $list == old('list_data_input_pengukuran_2') ? "selected" : "" }}>{{ $list }}</option>
                    @endforeach
                </select>          
                @error('list_data_input_pengukuran_2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>                      
        </div>
            

    </div> <!-- end card-body-->
</div> <!-- end card-->        

<script>
    $('#list_data_input_pengukuran_2').select2({
        dropdownParent: $('#staticBackdrop')
    });
</script>