@foreach($subtemplatekomponens as $subtemplatekomponen)
<tr>
    <td class="text-center">
        {{ $subtemplatekomponen->no_komponen }}
        <input name="id" class="id"  type="hidden" value="{{ $subtemplatekomponen->id }}">
        <input name="parent_id_temp" class="parent_id_temp"  type="hidden" value="{{ $subtemplatekomponen->id }}">

        <input name="tlu_master_template_id[]" class="tlu_master_template_id"  type="hidden" value="{{ $subtemplatekomponen->tlu_master_template_id }}">
        <input name="no_komponen[]" class="no_komponen"  type="hidden" value="{{ $subtemplatekomponen->no_komponen }}">
        <input name="nama_komponen[]" class="nama_komponen"  type="hidden" value="{{ $subtemplatekomponen->nama_komponen }}">
        <input name="text_komponen[]" class="text_komponen"  type="hidden" value="{{ $subtemplatekomponen->text_komponen }}">
        
        <input name="jenis_input_pengukuran_1[]" class="jenis_input_pengukuran_1"  type="hidden" value="{{ $subtemplatekomponen->jenis_input_pengukuran_1 }}">
        <input name="satuan_input_pengukuran_1[]" class="satuan_input_pengukuran_1"  type="hidden" value="{{ $subtemplatekomponen->satuan_input_pengukuran_1 }}">
        <input name="text_sebelum_input_pengukuran_1[]" class="text_sebelum_input_pengukuran_1"  type="hidden" value="{{ $subtemplatekomponen->text_sebelum_input_pengukuran_1 }}">
        <input name="list_data_input_pengukuran_1[]" class="list_data_input_pengukuran_1"  type="hidden" value="{{ $subtemplatekomponen->list_data_input_pengukuran_1 }}">

        <input name="jenis_input_pengukuran_2[]" class="jenis_input_pengukuran_2"  type="hidden" value="{{ $subtemplatekomponen->jenis_input_pengukuran_2 }}">
        <input name="satuan_input_pengukuran_2[]" class="satuan_input_pengukuran_2"  type="hidden" value="{{ $subtemplatekomponen->satuan_input_pengukuran_2 }}">
        <input name="input_pengukuran_2_sbg_baris_baru[]" class="input_pengukuran_2_sbg_baris_baru"  type="hidden" value="{{ $subtemplatekomponen->input_pengukuran_2_sbg_baris_baru }}">
        <input name="text_sebelum_input_pengukuran_2[]" class="text_sebelum_input_pengukuran_2"  type="hidden" value="{{ $subtemplatekomponen->text_sebelum_input_pengukuran_2 }}">
        <input name="list_data_input_pengukuran_2[]" class="list_data_input_pengukuran_2"  type="hidden" value="{{ $subtemplatekomponen->list_data_input_pengukuran_2 }}">                    
    
        <input name="jenis_input_pengukuran_3[]" class="jenis_input_pengukuran_3"  type="hidden" value="{{ $subtemplatekomponen->jenis_input_pengukuran_3 }}">
        <input name="satuan_input_pengukuran_3[]" class="satuan_input_pengukuran_3"  type="hidden" value="{{ $subtemplatekomponen->satuan_input_pengukuran_3 }}">
        <input name="input_pengukuran_3_sbg_baris_baru[]" class="input_pengukuran_3_sbg_baris_baru"  type="hidden" value="{{ $subtemplatekomponen->input_pengukuran_3_sbg_baris_baru }}">
        <input name="text_sebelum_input_pengukuran_3[]" class="text_sebelum_input_pengukuran_3"  type="hidden" value="{{ $subtemplatekomponen->text_sebelum_input_pengukuran_3 }}">
        <input name="list_data_input_pengukuran_3[]" class="list_data_input_pengukuran_3"  type="hidden" value="{{ $subtemplatekomponen->list_data_input_pengukuran_3 }}">
        
        <input name="checklist_kesesuaian[]" class="checklist_kesesuaian"  type="hidden" value="{{ $subtemplatekomponen->checklist_kesesuaian }}">

        <input name="jenis_input_keterangan[]" class="jenis_input_keterangan"  type="hidden" value="{{ $subtemplatekomponen->jenis_input_keterangan }}">
        <input name="satuan_input_keterangan[]" class="satuan_input_keterangan"  type="hidden" value="{{ $subtemplatekomponen->satuan_input_keterangan }}">
        <input name="text_sebelum_input_keterangan[]" class="text_sebelum_input_keterangan"  type="hidden" value="{{ $subtemplatekomponen->text_sebelum_input_keterangan }}">
        <input name="list_data_input_keterangan[]" class="list_data_input_keterangan"  type="hidden" value="{{ $subtemplatekomponen->list_data_input_keterangan }}">                            
        
    </td>
    <td>{{ $subtemplatekomponen->nama_komponen }}</td>
    <td> 
        @if ($subtemplatekomponen->parent_id && $subtemplatekomponen->jenis_pengukuran_1 == 0 && $subtemplatekomponen->jenis_pengukuran_2 == 0 && $subtemplatekomponen->jenis_pengukuran_3 == 0)
            <div class="text-center">
                -
            </div>    
        @else
                
            <div class="row mb-3">    
                
                @include('konsultan.template-komponen.jenis-input-pengukuran-1', ['subtemplatekomponen' => $subtemplatekomponen])

                @if (!$subtemplatekomponen->input_pengukuran_2_sbg_baris_baru)
                    @include('konsultan.template-komponen.jenis-input-pengukuran-2', ['subtemplatekomponen' => $subtemplatekomponen])
                @endif

                @if (!$subtemplatekomponen->input_pengukuran_3_sbg_baris_baru)
                    @include('konsultan.template-komponen.jenis-input-pengukuran-3', ['subtemplatekomponen' => $subtemplatekomponen])
                @endif                

            </div>    

            @if ($subtemplatekomponen->input_pengukuran_2_sbg_baris_baru)
                <div class="row mb-3">
                    @include('konsultan.template-komponen.jenis-input-pengukuran-2', ['subtemplatekomponen' => $subtemplatekomponen])
                </div>
            @endif

            @if ($subtemplatekomponen->input_pengukuran_3_sbg_baris_baru)
                <div class="row mb-3">
                    @include('konsultan.template-komponen.jenis-input-pengukuran-3', ['subtemplatekomponen' => $subtemplatekomponen])
                </div>
            @endif 
        
        @endif
    </td>
    <td class="text-center">
        @if ($subtemplatekomponen->checklist_kesesuaian)
             <div class="form-check form-checkbox-success mb-2 text-center">
                <input type="checkbox" class="form-check-input" id="sesuai" name="sesuai" >
            </div>
        @endif
    </td>
    <td>
        @if ($subtemplatekomponen->checklist_kesesuaian)
        <div class="form-check form-checkbox-success mb-2">
            <input type="checkbox" class="form-check-input" id="tidak_sesuai" name="tidak_sesuai" >
        </div>
        @endif
    </td>
    <td class="font-12">
        <div class="row mb-3">
            @include('konsultan.template-komponen.jenis-input-keterangan', ['subtemplatekomponen' => $subtemplatekomponen])
        </div>        
    </td>
    <td class="table-action text-center">
        <a href="{{ route('konsultan.tambahTemplateKomponenPemeriksaan', ['tlu_master_template_id'=> $subtemplatekomponen->tlu_master_template_id, 'parent_id'=> $subtemplatekomponen->id]) }}" class="action-icon tambah-sub" title="tambah sub komponen"> <i class="mdi mdi-beaker-plus"></i></a>
        <a href="{{ route('konsultan.editTemplateKomponenPemeriksaan', ['id'=> $subtemplatekomponen->id]) }}" class="action-icon edit" title="edit"> <i class="mdi mdi-pencil"></i></a>
        <a href="{{ route('konsultan.deleteTemplateKomponenPemeriksaan', ['id'=> $subtemplatekomponen->id]) }}" class="action-icon delete" title="hapus" > <i class="mdi mdi-delete"></i></a>
    </td>
</tr> 
@if(count($subtemplatekomponen->subtemplatekomponen))
    @include('konsultan.template-komponen.sub-template-komponen-2',['subtemplatekomponens' => $subtemplatekomponen->subtemplatekomponen])
@endif


@endforeach