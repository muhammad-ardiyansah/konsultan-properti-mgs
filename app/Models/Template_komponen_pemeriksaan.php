<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template_komponen_pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'tlu_master_template_id',
        'no_komponen',
        'nama_komponen',
        'text_komponen',
        'jenis_input_pengukuran_1',
        'satuan_input_pengukuran_1',
        'text_sebelum_input_pengukuran_1',
        'list_data_input_pengukuran_1',
        'jenis_input_pengukuran_2',
        'input_pengukuran_2_sbg_baris_baru',
        'satuan_input_pengukuran_2',
        'text_sebelum_input_pengukuran_2',
        'list_data_input_pengukuran_2',
        'jenis_input_pengukuran_3',
        'input_pengukuran_3_sbg_baris_baru',
        'satuan_input_pengukuran_3',
        'text_sebelum_input_pengukuran_3',
        'list_data_input_pengukuran_3',
        'checklist_kesesuaian',
        'jenis_input_keterangan',
        'satuan_input_keterangan',
        'text_sebelum_input_keterangan',
        'list_data_input_keterangan',        
    ];
    
    public function tlumastertemplate()
    {
        return $this->belongsTo(Tlu_master_template_komponen_pemeriksaan::class, 'tlu_master_template_id');
    }    
    
    public function subtemplatekomponen(){
        return $this->hasMany('App\Models\Template_komponen_pemeriksaan', 'parent_id');
    }

}
