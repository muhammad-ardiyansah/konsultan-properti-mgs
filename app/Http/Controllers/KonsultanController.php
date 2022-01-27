<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tlu_tipe_rumah;
use App\Models\Dpd;
use App\Models\Developer;
use App\Models\Perumahan_developer;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use App\Models\User;
use App\Models\Tlu_fungsi_bangunan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pengajuan_developer;
use App\Models\Pengajuan_developer_detail;
use App\Models\Tlu_status_pengajuan_developer;
use App\Models\Tlu_status_pengajuan_blok_rumah;
use App\Models\Log_pengajuan_developer;
use App\Models\Log_pengajuan_blok_rumah;
use App\Rules\CheckPengajuanBlokRumah;
use App\Models\Pengawas;
use App\Models\HasilLaporan;
use File;

class KonsultanController extends Controller
{
    //
    function index(){
        // return view('dashboards.admins.index');
        return view('konsultan.dashboard-konsultan');
    }

    public function getPerumahanDevelopers(Request $request) {

        // return 'test';
        // $input = $request->all();        
        // return response()->json($input);

        $data = Perumahan_developer::where('developer_id', $request->developer_id)->pluck('nama_perumahan', 'id');
        return response()->json($data);
    
    }
    
    public function listPengajuan(Request $request) {
        
        // $input = $request->all();        
        // return $input;

        // $user = User::find(Auth::id());
        // $developer = $user->developers()->first();       
        // $developerId = $developer->id;
        $provinces = Province::pluck('name', 'code');
        $developers = Developer::pluck('nama_perusahaan', 'id');
        $perumahanDevelopers = Perumahan_developer::where('developer_id', $request->developer_id)
        ->pluck('nama_perumahan', 'id');

        $statusPengajuanLists = collect([
            ['id' => '11, 61', 'nama_status' => 'Pengajuan Baru'],
            // ['id' => 'Edit Data', 'nama_status' => 'Edit Data'],
            // ['id' => 'Hold/Pending', 'nama_status' => 'Hold/Pending'],
            ['id' => '24', 'nama_status' => 'Menunggu Persetujuan DPD'],
            ['id' => '21', 'nama_status' => 'Ditolak DPD'],
            ['id' => '31', 'nama_status' => 'Disetujui DPD'],
            // ['id' => 'Menunggu Persetujuan DPP', 'nama_status' => 'Menunggu Persetujuan DPP'],
            // ['id' => 'Ditolak DPP', 'nama_status' => 'Ditolak DPP'],
            // ['id' => 'Disetujui DPP', 'nama_status' => 'Disetujui DPP'],    
            // ['id' => 'Menunggu Persetujuan Konsultan', 'nama_status' => 'Menunggu Persetujuan Konsultan'],
            ['id' => '64', 'nama_status' => 'Diproses Konsultan'],
            ['id' => '67', 'nama_status' => 'Ditolak Konsultan'],
            ['id' => '71', 'nama_status' => 'Disetujui Konsultan'],
            // ['id' => '31, 71', 'nama_status' => 'Disetujui DPD dan Disetujui Konsultan'],
            // ['id' => '31, 67', 'nama_status' => 'Disetujui DPD dan Ditolak Konsultan'],                    
        ])->pluck('nama_status', 'id');
        // return $statusPengajuans;
        // return $statusPengajuans->pluck('nama_status', 'id');
        
        // $perPageLists = collect([
        //     ['id' => 1, 'per_page' => '1'],
        //     ['id' => 2, 'per_page' => '2'],
        //     ['id' => 3, 'per_page' => '3'],
        // ])->pluck('per_page', 'id');
        
        $perPageLists = collect([
            // ['id' => 5, 'per_page' => '5'],
            ['id' => 10, 'per_page' => '10'],
            ['id' => 25, 'per_page' => '25'],
            ['id' => 50, 'per_page' => '50'],
            ['id' => 100, 'per_page' => '100'],
        ])->pluck('per_page', 'id');        

        $perPage = $perPageLists->first();
        // print_r($perPage);
        if (!empty($request->data_per_halaman)) {
            $perPage = $request->data_per_halaman;
        }

        DB::enableQueryLog();
        $pengajuanDevelopers = Pengajuan_developer::where([
            // ['pengajuan_developers.developer_id', '=', $developer->id], 
            [function ($query) use ($request) {

                if (!empty($request->kode_pengajuan)) {
                    $query->where('kode_pengajuan', 'LIKE', '%'.$request->kode_pengajuan.'%');
                }

                if ($request->approval ==1){
                    $query->whereNull('province_code_apersi');
                }

                if ($request->approval ==2){
                    $query->whereNotNull('province_code_apersi');

                    if (!empty($request->province_code_apersi)) {
                        $query->where('province_code_apersi', $request->province_code_apersi);
                    }    
                    
                }                

                if (!empty($request->developer_id)) {
                    $query->where('developer_id', $request->developer_id);
                }

                if (!empty($request->perumahan_developer_id)) {
                    $query->where('perumahan_developer_id', $request->perumahan_developer_id);
                }                

                if (!empty($request->blok_rumah)) {

                    $query->where(function($queryOr) use ($request) {
                        // str_replace(find,replace,string,count) 
                        $blokRumahs = str_replace(' ', '', $request->blok_rumah); 
                        $arrBlokRumahs = explode(',', $blokRumahs);
                        foreach($arrBlokRumahs as $arrBlokRumah) {
                            $queryOr->orWhere('blok_rumah', 'LIKE', '%'.$arrBlokRumah.'%');
                        }
                    });

                }                

                if (!empty($request->status_pengajuan)) {
                    $arrStatusPengajuan = explode(',', $request->status_pengajuan);
                    $query->whereIn('tlu_sts_peng_dev_id', $arrStatusPengajuan);
                }

                if (!empty($request->periode_pengajuan)) {
                    $arrPeriodePengajuan = explode('-', $request->periode_pengajuan);
                    $periodePengajuanAwal = \Carbon\Carbon::parse($arrPeriodePengajuan[0]." 00:00:00");
                    $periodePengajuanAkhir = \Carbon\Carbon::parse($arrPeriodePengajuan[1]." 23:59:59");

                    // echo "periodePengajuanAwal : ".$periodePengajuanAwal->format('Y-m-d H:i:s');
                    // echo "<br />";
                    // echo "periodePengajuanAkhir : ".$periodePengajuanAkhir->format('Y-m-d H:i:s');
                    // echo "<br />";

                    $startDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $periodePengajuanAwal->format('Y-m-d H:i:s'));
                    $endDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $periodePengajuanAkhir->format('Y-m-d H:i:s'));
                    
                    // echo $startDate." - ".$endDate;

                     $query->whereBetween('timestamp_pengajuan', [$startDate, $endDate]);
                }
                
            }]
            ])->sortable()->paginate($perPage)->withQueryString();
            // ])->toSql();
            // dd($pengajuanDevelopers);
            // $quries = DB::getQueryLog();
            // dd($quries);
            

        return view('konsultan.list-pengajuan-developer', compact(
            // 'developerId',
            'pengajuanDevelopers',
            'provinces',
            'developers',
            'perumahanDevelopers',
            'statusPengajuanLists',
            'perPageLists'
        ));
    }    

    public function formPengajuan(Request $request) {

        $developers = developer::pluck('nama_perusahaan', 'id');
        $tluTipeRumah = Tlu_tipe_rumah::pluck('tipe_rumah', 'id');
        $tluFungsiBangunan = Tlu_fungsi_bangunan::find(1);
        $provinces = Province::pluck('name', 'code');
        $perumahanDevelopers = Perumahan_developer::where('developer_id', $request->old('developer_id'))->pluck('nama_perumahan', 'id');
        $pengawas = Pengawas::pluck('nama_perusahaan', 'id');
        return view('konsultan.form-pengajuan-developer', compact(
            'developers',
            'tluTipeRumah',
            'tluFungsiBangunan',
            'provinces',
            'perumahanDevelopers', 
            'pengawas'
            )
        );

    }
    
    public function editDataPengajuan(Request $request) {
        // $input = $request->all();
        // return $input;
        return redirect()->route('konsultan.editFormPengajuan', ['id' => $request->id, 'catatan' => $request->catatan]);        
    }

    public function editFormPengajuan(Request $request) {

        // $input = $request->all();
        // return $input;

        $pengajuanDeveloper = Pengajuan_developer::find($request->id);
        $pengajuanDeveloperDetails = Pengajuan_developer_detail::select(['id','blok_rumah'])->where('pengajuan_developer_id', $pengajuanDeveloper->id)->pluck('id', 'blok_rumah')->toJson();
        // return $pengajuanDeveloperDetails;
        $blokRumahOri = $pengajuanDeveloperDetails;
        $catatan = $request->catatan;

        $developers = developer::pluck('nama_perusahaan', 'id');
        $tluTipeRumah = Tlu_tipe_rumah::pluck('tipe_rumah', 'id');
        $tluFungsiBangunan = Tlu_fungsi_bangunan::find(1);
        $provinces = Province::pluck('name', 'code');
        $developerId = $request->old('developer_id') !== null ? $request->old('developer_id') : $pengajuanDeveloper->developer_id;
        $perumahanDevelopers = Perumahan_developer::where('developer_id', $developerId)->pluck('nama_perumahan', 'id');
        $pengawas = Pengawas::pluck('nama_perusahaan', 'id');
        return view('konsultan.edit-pengajuan-developer', compact(
            'pengajuanDeveloper',
            'developers',
            'tluTipeRumah',
            'tluFungsiBangunan',
            'provinces',
            'perumahanDevelopers',
            'blokRumahOri',
            'catatan',
            'pengawas'
            )
        );


    }

    public function simpanPengajuan(Request $request) {

        // $input = $request->all();
        // return $input;

        $currentDateTime = \Carbon\Carbon::now()->toDateTimeString();
        $kodePengajuan =  str_replace("-","",$currentDateTime);
        $kodePengajuan =  str_replace(":","",$kodePengajuan);
        $kodePengajuan =  str_replace(" ","",$kodePengajuan);
        $kodePengajuan = "MGS".$kodePengajuan;
        // dd($kodePengajuan);die;
        // dd($currentDateTime);die;

        $luasTanah = str_replace(".","", $request->input('luas_tanah'));
        $luasTanah = str_replace(",",".", $luasTanah);
        $request->merge(['luas_tanah' => $luasTanah]);

        $ketinggianBangunan = str_replace(".","", $request->input('ketinggian_bangunan'));
        $ketinggianBangunan = str_replace(",",".", $ketinggianBangunan);
        $request->merge(['ketinggian_bangunan' => $ketinggianBangunan]);

        $luasLantai = str_replace(".","", $request->input('luas_lantai'));
        $luasLantai = str_replace(",",".", $luasLantai);
        $request->merge(['luas_lantai' => $luasLantai]);        

        $hargaJualPerUnit = str_replace(".","", $request->input('harga_jual_per_unit'));
        $hargaJualPerUnit = str_replace(",",".", $hargaJualPerUnit);
        $request->merge(['harga_jual_per_unit' => $hargaJualPerUnit]);

        $userId = Auth::id();
        $tluStatusPengajuanDeveloper = Tlu_status_pengajuan_developer::find(61);
        // return $tluStatusPengajuanDeveloper;
        $pengajuanKeApersi = !empty($request->province_code_apersi) ? true : false;


        $request->validate(
            [
                'tlu_fungsi_bangunan_id' => 'required',
                'tlu_tipe_rumah_id'=>'required',
                'luas_tanah'=> 'required|numeric',
                'posisi_koordinat'=>'required',      
                'klasifikasi_kompleksitas'=>'required',        
                'ketinggian_bangunan'=>'required|numeric',
                'jumlah_lantai'=>'required|integer',
                'luas_lantai'=>'required|numeric', 
                // 'blok_rumah'=> 'required',
                'blok_rumah' => ['required', new checkPengajuanBlokRumah($request->developer_id, $request->perumahan_developer_id, $request->id)],
                'developer_id'=> 'required',
                'perumahan_developer_id'=> 'required',
                'rumah_sample'=> 'required',
                'harga_jual_per_unit'=> 'required|integer'
            ], 
            [
                'tlu_fungsi_bangunan_id.required' => 'Fungsi bangunan harus diisi',
                'tlu_tipe_rumah_id.required' => 'Tipe bangunan harus diisi',
                'luas_tanah.required' => 'Luas tanah harus diisi',
                'luas_tanah.numeric' => 'tidak valid',
                'posisi_koordinat.required' => 'Posisi koordinat harus diisi',
                'klasifikasi_kompleksitas.required'=>'Klasifikasi kompleksitas bangunan harus diisi',
                'ketinggian_bangunan.required'=>'Ketinggian bangunan harus diisi',
                'ketinggian_bangunan.numeric'=>'tidak valid',
                'jumlah_lantai.required'=>'Jumlah lantai harus diisi',
                'jumlah_lantai.integer'=>'tidak valid',
                'luas_lantai.required'=>'Luas lantai harus diisi',
                'luas_lantai.numeric'=>'tidak valid',
                'blok_rumah.required'=> 'Blok rumah yang akan diajukan belum diisi',                                
                'developer_id.required' => 'Anda belum memilih developer',
                'perumahan_developer_id.required' => 'Nama perumahan yang diajukan belum dipilih',
                'rumah_sample.required' => 'Rumah sample dari blok rumah yang diajukan belum dipilih',
                'harga_jual_per_unit.required' => 'Harga jual dari per unit rumah yang diajukan belum diisi',
                'harga_jual_per_unit.integer'=>'tidak valid',
            ]
        );
        
        // $input = $request->all();
        // return $input;

        DB::beginTransaction();

        try {       
           
            $newPengajuanDeveloper = Pengajuan_developer::create([
                'kode_pengajuan' => $kodePengajuan,
                // 'no_registrasi' => ,
                'developer_id' => $request->developer_id,
                'tlu_fungsi_bangunan_id' => $request->tlu_fungsi_bangunan_id,
                'tlu_tipe_rumah_id' => $request->tlu_tipe_rumah_id,
                'luas_tanah' =>  $request->luas_tanah, 
                'posisi_koordinat' => $request->posisi_koordinat, 
                'klasifikasi_kompleksitas' => $request->klasifikasi_kompleksitas, 
                'ketinggian_bangunan' => $request->ketinggian_bangunan, 
                'jumlah_lantai' => $request->jumlah_lantai, 
                'luas_lantai' => $request->luas_lantai, 
                'blok_rumah' => $request->blok_rumah, 
                'perumahan_developer_id' => $request->perumahan_developer_id, 
                'rumah_sample' => $request->rumah_sample, 
                'harga_jual_per_unit' => $hargaJualPerUnit, 
                'sertifikat_hak_atas_tanah' => $request->sertifikat_hak_atas_tanah, 
                'izin_pemanfaatan_tanah' => $request->izin_pemanfaatan_tanah, 
                'pengesahan_site_plan' => $request->pengesahan_site_plan, 
                'nomor_imb' => $request->nomor_imb, 
                'jenis_nomor_izin_lainnya' => $request->jenis_nomor_izin_lainnya, 
                'nomor_izin_lainnya' => $request->nomor_izin_lainnya, 
                // 'pengajuan_ke_apersi', 
                'province_code_apersi' => $request->province_code_apersi,
                'tlu_sts_peng_dev_id'=> $tluStatusPengajuanDeveloper->id, 
                // 'biaya_jasa_total',
                'timestamp_pengajuan' => $currentDateTime,   
                'pengawas_id' => $request->pengawas_id              
            ]);
      
            $newLogPengajuanDeveloper = Log_pengajuan_developer::create([
                'pengajuan_developer_id' => $newPengajuanDeveloper->id, 
                'developer_id' => $request->developer_id, 
                'perumahan_developer_id' => $request->perumahan_developer_id, 
                'timestamp' => $currentDateTime, 
                'id_status_peng_dev' => $tluStatusPengajuanDeveloper->id,
                'nama_status_peng_dev' => $tluStatusPengajuanDeveloper->nama_status,
                'keterangan_status_peng_dev' => $tluStatusPengajuanDeveloper->keterangan, 
                'role_status_peng_dev' => $tluStatusPengajuanDeveloper->role,
                'pengajuan_ke_apersi' => $pengajuanKeApersi,
                'user_id' => $userId
            ]); 


            $blokRumahs = explode(",",$request->blok_rumah);
            foreach ($blokRumahs as $blokRumah) {
                $pengajuanDevelopersDetails[] = [
                    'pengajuan_developer_id' => $newPengajuanDeveloper->id,
                    'developer_id' => $request->developer_id,
                    'perumahan_developer_id' => $request->perumahan_developer_id,
                    'blok_rumah' => $blokRumah,
                    'created_at' => $currentDateTime,
                    'updated_at' => $currentDateTime,

                ];
            }
            Pengajuan_developer_detail::insert($pengajuanDevelopersDetails);


            // Commit Transaction
            DB::commit();
            // Semua proses benar
            // return redirect()->back()->with('success','Input Pengajuan berhasil.');
            return redirect()->route('konsultan.detailPengajuan', ['id'=>$newPengajuanDeveloper->id])->with('success','Data pengajuan berhasil ditambahkan');     
        } catch (Exception $e) {       
            // Rollback Transaction
            DB::rollback();
            return redirect()->back()->with('fail',$e->getErrors());
            // throw $e;
            // ada yang error   
        }
    
    }    

    public function updatePengajuan(Request $request) {

        $currentDateTime = \Carbon\Carbon::now()->toDateTimeString();
        $kodePengajuan =  str_replace("-","",$currentDateTime);
        $kodePengajuan =  str_replace(":","",$kodePengajuan);
        $kodePengajuan =  str_replace(" ","",$kodePengajuan);
        $kodePengajuan = "MGS".$kodePengajuan;
        // dd($kodePengajuan);die;
        // dd($currentDateTime);die;

        $luasTanah = str_replace(".","", $request->input('luas_tanah'));
        $luasTanah = str_replace(",",".", $luasTanah);
        $request->merge(['luas_tanah' => $luasTanah]);

        $ketinggianBangunan = str_replace(".","", $request->input('ketinggian_bangunan'));
        $ketinggianBangunan = str_replace(",",".", $ketinggianBangunan);
        $request->merge(['ketinggian_bangunan' => $ketinggianBangunan]);

        // $jumlahLantai = str_replace(".","", $request->input('jumlah_lantai'));
        // $jumlahLantai = str_replace(",",".", $jumlahLantai);
        // $request->merge(['jumlah_lantai' => $jumlahLantai]);        
        $jumlahLantai = number_format($request->input('jumlah_lantai'), 2, '.', '');
        $request->merge(['jumlah_lantai' => $jumlahLantai]);

        $luasLantai = str_replace(".","", $request->input('luas_lantai'));
        $luasLantai = str_replace(",",".", $luasLantai);
        $request->merge(['luas_lantai' => $luasLantai]);        

        $hargaJualPerUnit = str_replace(".","", $request->input('harga_jual_per_unit'));
        $hargaJualPerUnit = str_replace(",",".", $hargaJualPerUnit);
        $request->merge(['harga_jual_per_unit' => $hargaJualPerUnit]);

        $userId = Auth::id();
        $tluStatusPengajuanDeveloper = Tlu_status_pengajuan_developer::find(62);
        // return $tluStatusPengajuanDeveloper;
        $pengajuanKeApersi = !empty($request->province_code_apersi) ? true : false;


        $request->validate(
            [
                'tlu_fungsi_bangunan_id' => 'required',
                'tlu_tipe_rumah_id'=>'required',
                'luas_tanah'=> 'required|numeric',
                'posisi_koordinat'=>'required',      
                'klasifikasi_kompleksitas'=>'required',        
                'ketinggian_bangunan'=>'required|numeric',
                'jumlah_lantai'=>'required|numeric',
                'luas_lantai'=>'required|numeric', 
                // 'blok_rumah'=> 'required',
                'blok_rumah' => ['required', new checkPengajuanBlokRumah($request->developer_id, $request->perumahan_developer_id, $request->id)],
                'developer_id'=> 'required',
                'perumahan_developer_id'=> 'required',
                'rumah_sample'=> 'required',
                'harga_jual_per_unit'=> 'required|integer'
            ], 
            [
                'tlu_fungsi_bangunan_id.required' => 'Fungsi bangunan harus diisi',
                'tlu_tipe_rumah_id.required' => 'Tipe bangunan harus diisi',
                'luas_tanah.required' => 'Luas tanah harus diisi',
                'luas_tanah.numeric' => 'tidak valid',
                'posisi_koordinat.required' => 'Posisi koordinat harus diisi',
                'klasifikasi_kompleksitas.required'=>'Klasifikasi kompleksitas bangunan harus diisi',
                'ketinggian_bangunan.required'=>'Ketinggian bangunan harus diisi',
                'ketinggian_bangunan.numeric'=>'tidak valid',
                'jumlah_lantai.required'=>'Jumlah lantai harus diisi',
                'jumlah_lantai.numeric'=>'tidak valid',
                'luas_lantai.required'=>'Luas lantai harus diisi',
                'luas_lantai.numeric'=>'tidak valid',
                'blok_rumah.required'=> 'Blok rumah yang akan diajukan belum diisi',                                
                'developer_id.required' => 'Anda belum memilih developer',
                'perumahan_developer_id.required' => 'Nama perumahan yang diajukan belum dipilih',
                'rumah_sample.required' => 'Rumah sample dari blok rumah yang diajukan belum dipilih',
                'harga_jual_per_unit.required' => 'Harga jual dari per unit rumah yang diajukan belum diisi',
                'harga_jual_per_unit.integer'=>'tidak valid',
            ]
        );

        // $input = $request->all();
        // return $input;        


        DB::beginTransaction();

        try {       

            $pengajuanDeveloper = Pengajuan_developer::find($request->id);

            $pengajuanDeveloper->developer_id = $request->developer_id;
            $pengajuanDeveloper->tlu_tipe_rumah_id = $request->tlu_tipe_rumah_id;
            $pengajuanDeveloper->luas_tanah = $request->luas_tanah;
            $pengajuanDeveloper->posisi_koordinat = $request->posisi_koordinat;
            $pengajuanDeveloper->klasifikasi_kompleksitas = $request->klasifikasi_kompleksitas;
            $pengajuanDeveloper->ketinggian_bangunan = $request->ketinggian_bangunan;
            $pengajuanDeveloper->jumlah_lantai = $request->jumlah_lantai;
            $pengajuanDeveloper->luas_lantai = $request->luas_lantai;
            $pengajuanDeveloper->blok_rumah = $request->blok_rumah;
            $pengajuanDeveloper->perumahan_developer_id = $request->perumahan_developer_id;
            $pengajuanDeveloper->rumah_sample = $request->rumah_sample;
            $pengajuanDeveloper->harga_jual_per_unit = $hargaJualPerUnit;
            $pengajuanDeveloper->sertifikat_hak_atas_tanah = $request->sertifikat_hak_atas_tanah;
            $pengajuanDeveloper->izin_pemanfaatan_tanah = $request->izin_pemanfaatan_tanah;
            $pengajuanDeveloper->pengesahan_site_plan = $request->pengesahan_site_plan;
            $pengajuanDeveloper->nomor_imb = $request->nomor_imb;
            $pengajuanDeveloper->jenis_nomor_izin_lainnya = $request->jenis_nomor_izin_lainnya;
            $pengajuanDeveloper->nomor_izin_lainnya = $request->nomor_izin_lainnya;
            $pengajuanDeveloper->province_code_apersi = $request->province_code_apersi;
            // $pengajuanDeveloper->tlu_sts_peng_dev_id = $tluStatusPengajuanDeveloper->id;
            $pengajuanDeveloper->pengawas_id = $request->pengawas_id;

            $pengajuanDeveloper->save();

            Pengajuan_developer_detail::where('pengajuan_developer_id', $request->id)
            ->update(['developer_id' => $request->developer_id, 'perumahan_developer_id' => $request->perumahan_developer_id]);           

            $newLogPengajuanDeveloper = Log_pengajuan_developer::create([
                'pengajuan_developer_id' => $request->id, 
                'developer_id' => $request->developer_id, 
                'perumahan_developer_id' => $request->perumahan_developer_id, 
                'timestamp' => $currentDateTime, 
                'catatan' => $request->catatan,
                'id_status_peng_dev' => $tluStatusPengajuanDeveloper->id,
                'nama_status_peng_dev' => $tluStatusPengajuanDeveloper->nama_status,
                'keterangan_status_peng_dev' => $tluStatusPengajuanDeveloper->keterangan, 
                'role_status_peng_dev' => $tluStatusPengajuanDeveloper->role,
                'pengajuan_ke_apersi' => $pengajuanKeApersi,
                'user_id' => $userId
            ]); 


            $blokRumahAdded = json_decode($request->blok_rumah_added);
            // return $blokRumahAdded;

            
            $pengajuanDeveloperDetails = [];
            foreach ( $blokRumahAdded as $blok_rumah => $pengajuan_developer_id ) {
                
                $pengajuanDeveloperDetails[] = [
                    'pengajuan_developer_id' => $pengajuan_developer_id,
                    'developer_id' => $request->developer_id,
                    'perumahan_developer_id' => $request->perumahan_developer_id,
                    'blok_rumah' => $blok_rumah,
                    'created_at' => $currentDateTime,
                    'updated_at' => $currentDateTime,

                ];

            }   
   
            if (count($pengajuanDeveloperDetails) > 0) {
                // return $pengajuanDeveloperDetails;
                Pengajuan_developer_detail::insert($pengajuanDeveloperDetails);
            }             
                


            $blokRumahDeleted = json_decode($request->blok_rumah_deleted);
            // return $blokRumahDeleted;
            

            $pengajuanDeveloperDetails = [];
            foreach ( $blokRumahDeleted as $blok_rumah => $pengajuan_developer_id ) {
                $pengajuanDeveloperDetailId = Pengajuan_developer_detail::where('blok_rumah', $blok_rumah)
                    ->where('pengajuan_developer_id', $pengajuan_developer_id)->first();
                
                array_push($pengajuanDeveloperDetails, $pengajuanDeveloperDetailId->id);
            
            }                

            if (count($pengajuanDeveloperDetails) > 0) {            
                // return $pengajuanDeveloperDetails;
                Pengajuan_developer_detail::whereIn('id', $pengajuanDeveloperDetails)->delete();
            }


            // Commit Transaction
            DB::commit();
            // Semua proses benar
            // return redirect()->back()->with('success','Update Pengajuan berhasil.'); 
            return redirect()->route('konsultan.detailPengajuan', ['id'=>$request->id])->with('success','Data berhasil diupdate');  
        } catch (Exception $e) {       
            // Rollback Transaction
            DB::rollback();
            // return redirect()->back()->with('fail',$e->getErrors());
            return redirect()->route('konsultan.detailPengajuan', ['id'=>$request->id])->with('fail',$e->getErrors());  
            // throw $e;
            // ada yang error   
        }        


    }

    public function detailPengajuan(Request $request) {
        
        $pengajuanDeveloper = Pengajuan_developer::find($request->id);
        // return $pengajuanDeveloper;
        $pengajuanDeveloperDetails = Pengajuan_developer_detail::where('pengajuan_developer_id', $pengajuanDeveloper->id)->get();

        $logPengajuanDevelopers = Log_pengajuan_developer::where('pengajuan_developer_id', $pengajuanDeveloper->id)->get();
        
        // check status disetujui dpd pada log_pengajuan_developers
        $filtered = $logPengajuanDevelopers->where('id_status_peng_dev', 31);
        // return $logPengajuanDevelopers;
        // return $filtered->count();
        $isExistsStatus31 = false;
        if ($filtered->count() > 0) $isExistsStatus31 = true;
        // return $isExistsStatus31;

        // check status proses pengajuan pada log_pengajuan_developers
        $filtered = $logPengajuanDevelopers->where('id_status_peng_dev', 64);
        // return $logPengajuanDevelopers;
        // return $filtered->count();
        $isExistsStatus64 = false;
        if ($filtered->count() > 0) $isExistsStatus64 = true;
        // return $isExistsStatus31;
        
        $pilihanStatus = $pengajuanDeveloper->tlu_status_pengajuan_developer->pilihan_status;
        if (empty($pilihanStatus)) $pilihanStatus = "{}";
        $pilihanStatus = json_decode($pilihanStatus, true);
        $key = 'konsultan';
        if ($pengajuanDeveloper->province_code_apersi) $key = 'konsultan_province_code_apersi_not_null'; 
        // return $pilihanStatus[$key];
        // echo "status 31 : ".$logPengajuanDevelopers->search('31');
        
        $roleStatus=[];
        if (array_key_exists($key, $pilihanStatus)) {
            if (array_key_exists('0', $pilihanStatus[$key])) {    
                $roleStatus = $pilihanStatus[$key];
            }else{
             $roleStatus[] = $pilihanStatus[$key];
            }
        }
        // return $roleStatus;

        $denganApersi = false;
        if (!empty($pengajuanDeveloper->province_code_apersi)) $denganApersi = true;

        return view('konsultan.detail-pengajuan-developer', compact(
                'pengajuanDeveloper',
                'pengajuanDeveloperDetails',
                'logPengajuanDevelopers', 
                'roleStatus',
                'isExistsStatus31',
                'isExistsStatus64',
                'denganApersi'
            )
        );        

    }

    public function setStatusPengajuan(Request $request) {
        
        // $input = $request->all();
        // return $input;    

        $blokRumahs = json_decode($request->blok_rumah_approval);
        // $blokRumahs = $request->blok_rumah;
        // return $blokRumahs;

        $currentDateTime = \Carbon\Carbon::now()->toDateTimeString();
        $tluStatusPengajuanDeveloper = Tlu_status_pengajuan_developer::find($request->id_status);
        $pengajuanDeveloper = Pengajuan_developer::find($request->id);
        $pengajuanKeApersi = ($request->id_status == 24) ? true : false;
        $userId = Auth::id();

        if ($request->id_status == 24) {
            if (empty($pengajuanDeveloper->pengawas->id)) {
                return redirect()->back()->with('fail', 'Pengajuan ke DPD tidak bisa dilakukan karena data pengawas belum diisi');
            }
        }


        DB::beginTransaction();

        try {       
      
            $newLogPengajuanDeveloper = Log_pengajuan_developer::create([
                'pengajuan_developer_id' => $request->id, 
                'developer_id' => $pengajuanDeveloper->developer_id, 
                'perumahan_developer_id' => $pengajuanDeveloper->perumahan_developer_id, 
                'timestamp' => $currentDateTime, 
                'catatan'=> $request->catatan,
                'id_status_peng_dev' => $tluStatusPengajuanDeveloper->id,
                'nama_status_peng_dev' => $tluStatusPengajuanDeveloper->nama_status,
                'keterangan_status_peng_dev' => $tluStatusPengajuanDeveloper->keterangan, 
                'role_status_peng_dev' => $tluStatusPengajuanDeveloper->role,
                'pengajuan_ke_apersi' => $pengajuanKeApersi,
                'user_id' => $userId
            ]); 

            $pengajuanDeveloper->tlu_sts_peng_dev_id = $request->id_status;
            if ($request->id_status == 24) {
                $pengajuanDeveloper->pengajuan_ke_apersi = $pengajuanKeApersi;
            }
            $pengajuanDeveloper->save();

            if ($request->id_status == 71) {

                foreach ($blokRumahs as $blok) {

                    $pengajuanDeveloperDetails = Pengajuan_developer_detail::find($blok->id);
                    
                    if (!empty($pengajuanDeveloper->province_code_apersi)) {
                    
                        $idStatus = 21;
                        if ($blok->checked) {
                            $idStatus = 31;
                        } 
                    
                    }else{

                        $idStatus = 67;
                        if ($blok->checked) {
                            $idStatus = 71;
                        }

                    }

                    if ($pengajuanDeveloperDetails->tlu_sts_peng_blk_rmh_id !== $idStatus) {

                        $pengajuanDeveloperDetails->tlu_sts_peng_blk_rmh_id = $idStatus;
                        $pengajuanDeveloperDetails->save();

                        $tluStatusPengajuanBlokRumah = Tlu_status_pengajuan_blok_rumah::find($idStatus);

                        $newLogPengajuanBlokRumah = Log_pengajuan_blok_rumah::create([
                            'pengajuan_developer_id' => $request->id, 
                            'pengajuan_developer_detail_id' => $blok->id, 
                            'developer_id' => $pengajuanDeveloper->developer_id, 
                            'perumahan_developer_id' => $pengajuanDeveloper->perumahan_developer_id, 
                            'blok_rumah' => $pengajuanDeveloperDetails->blok_rumah,
                            'timestamp' => $currentDateTime, 
                            // 'catatan'=> $request->catatan,
                            'id_status_blok_rumah' => $tluStatusPengajuanBlokRumah->id,
                            'nama_status_blok_rumah' => $tluStatusPengajuanBlokRumah->nama_status,
                            'role_status_blok_rumah' => $tluStatusPengajuanBlokRumah->role,
                            'user_id' => $userId
                        ]);

                    }

                }

            }

            // Commit Transaction
            DB::commit();
            // Semua proses benar
            return redirect()->back()->with('success', 'Perubahan status berhasil disimpan');   
        } catch (Exception $e) {       
            // Rollback Transaction
            DB::rollback();
            return redirect()->back()->with('fail',$e->getErrors());
            // throw $e;
            // ada yang error   
        }        


    }

    public function setIjinEditPengajuan(Request $request) {
    
        // $input = $request->all();
        // return $input;

        $pengajuanDeveloper = Pengajuan_developer::find($request->id);
        $pengajuanDeveloper->ijin_edit = $request->ijin_edit;
        $pengajuanDeveloper->save();
        if ($request->ijin_edit) {
            $msg = 'Ijin edit untuk data ini telah diberikan';
        }else{
            $msg = 'Ijin edit untuk data ini telah dicabut';
        }
        return redirect()->route('konsultan.detailPengajuan', ['id'=>$request->id])->with('success', $msg);  
    
    }


    public function laporanPengajuan(Request $request) {

        // $input = $request->all();
        // return $input;

        $pengajuanDeveloper = Pengajuan_developer::find($request->id);
        // return $pengajuanDeveloper;
        if (!empty($request->blok_rumah)) {
            $tempBlokRumah =  str_replace(" ","",$request->blok_rumah);
            $arrBlokFilter = explode(',', $tempBlokRumah);
            $pengajuanDeveloperDetails = Pengajuan_developer_detail::where('pengajuan_developer_id', $pengajuanDeveloper->id)->whereIn('blok_rumah', $arrBlokFilter)->get();
            // return $pengajuanDeveloperDetails;
        }else{
            $pengajuanDeveloperDetails = Pengajuan_developer_detail::where('pengajuan_developer_id', $pengajuanDeveloper->id)->get();
            // return $pengajuanDeveloperDetails;
        }
        // return view('konsultan.laporan-pengajuan');
        return view('konsultan.laporan-pengajuan', compact(
            'pengajuanDeveloper',
            'pengajuanDeveloperDetails'
        ));    

    }


    public function uploadLaporanPengajuan(Request $request) {

        // $input = $request->all();
        // return $input;

        // $bp2bt_apersi = $request->file('bp2bt_apersi');
        // dd($bp2bt_apersi);
        // return $bp2bt_apersi;
        // return $input;    

        // $this->validate($request, [
        //     'bp2bt_apersi.*' => 'mimes:pdf|max:2048',
        //     'flpp_apersi.*' => 'mimes:pdf|max:2048',
        //     'simak_slf_apersi.*' => 'mimes:pdf|max:2048'
        // ]);

        $request->validate(
            [
                'bp2bt_apersi.*' => 'mimes:pdf|max:2048',
                'flpp_apersi.*' => 'mimes:pdf|max:2048',
                'simak_slf_apersi.*' => 'mimes:pdf|max:2048'
            ], 
            [
                'bp2bt_apersi.*.mimes' => 'Laporan BP2BT Apersi harus berformat .pdf',
                'bp2bt_apersi.*.max' => 'Ukuran file Laporan BP2BT Apersi tidak boleh dari 2Mb',
                'flpp_apersi.*.mimes' => 'Laporan FLPP Apersi harus berformat .pdf',
                'flpp_apersi.*.max' => 'Ukuran file Laporan FLPP Apersi tidak boleh dari 2Mb',
                'simak_slf_apersi.*.mimes' => 'Laporan SIMAK SLF Apersi harus berformat .pdf',
                'simak_slf_apersi.*.max' => 'Ukuran file Laporan SIMAK SLF Apersi tidak boleh dari 2Mb',
            ]
        );


        // if (isset($errors)) {
        //     if ($errors->any()) {
        //         print_r($errors->all());
        //     }
        // }
        
        $currentDateTime = \Carbon\Carbon::now()->toDateTimeString();
        $timeUploadCode =  str_replace("-","",$currentDateTime);
        $timeUploadCode =  str_replace(":","",$timeUploadCode);
        $timeUploadCode =  str_replace(" ","",$timeUploadCode);

        $simpanHasilLaporan = false;
        $firstIndex = $request->first_index;
        $lastIndex = $request->last_index;    

        // $idx = 0;
        // foreach($request->pengajuan_developer_detail_id as $data){
        for ($idx = $firstIndex; $idx <= $lastIndex; $idx++) {   

            if (!empty($request->bp2bt_apersi[$idx])) {

                $bp2btApersi = $request->bp2bt_apersi[$idx];
                $bp2btApersiOriginalFilename = $bp2btApersi->getClientOriginalName();
                $bp2btApersiFilename = $timeUploadCode.'-'.$bp2btApersiOriginalFilename;
                // echo $idx.". ".$bp2btApersiOriginalFilename." => ".$bp2btApersiFilename;
                // echo "<br />";

                $simpanHasilLaporan = HasilLaporan::updateOrCreate(
                    [
                        'id' => $request->id_file_bp2bt_apersi[$idx]
                    ],
                    [
                        'pengajuan_developer_id'=>$request->pengajuan_developer_id[$idx],
                        'pengajuan_developer_detail_id'=>$request->pengajuan_developer_detail_id[$idx],
                        'param'=>'BP2BT_APERSI',
                        'nama_file'=>$bp2btApersiFilename,
                    ]
                );                

                if ($simpanHasilLaporan) {
                    
                    if (!empty($request->old_bp2bt_apersi[$idx])) {
                        if (File::exists(public_path('hasil_laporan/'.$request->old_bp2bt_apersi[$idx]))){
                             File::delete(public_path('hasil_laporan/'.$request->old_bp2bt_apersi[$idx]));
                        }
                    }    

                    $bp2btApersi->move(public_path().'/hasil_laporan/', $bp2btApersiFilename);
                }

            }

            if (!empty($request->flpp_apersi[$idx])) {
                $flppApersi = $request->flpp_apersi[$idx];
                $flppApersiOriginalFilename = $flppApersi->getClientOriginalName();
                $flppApersiFilename = $timeUploadCode.'-'.$flppApersiOriginalFilename;
                // echo $idx.". ".$flppApersiOriginalFilename." => ".$flppApersiFilename;
                // echo "<br />";

                $simpanHasilLaporan = HasilLaporan::updateOrCreate(
                    [
                        'id' => $request->id_file_flpp_apersi[$idx]
                    ],
                    [
                        'pengajuan_developer_id'=>$request->pengajuan_developer_id[$idx],
                        'pengajuan_developer_detail_id'=>$request->pengajuan_developer_detail_id[$idx],
                        'param'=>'FLPP_APERSI',
                        'nama_file'=>$flppApersiFilename,
                    ]
                );                

                if ($simpanHasilLaporan) {
                    
                    if (!empty($request->old_flpp_apersi[$idx])) {
                        if (File::exists(public_path('hasil_laporan/'.$request->old_flpp_apersi[$idx]))){
                             File::delete(public_path('hasil_laporan/'.$request->old_flpp_apersi[$idx]));
                        }
                    }    

                    $flppApersi->move(public_path().'/hasil_laporan/', $flppApersiFilename);
                }

            }    

            if (!empty($request->simak_slf_apersi[$idx])) {
                $simakSlfApersi = $request->simak_slf_apersi[$idx];
                $simakSlfApersiOriginalFilename = $simakSlfApersi->getClientOriginalName();
                $simakSlfApersiFilename = $timeUploadCode.'-'.$simakSlfApersiOriginalFilename;
                // echo $idx.". ".$simakSlfApersiOriginalFilename." => ".$simakSlfApersiFilename;
                // echo "<br />";
            
                $simpanHasilLaporan = HasilLaporan::updateOrCreate(
                    [
                        'id' => $request->id_file_simak_slf_apersi[$idx]
                    ],
                    [
                        'pengajuan_developer_id'=>$request->pengajuan_developer_id[$idx],
                        'pengajuan_developer_detail_id'=>$request->pengajuan_developer_detail_id[$idx],
                        'param'=>'SIMAK_SLF_APERSI',
                        'nama_file'=>$simakSlfApersiFilename,
                    ]
                );                

                if ($simpanHasilLaporan) {
                    
                    if (!empty($request->old_simak_slf_apersi[$idx])) {
                        if (File::exists(public_path('hasil_laporan/'.$request->old_simak_slf_apersi[$idx]))){
                             File::delete(public_path('hasil_laporan/'.$request->old_simak_slf_apersi[$idx]));
                        }
                    }    

                    $simakSlfApersi->move(public_path().'/hasil_laporan/', $simakSlfApersiFilename);
                }                

            }
            $pengajuanDeveloperId = $request->pengajuan_developer_id[$idx];
            // $idx++;    
        }

        if ($simpanHasilLaporan) {
            return redirect()->route('konsultan.laporanPengajuan', ['id'=>$pengajuanDeveloperId, 'blok_rumah'=> $request->blok_rumah_filter])->with('success','Data berhasil diupload');
        }else{
            return redirect()->route('konsultan.laporanPengajuan', ['id'=>$pengajuanDeveloperId, 'blok_rumah'=> $request->blok_rumah_filter]);
        }

    }

    public function indexRegistrasiDeveloper(Request $request) {

        // $input = $request->all();
        // return $input;

        if (isset($request->active)) {
            
            if ($request->active=='developer') {
                $developerTabActive = "active";
                $userTabActive = "";
            }else if ($request->active=='user') {    
                $developerTabActive = "";
                $userTabActive = "active";
            }else{
                $developerTabActive = "active";
                $userTabActive = "";
            }

        }else{
            $developerTabActive = "active";
            $userTabActive = "";
        }

        // $paginate = 1;
        // $dpds = Dpd::all();
        $provinces = Province::pluck('name', 'code');
        $developers = Developer::pluck('nama_perusahaan', 'id');
        // return $dpds;

        // $perPageLists = collect([
        //     ['id' => 1, 'per_page' => '1'],
        //     ['id' => 2, 'per_page' => '2'],
        //     ['id' => 3, 'per_page' => '3'],
        // ])->pluck('per_page', 'id');
        
        $perPageLists = collect([
            ['id' => 5, 'per_page' => '5'],
            ['id' => 10, 'per_page' => '10'],
            ['id' => 25, 'per_page' => '25'],
            ['id' => 50, 'per_page' => '50'],
            ['id' => 100, 'per_page' => '100'],
        ])->pluck('per_page', 'id');        

        DB::enableQueryLog();

        if($developerTabActive) {
        
            $perPage = $perPageLists->first();
            // print_r($perPage);
            if (!empty($request->data_per_halaman)) {
                $perPage = $request->data_per_halaman;
            }            

            
            $datas = Developer::where([ 
                [function ($query) use ($request) {
    
                    if (!empty($request->nama_developer)) {
                        $query->where('nama_perusahaan', 'LIKE', '%'.$request->nama_developer.'%');
                    }

                    if (!empty($request->province_code)) {
                        $query->where('province_code', $request->province_code);
                    }                                                                
                    
                }]
            ])->sortable()->paginate($perPage)->withQueryString();
            // $datas->append(['active'=>'developer']);

        }
        
        if ($userTabActive) {   
        
            $perPage = $perPageLists->first();
            // print_r($perPage);
            if (!empty($request->data_per_halaman)) {
                $perPage = $request->data_per_halaman;
            }
            $datas = User::where('role', 'DEVELOPER')
            ->when(!empty($request->name), function ($query, $role) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->name.'%');
            })->when(!empty($request->username), function ($query, $role) use ($request) {
                $query->where('username', 'LIKE', '%'.$request->username.'%');
            })->when(!empty($request->developer_id), function ($query, $role) use ($request) {

                $query->whereHas('developers', function ($q) use ($request) {                
    
                    if (!empty($request->developer_id)) {
                        $q->where('developer_id', $request->developer_id);
                    }                
       
    
                });

            })->sortable()->paginate($perPage)->withQueryString();
       
        }

        // return $datas;
        // dd($pengajuanDevelopers);
        // $quries = DB::getQueryLog();
        // dd($quries);

        return view('konsultan.index-registrasi-developer', compact(
            'developerTabActive',
            'userTabActive',
            'datas',
            'provinces',
            'developers',
            'perPageLists'
        ));       

    }    

    public function tambahRegistrasiDeveloper() {

        $provinces = Province::pluck('name', 'code');
        return view('konsultan.tambah-registrasi-developer', compact(
            'provinces'
        ));
    
    } 

    public function editRegistrasiDeveloper(Request $request) {

        $developer = Developer::find($request->id);
        $provinces = Province::pluck('name', 'code');
        return view('konsultan.edit-registrasi-developer', compact(
            'developer',
            'provinces'
        ));
    
    }

    public function simpanRegistrasiDeveloper(Request $request) {

        // $input = $request->all();
        // return $input;

        $request->validate(
            [
                'nama_perusahaan' => 'required|unique:developers,nama_perusahaan,' . $request->id,
                'nama_direktur'=>'required',
                // 'no_kta_apersi'=> 'required',
                // 'province_code'=>'required',      
                'alamat'=>'required',        
                'no_hp'=>'required',
                'email' => 'required|email|unique:developers,email,' . $request->id,
                
            ], 
            [
                'nama_perusahaan.required' => 'Nama perusahaan harus diisi',
                'nama_perusahaan.unique'=>'sudah terdaftar',
                'nama_direktur.required' => 'Nama direktur harus diisi',
                // 'no_kta_apersi.required' => 'No. KTA Apersi harus diisi',
                // 'province_code.required' => 'Asal DPD Apersi belum dipilih',
                'alamat.required'=>'Alamat harus diisi',
                'no_hp.required'=>'No. HP harus diisi',
                'email.required'=>'Email harus diisi',
                'email.unique'=>'sudah terdaftar',
                'email.email'=>'format email tidak sesuai',
            ]
        );

        $simpan = Developer::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nama_perusahaan' => $request->nama_perusahaan,
                'nama_direktur' => $request->nama_direktur,
                'no_kta_apersi' => $request->no_kta_apersi,
                'province_code' => $request->province_code,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
            ]
        );

        if ($simpan) {
            return redirect()->route('konsultan.editRegistrasiDeveloper', ['id'=>$simpan->id] )->with('success','Data berhasil disimpan.'); 
        }else{
            return redirect()->back()->with('fail',$e->getErrors());
        }


    }

    public function deleteRegistrasiDeveloper(Request $request) {

        // $input = $request->all();
        // return $input;

        $developer = Developer::find($request->id);

        if ($developer->delete()) {
            return redirect()->route('konsultan.indexRegistrasiDeveloper', ['active'=>'developer'])->with('success','Data berhasil dihapus.'); 
        }else{
            return redirect()->route('konsultan.indexRegistrasiDeveloper', ['active'=>'developer'])->with('fail','Data gagal dihapus.');
        }

    }

    public function tambahRegistrasiUserDeveloper() {

        $developers = Developer::pluck('nama_perusahaan', 'id');
        return view('konsultan.tambah-registrasi-user-developer', compact(
            'developers'
        ));
    
    }

    public function editRegistrasiUserDeveloper(Request $request) {

        $developers = Developer::pluck('nama_perusahaan', 'id');
        $user = User::find($request->id);
        return view('konsultan.edit-registrasi-user-developer', compact(
            'developers',
            'user'
        ));

    }

    public function simpanRegistrasiUserDeveloper(Request $request) {

        // $input = $request->all();
        // return $input;          
 
        $request->validate(
            [
                'developer_id'=>'required',
                'name'=>'required',
                'username'=>'required|min:6|regex:/^[0-9A-Za-z.\-_]+$/u|unique:users,username,',                
                'email' => 'required|email|unique:users,email,',
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
                
            ], 
            [
                'developer_id.required' => 'Developer belum dipilih',
                'name.required' => 'Nama harus diisi',
                'username.required'=>'Username harus diisi',
                'username.min'=>'tidak valid. Username minimal 6 karakter',
                'username.regex'=>'tidak valid. Username hanya berisi huruf, angka, titik, - ,dan _',
                'username.unique'=>'sudah terdaftar',
                'email.required'=>'Email harus diisi',
                'email.unique'=>'sudah terdaftar',
                'email.email'=>'format email tidak sesuai',                
                'password.required'=>'Password harus diisi',
                'password.min'=>'Password minimal 8 karakter',
                'password_confirmation.required'=>'Konfirmasi Password harus diisi',
                'password_confirmation.same'=>'Password dan Konfirmasi Password harus sama',
            ]
        );

        DB::beginTransaction();

        try {

            $newUser = User::Create(
                [
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'DEVELOPER',
                ]
            );        

            $newUser->developers()->attach($request->developer_id);

            // Commit Transaction
            DB::commit();
            // Semua proses benar
            return redirect()->route('konsultan.editRegistrasiUserDeveloper', ['id'=>$newUser->id] )->with('success','Data user berhasil disimpan.'); 
            
        } catch (Exception $e) {       
            // Rollback Transaction
            DB::rollback();
            return redirect()->back()->with('fail',$e->getErrors());
            // throw $e;
            // ada yang error   
        }            


    }

    public function updateRegistrasiUserDeveloper(Request $request) {

        // $input = $request->all();
        // return $input;          
 
        $request->validate(
            [
                'developer_id'=>'required',
                'name'=>'required',
                'username'=>'required|min:6|regex:/^[0-9A-Za-z.\-_]+$/u|unique:users,username,'.$request->id,                
                'email' => 'required|email|unique:users,email,'.$request->id,
                'password' => 'nullable|min:8',
                'password_confirmation' => 'required_with:password|same:password',
                
            ], 
            [
                'developer_id.required' => 'Developer belum dipilih',
                'name.required' => 'Nama harus diisi',
                'username.required'=>'Username harus diisi',
                'username.min'=>'tidak valid. Username minimal 6 karakter',
                'username.regex'=>'tidak valid. Username hanya berisi huruf, angka, titik, - ,dan _',
                'username.unique'=>'sudah terdaftar',
                'email.required'=>'Email harus diisi',
                'email.email'=>'format email tidak sesuai',                
                'email.unique'=>'sudah terdaftar',                
                // 'password.required'=>'Password harus diisi',
                'password.min'=>'Password minimal 8 karakter',
                'password_confirmation.required_with'=>'Konfirmasi Password harus diisi',
                'password_confirmation.same'=>'Password dan Konfirmasi Password harus sama',
            ]
        );

        // $input = $request->all();
        // return $input;

        DB::beginTransaction();

        try { 

            $user = User::find($request->id);

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            $user->developers()->sync([$request->developer_id]);

            // Commit Transaction
            DB::commit();
            // Semua proses benar
            return redirect()->route('konsultan.editRegistrasiUserDeveloper', ['id'=>$request->id] )->with('success','Update user berhasil.'); 
            
        } catch (Exception $e) {       
            // Rollback Transaction
            DB::rollback();
            return redirect()->back()->with('fail',$e->getErrors());
            // throw $e;
            // ada yang error   
        }            


    }    

 
}
