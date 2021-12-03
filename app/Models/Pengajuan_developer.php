<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Carbon;


class Pengajuan_developer extends Model implements Auditable
{
    use HasFactory;
    use Sortable;
    use \OwenIt\Auditing\Auditable;
    public $sortable = ['kode_pengajuan','perumahan_developer.nama_perumahan','blok_rumah','timestamp_pengajuan'];

    protected $fillable = [
        'kode_pengajuan', 
        'no_registrasi', 
        'developer_id', 
        'tlu_fungsi_bangunan_id', 
        'tlu_tipe_rumah_id', 
        'luas_tanah', 
        'posisi_koordinat', 
        'klasifikasi_kompleksitas', 
        'ketinggian_bangunan', 
        'jumlah_lantai', 
        'luas_lantai', 
        'blok_rumah', 
        'perumahan_developer_id', 
        'rumah_sample', 
        'harga_jual_per_unit', 
        'sertifikat_hak_atas_tanah', 
        'izin_pemanfataan_tanah', 
        'pengesahan_site_plan', 
        'nomor_imb', 
        'jenis_nomor_izin_lainnya', 
        'nomor_izin_lainnya', 
        'pengajuan_ke_apersi', 
        'province_code_apersi',
        'tlu_sts_peng_dev_id', 
        'biaya_jasa_total',
        'timestamp_pengajuan',
        'ijin_edit',
    ];    

    public function getTimestampPengajuanAttribute() {
        return Carbon::parse($this->attributes['timestamp_pengajuan'])
        ->translatedFormat('d-M-Y H:i:s');
        // ->translatedFormat('l, d F Y');
    }

    public function getBlokRumahAttribute() {
        // return  wordwrap('A1,A2,A3,A4,A5,A6,A7', 9, "\n", true);
        return  wordwrap($this->attributes['blok_rumah'], 9, "\n", true);
        // return strlen($this->attributes['blok_rumah']);
        // return $this->attributes['blok_rumah'];
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function perumahan_developer()
    {
        return $this->belongsTo(Perumahan_developer::class);
    }

    public function tlu_status_pengajuan_developer()
    {
        return $this->belongsTo(Tlu_status_pengajuan_developer::class, 'tlu_sts_peng_dev_id', 'id');
    }

    public function province_apersi()
    {
        return $this->belongsTo('Laravolt\Indonesia\Models\Province', 'province_code_apersi', 'code')->withDefault();
    }

}
