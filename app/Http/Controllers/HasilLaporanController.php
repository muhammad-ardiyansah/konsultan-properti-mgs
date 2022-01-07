<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilLaporan;
use Illuminate\Support\Facades\Storage;

class HasilLaporanController extends Controller
{
    //

    public static function getIdHasilLaporan($pengajuanDeveloperId, $pengajuanDeveloperDetailId, $param) {
        $hasilLaporan = HasilLaporan::where('pengajuan_developer_id', $pengajuanDeveloperId)
        ->where('pengajuan_developer_detail_id', $pengajuanDeveloperDetailId)
        ->where('param', $param)->first();

        // if ($hasilLaporan->count() > 0){
        if (!empty($hasilLaporan)) {
            return $hasilLaporan->id;
        }
        return '';

    }
    
    public static function getFilenameHasilLaporan($pengajuanDeveloperId, $pengajuanDeveloperDetailId, $param) {
        $hasilLaporan = HasilLaporan::where('pengajuan_developer_id', $pengajuanDeveloperId)
        ->where('pengajuan_developer_detail_id', $pengajuanDeveloperDetailId)
        ->where('param', $param)->first();

        // if ($hasilLaporan->count() > 0){
        if (!empty($hasilLaporan)) {
            return $hasilLaporan->nama_file;
        }    

        return '';

    }

    function getLaporan($filename){
        // $file = Storage::disk('public')->get('/hasil_laporan/'.$filename);
        $file = public_path(). "/hasil_laporan/".$filename;
  
        return $file;
        // return (new Response($file, 200))
        //       ->header('Content-Type', 'image/jpeg');
    }


}
