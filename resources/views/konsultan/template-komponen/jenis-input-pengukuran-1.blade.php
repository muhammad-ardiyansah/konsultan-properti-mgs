@if ($subtemplatekomponen->text_sebelum_input_pengukuran_1)
    <div class="col-12">
        {{ $subtemplatekomponen->text_sebelum_input_pengukuran_1 }}
    </div>
@endif

@if ($subtemplatekomponen->jenis_input_pengukuran_1 == 1)
    <div class="col-8">                               
        <input type="text" class="form-control font-12 input_angka_pengukuran_1" name="input_angka_pengukuran_1[]" placeholder="" @error('input_angka_pengukuran_1') required @enderror value="" >
        @error('input_angka_pengukuran_1')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
        @enderror
    </div>
@endif

@if ($subtemplatekomponen->jenis_input_pengukuran_1 == 2)
    <div class="col-8">
        <input type="text" class="form-control font-12 input_text_pengukuran_1" name="input_text_pengukuran_1[]" placeholder="" @error('input_text_pengukuran_1') required @enderror value="" >
        @error('input_text_pengukuran_1')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
        @enderror
    </div>
@endif

@if ($subtemplatekomponen->jenis_input_pengukuran_1 == 3)

    @php
        $lists = explode(",",$subtemplatekomponen->list_data_input_pengukuran_1);
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


@if ($subtemplatekomponen->satuan_input_pengukuran_1)
    {{ $subtemplatekomponen->satuan_input_pengukuran_1 }}
@endif