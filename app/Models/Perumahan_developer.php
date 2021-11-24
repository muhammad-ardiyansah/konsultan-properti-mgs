<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perumahan_developer extends Model
{
    use HasFactory;

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

    

}
