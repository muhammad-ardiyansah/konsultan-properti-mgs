<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal_developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'developer_id',
        'invoice_header_id',
        'pembayaran_id',
        'pengembalian_id',
        'param',
        'jumlah',
        'jumlah_rubah_jadi' 
    ];

}
