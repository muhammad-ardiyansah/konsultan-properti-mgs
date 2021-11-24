<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template_struktural_fondasi extends Model
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
        'label_1',
        'list_data_input_pengukuran_1',
        'grup_checkbox_1_tanpa_label',
        'jenis_input_pengukuran_2',
        'input_pengukuran_2_sbg_baris_baru',
        'satuan_input_pengukuran_2',
        'label_2',
        'list_data_input_pengukuran_2',
        'grup_checkbox_2_tanpa_label',
        'jenis_input_pengukuran_3',
        'input_pengukuran_3_sbg_baris_baru',
        'satuan_input_pengukuran_3',
        'label_3',
        'list_data_input_pengukuran_3', 
        'grup_checkbox_3_tanpa_label',       
        'jenis_input_pengukuran_4',
        'input_pengukuran_4_sbg_baris_baru',
        'satuan_input_pengukuran_4',
        'label_4',
        'list_data_input_pengukuran_4', 
        'grup_checkbox_4_tanpa_label',
        'print_on_template'
    
    ];

    public function tlumastertemplate()
    {
        return $this->belongsTo(Tlu_master_template_komponen_pemeriksaan::class, 'tlu_master_template_id');
    }    
    
    public function subtemplatestrukturalfondasi(){
        return $this->hasMany('App\Models\Template_struktural_fondasi', 'parent_id');
    }

}
