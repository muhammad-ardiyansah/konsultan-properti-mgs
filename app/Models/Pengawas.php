<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Pengawas extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'no_register',
        'nama_perusahaan',
        'email',
        'nama_direktur',
        'nama_penanggung_jawab',
        'province_code',
        'city_code',
        'district_code',
        'alamat',
        'no_telpon'
    ];

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

}
