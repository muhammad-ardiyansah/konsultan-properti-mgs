<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'alamat',
        'no_telpon'
    ];

    public function users() 
    {
        return $this->belongsToMany(User::class);
    }

}
