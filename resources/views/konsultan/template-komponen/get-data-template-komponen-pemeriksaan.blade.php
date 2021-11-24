@if (Session::get('success'))
    <div class="alert alert-success" role="alert">
        <i class="dripicons-checkmark me-2"></i> {{ Session::get('success') }}
    </div>
@endif

@if (Session::get('fail'))
<div class="alert alert-danger" role="alert">
    <i class="dripicons-wrong me-2"></i> {{ Session::get('fail') }}
</div>
@endif

<div class="row mb-3">
    <div class="col-12 text-end">
        <a href="{{ route('konsultan.tambahTemplateKomponenPemeriksaan', ['tlu_master_template_id'=>$tluMasterTemplateId]) }}" id="tambah-header-komponen" class="btn btn-outline-info btn-m ms-3"><i class="mdi mdi-beaker-plus"></i> Tambah Header Komponen</a>
    </div>
</div>

<div class="table-responsive-sm">
                        
    <table class="table table-bordered border-secondary table-centered mb-0">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">No</th>
                <th rowspan="2">Komponen Pemeriksaan</th>
                <th rowspan="2" class="text-center">Hasil Pengukuran Kondisi Faktual</th>
                <th colspan="2" class="text-center">Checklist Kesesuaian Kondisi Faktual Dengan Rencana Teknis dan Gambar Terbangun</th>
                <th rowspan="2" class="text-center">Keterangan</th>
                <th rowspan="2" class="text-center">Action</th>
            </tr>
            <tr>
                <th class="text-center col-1">Sesuai</th>
                <th class="text-center col-1">Tidak Sesuai, yaitu</th>
            </tr>                            
        </thead>
        <tbody>
        @foreach($templateKomponens as $templateKomponen)
            <tr>
                <td class="text-center">
                    <strong>{{ $templateKomponen->no_komponen }}</strong> 
                    
                    <input name="id" class="id"  type="hidden" value="{{ $templateKomponen->id }}">
                    <input name="parent_id_temp" class="parent_id_temp"  type="hidden" value="{{ $templateKomponen->id }}">

                    <input name="tlu_master_template_id[]" class="tlu_master_template_id"  type="hidden" value="{{ $templateKomponen->tlu_master_template_id }}">
                    <input name="no_komponen[]" class="no_komponen"  type="hidden" value="{{ $templateKomponen->no_komponen }}">
                    <input name="nama_komponen[]" class="nama_komponen"  type="hidden" value="{{ $templateKomponen->nama_komponen }}">
                    <input name="text_komponen[]" class="text_komponen"  type="hidden" value="{{ $templateKomponen->text_komponen }}">
                    
                    <input name="jenis_input_pengukuran_1[]" class="jenis_input_pengukuran_1"  type="hidden" value="{{ $templateKomponen->jenis_input_pengukuran_1 }}">
                    <input name="satuan_input_pengukuran_1[]" class="satuan_input_pengukuran_1"  type="hidden" value="{{ $templateKomponen->satuan_input_pengukuran_1 }}">
                    <input name="text_sebelum_input_pengukuran_1[]" class="text_sebelum_input_pengukuran_1"  type="hidden" value="{{ $templateKomponen->text_sebelum_input_pengukuran_1 }}">
                    <input name="list_data_input_pengukuran_1[]" class="list_data_input_pengukuran_1"  type="hidden" value="{{ $templateKomponen->list_data_input_pengukuran_1 }}">

                    <input name="jenis_input_pengukuran_2[]" class="jenis_input_pengukuran_2"  type="hidden" value="{{ $templateKomponen->jenis_input_pengukuran_2 }}">
                    <input name="satuan_input_pengukuran_2[]" class="satuan_input_pengukuran_2"  type="hidden" value="{{ $templateKomponen->satuan_input_pengukuran_2 }}">
                    <input name="input_pengukuran_2_sbg_baris_baru[]" class="input_pengukuran_2_sbg_baris_baru"  type="hidden" value="{{ $templateKomponen->input_pengukuran_2_sbg_baris_baru }}">
                    <input name="text_sebelum_input_pengukuran_2[]" class="text_sebelum_input_pengukuran_2"  type="hidden" value="{{ $templateKomponen->text_sebelum_input_pengukuran_2 }}">
                    <input name="list_data_input_pengukuran_2[]" class="list_data_input_pengukuran_2"  type="hidden" value="{{ $templateKomponen->list_data_input_pengukuran_2 }}">                    
                
                    <input name="jenis_input_pengukuran_3[]" class="jenis_input_pengukuran_3"  type="hidden" value="{{ $templateKomponen->jenis_input_pengukuran_3 }}">
                    <input name="satuan_input_pengukuran_3[]" class="satuan_input_pengukuran_3"  type="hidden" value="{{ $templateKomponen->satuan_input_pengukuran_3 }}">
                    <input name="input_pengukuran_3_sbg_baris_baru[]" class="input_pengukuran_3_sbg_baris_baru"  type="hidden" value="{{ $templateKomponen->input_pengukuran_3_sbg_baris_baru }}">
                    <input name="text_sebelum_input_pengukuran_3[]" class="text_sebelum_input_pengukuran_3"  type="hidden" value="{{ $templateKomponen->text_sebelum_input_pengukuran_3 }}">
                    <input name="list_data_input_pengukuran_3[]" class="list_data_input_pengukuran_3"  type="hidden" value="{{ $templateKomponen->list_data_input_pengukuran_3 }}">
                    
                    <input name="checklist_kesesuaian[]" class="checklist_kesesuaian"  type="hidden" value="{{ $templateKomponen->checklist_kesesuaian }}">

                    <input name="jenis_input_keterangan[]" class="jenis_input_keterangan"  type="hidden" value="{{ $templateKomponen->jenis_input_keterangan }}">
                    <input name="satuan_input_keterangan[]" class="satuan_input_keterangan"  type="hidden" value="{{ $templateKomponen->satuan_input_keterangan }}">
                    <input name="text_sebelum_input_keterangan[]" class="text_sebelum_input_keterangan"  type="hidden" value="{{ $templateKomponen->text_sebelum_input_keterangan }}">
                    <input name="list_data_input_keterangan[]" class="list_data_input_keterangan"  type="hidden" value="{{ $templateKomponen->list_data_input_keterangan }}">                    
                    


                </td>
                <td colspan="5"><strong>{{ $templateKomponen->nama_komponen }}</strong></td>
                <td class="table-action text-center">
                    <a href="{{ route('konsultan.tambahTemplateKomponenPemeriksaan', ['tlu_master_template_id'=> $templateKomponen->tlu_master_template_id, 'parent_id'=> $templateKomponen->id]) }}" class="action-icon tambah-sub" title="tambah sub komponen"> <i class="mdi mdi-beaker-plus"></i></a>
                    <a href="{{ route('konsultan.editTemplateKomponenPemeriksaan', ['id'=> $templateKomponen->id]) }}" class="action-icon edit" title="edit"> <i class="mdi mdi-pencil"></i></a>
                    <a href="{{ route('konsultan.deleteTemplateKomponenPemeriksaan', ['id'=> $templateKomponen->id]) }}" class="action-icon delete" title="hapus" > <i class="mdi mdi-delete"></i></a>
                </td>
            </tr>
            @if(count($templateKomponen->subtemplatekomponen))
                @include('konsultan.template-komponen.sub-template-komponen-1', ['subtemplatekomponens' => $templateKomponen->subtemplatekomponen])
            @endif
        @endforeach    
        </tbody>
    </table>
    
</div>