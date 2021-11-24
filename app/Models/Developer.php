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

}
