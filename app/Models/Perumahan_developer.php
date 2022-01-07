<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Perumahan_developer extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'developer_id',
        'nama_perumahan',
        'province_code',
        'city_code',
        'district_code',
        'village_code',
        'kampung',
        'alamat'
    ];

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function province()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\Province', 'province_code', 'code');
    }

    public function city()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\City', 'city_code', 'code');
    }

    public function district()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\District', 'district_code', 'code');
    }
    
    public function village()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\Village', 'village_code', 'code');
    }    

    public function pengajuan_developers()
    {
        // return $this->hasMany(Template_komponen_pemeriksaan::class, 'tlu_master_template_id', 'id');
        return $this->hasMany(Pengajuan_developer::class);
    }    

}
