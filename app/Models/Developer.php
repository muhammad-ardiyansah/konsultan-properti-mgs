<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Developer extends Model
{
    use HasFactory;
    use Sortable;
    public $sortable = ['nama_perusahaan','created_at'];


    protected $fillable = [
        'nama_perusahaan',
        'nama_direktur',
        'no_kta_apersi',
        'province_code',
        'alamat',
        'no_hp',
        'email'
    ];

    public function users() 
    {
        return $this->belongsToMany(User::class);
    }    

    public function pengajuan_developers()
    {
        // return $this->hasMany(Template_komponen_pemeriksaan::class, 'tlu_master_template_id', 'id');
        return $this->hasMany(Pengajuan_developer::class);
    }

    public function dpd_apersi()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\Province', 'province_code', 'code')->withDefault();
    }

}
