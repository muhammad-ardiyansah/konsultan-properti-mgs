<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Pengajuan_developer_detail extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'pengajuan_developer_id',
        'developer_id',
        'perumahan_developer_id',
        'blok_rumah',
        'tlu_sts_peng_blk_rmh_id',
        'keterangan',
        'biaya_jasa_per_unit' 
    ];    
}
