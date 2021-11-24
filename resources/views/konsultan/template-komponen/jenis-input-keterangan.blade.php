@if ($subtemplatekomponen->text_sebelum_input_keterangan)
    <div class="col-12">
        {{ $subtemplatekomponen->text_sebelum_input_keterangan }}
    </div>
@endif

@if ($subtemplatekomponen->jenis_input_keterangan == 1)
    <div class="col-8">                               
        <input type="text" class="form-control font-12 input_angka_keterangan" name="input_angka_keterangan[]" placeholder="" @error('input_angka_keterangan') required @enderror value="" >
        @error('input_angka_keterangan')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
        @enderror
    </div>
@endif

@if ($subtemplatekomponen->jenis_input_keterangan == 2)
    <div class="col-8">
        <input type="text" class="form-control font-12 input_text_keterangan" name="input_text_keterangan[]" placeholder="" @error('input_text_keterangan') required @enderror value="" >
        @error('input_text_keterangan')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
        @enderror
    </div>
@endif

@if ($subtemplatekomponen->jenis_input_keterangan == 3)

    @php
        $lists = explode(",",$subtemplatekomponen->list_data_input_keterangan);
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


@if ($subtemplatekomponen->satuan_input_keterangan)
    {{ $subtemplatekomponen->satuan_input_keterangan }}
@endif