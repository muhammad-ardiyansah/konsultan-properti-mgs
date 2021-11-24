
<div class="row mb-3">
    {{--
    @if ($templateStrukturalFondasi->text_sebelum_input_pengukuran_1)
        <div class="col-12">
            {{ $templateStrukturalFondasi->text_sebelum_input_pengukuran_1 }}
        </div>
    @endif
    --}}

    @if ($templateStrukturalFondasi->jenis_input_pengukuran_1 == 1)
        <div class="col-12">                               
            <input type="text" class="form-control font-12 input_angka_pengukuran_1" name="input_angka_pengukuran_1[]" placeholder="" @error('input_angka_pengukuran_1') required @enderror value="" >
            @error('input_angka_pengukuran_1')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            @enderror
        </div>
    @endif

    @if ($templateStrukturalFondasi->jenis_input_pengukuran_1 == 2)
        <div class="col-12">
            <input type="text" class="form-control font-12 input_text_pengukuran_1" name="input_text_pengukuran_1[]" placeholder="" @error('input_text_pengukuran_1') required @enderror value="" >
            @error('input_text_pengukuran_1')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            @enderror
        </div>
    @endif

    @if ($templateStrukturalFondasi->jenis_input_pengukuran_1 == 3)

        @php
            $lists = explode(",",$templateStrukturalFondasi->list_data_input_pengukuran_1);
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

    @if ($templateStrukturalFondasi->jenis_input_pengukuran_1 == 4)
        @php
            if(strpos($templateStrukturalFondasi->list_data_input_pengukuran_1, '|') !== false){
                $lists = explode("|",$templateStrukturalFondasi->list_data_input_pengukuran_1);
            }else{
                $lists = explode(",",$templateStrukturalFondasi->list_data_input_pengukuran_1);
            }  
            //print_r($lists);  
        @endphp


        <div class="col-12">    
            <select class="form-control select2" name="input_list_pengukuran_1" id="input_list_pengukuran_1" data-toggle="select2" @error('input_list_pengukuran_1') required @enderror >
                @foreach ($lists as $list)
                    <option value="{{ $list }}" {{ $list == old('input_list_pengukuran_1') ? "selected" : "" }}>{{ $list }}</option>
                @endforeach
            </select>          
        </div>

    @endif

    @if ($templateStrukturalFondasi->satuan_input_pengukuran_1)
        {{ $templateStrukturalFondasi->satuan_input_pengukuran_1 }}
    @endif
</div>

<script>
    $('#input_list_pengukuran_1').select2({
        dropdownParent: $('.content')
    });    
</script> 
