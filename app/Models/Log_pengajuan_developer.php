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
        'catatan',
        'id_status_peng_dev', 
        'nama_status_peng_dev',
        'keterangan_status_peng_dev',
        'role_status_peng_dev',
        'pengajuan_ke_apersi',
        'user_id'
    ];    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
