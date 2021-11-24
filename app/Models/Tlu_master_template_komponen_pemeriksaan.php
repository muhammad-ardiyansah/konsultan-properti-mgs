<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tlu_master_template_komponen_pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_master',
        'aktif',
        'province_code'
    ];

    public function komponenpemeriksaans()
    {
        return $this->hasMany(Template_komponen_pemeriksaan::class, 'tlu_master_template_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\Province', 'province_code', 'code');
    }

}
