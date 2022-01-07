<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Tlu_no_rekening extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'tlu_bank_id',
        'no_rekening',
        'nama_pemilik_rekening',
    ];

    public function tlu_bank() 
    {
        return $this->belongsTo(Tlu_bank::class);
    }    

}
