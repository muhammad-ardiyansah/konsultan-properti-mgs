<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Invoice_detail extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'invoice_header_id',
        'pengajuan_developer_detail_id',
        'keterangan',
        'harga_satuan' 
    ];    

    public function pengajuan_developer_detail()
    {
        return $this->belongsTo(Pengajuan_developer_detail::class);
    }    

}
