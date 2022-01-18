<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Kyslik\ColumnSortable\Sortable;


class Invoice_header extends Model implements Auditable
{
    use HasFactory;
    use Sortable;
    use \OwenIt\Auditing\Auditable;
    public $sortable = ['no_invoice','invoice_date', 'invoice_due_date'];

    protected $fillable = [ 
        'developer_id',
        'pengajuan_developer_id', 
        'no_invoice', 
        'nama_perusahaan', 
        'no_telpon', 
        'nama', 
        'alamat', 
        'npwp', 
        'ktp_nik', 
        'email',
        'referensi',
        'no_referensi',
        'keterangan',
        'blok_invoice',
        'invoice_date',
        'invoice_due_date', 
        'kode_unik',
        'jumlah_tagihan',
        'total_tagihan'
    ];    

    public function pengajuan_developer()
    {
        return $this->belongsTo(Pengajuan_developer::class);
    }

}
