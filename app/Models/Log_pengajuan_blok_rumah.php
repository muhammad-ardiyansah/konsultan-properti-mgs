<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_pengajuan_blok_rumah extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_developer_id',
        'pengajuan_developer_detail_id', 
        'developer_id', 
        'perumahan_developer_id', 
        'blok_rumah',
        'timestamp', 
        'catatan',
        'id_status_blok_rumah', 
        'nama_status_blok_rumah',
        'role_status_blok_rumah',
        'user_id'
    ];    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
