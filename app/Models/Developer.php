<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan',
        'nama_direktur',
        'no_kta_apersi',
        'province_code',
        'alamat',
        'no_hp',
        'user_id'
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
