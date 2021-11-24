@if ($subtemplatekomponen->text_sebelum_input_pengukuran_2)
    <div class="col-12">
        {{ $subtemplatekomponen->text_sebelum_input_pengukuran_2 }}
    </div>    
@endif

@if ($subtemplatekomponen->jenis_input_pengukuran_2 == 1)
    <div class="col-8">                               
        <input type="text" class="form-control font-12 input_angka_pengukuran_2" name="input_angka_pengukuran_2[]" placeholder="" @error('input_angka_pengukuran_2') required @enderror value="" >
        @error('input_angka_pengukuran_2')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
        @enderror
    </div>
@endif

@if ($subtemplatekomponen->jenis_input_pengukuran_2 == 2)
    <div class="col-8">
        <input type="text" class="form-control font-12 input_text_pengukuran_2" name="input_text_pengukuran_2[]" placeholder="" @error('input_text_pengukuran_2') required @enderror value="" >
        @error('input_text_pengukuran_2')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
        @enderror
    </div>
@endif

@if ($subtemplatekomponen->jenis_input_pengukuran_2 == 3)

    @php
        $lists = explode(",",$subtemplatekomponen->list_data_input_pengukuran_2);
        //print_r($lists);
    @endphp

    @foreach ($lists as $list)
        <div class="col-12">
            <div class="form-check mb-2">
                <input type="checkbox" class="form-check-input" id="customCheckcolor1" >
                <label class="form-check-label" for="customCheckcolor1">{{ $list }}</label>
            </div>
        </div>    
    @endforeach

@endif        


@if ($subtemplatekomponen->satuan_input_pengukuran_2)
    {{ $subtemplatekomponen->satuan_input_pengukuran_2 }}
@endif
