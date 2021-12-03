<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpd extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'province_code',
        'alamat',
        'no_telpon'
    ];    

    public function users() 
    {
        return $this->belongsToMany(User::class);
    }    

}
