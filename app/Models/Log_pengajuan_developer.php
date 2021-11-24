<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_pengajuan_developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_developer_id', 
        'developer_id', 
        'perumahan_developer_id', 
        'timestamp', 
        'tlu_sts_peng_dev_id', 
        'keterangan', 
        'pengajuan_ke_apersi',
        'user_id'
    ];    

}
