<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tlu_tipe_rumah;
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
use App\Models\Log_pengajuan_developer;
use App\Rules\CheckPengajuanBlokRumah;
use App\Models\Pengawas;

// use DB;


class DeveloperController extends Controller
{
    //
    function index(){
        // return view('dashboards.admins.index');
        return view('developer.dashboard-developer');
    }    

    public function listPengajuan(Request $request) {

        // $input = $request->all();
        // print_r($input);        
        // return $input;

        $user = User::find(Auth::id());
        $developer = $user->developers()->first();       
        $developerId = $developer->id;
        $provinces = Province::pluck('name', 'code');
        $perumahanDevelopers = Perumahan_developer::where('developer_id', $developer->id)
        ->pluck('nama_perumahan', 'id');
        // return $perumahanDevelopers;

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

        // DB::enableQueryLog();
        $pengajuanDevelopers = Pengajuan_developer::where([
            ['pengajuan_developers.developer_id', '=', $developer->id], 
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

                if (!empty($request->perumahan_developer_id)) {
                    $query->where('perumahan_developer_id', $request->perumahan_developer_id);
                }                

                if (!empty($request->blok_rumah)) {
                    // $arrBlokRumahs = explode(',', $request->blok_rumah);
                    // $query->whereIn('blok_rumah', $arrBlokRumah);
                    // echo "blok_rumah : ".;
                    // print_r($arrBlokRumah);
                    // $query->contains('blok_rumah', $request->blok_rumah);
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
                    // $arrPeriodePengajuan = explode('-', $request->periode_pengajuan);
                    // $periodePengajuanAwal = \Carbon\Carbon::parse($arrPeriodePengajuan[0]);
                    // $periodePengajuanAkhir = \Carbon\Carbon::parse($arrPeriodePengajuan[1]);
                    // // echo "periodePengajuanAwal : ".$periodePengajuanAwal->format('Y-m-d');
                    // // echo "<br />";
                    // // echo "periodePengajuanAkhir : ".$periodePengajuanAkhir->format('Y-m-d');
                    // $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $periodePengajuanAwal->format('Y-m-d'));
                    // $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $periodePengajuanAkhir->format('Y-m-d'));
                    

                    //  $query->whereBetween('timestamp_pengajuan', [$startDate, $endDate]);

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
            

        return view('developer.list-pengajuan-developer', compact(
            'developerId',
            'pengajuanDevelopers',
            'provinces',
            'perumahanDevelopers',
            'statusPengajuanLists',
            'perPageLists'
        ));
    }

    public function getCities(Request $request)
    {
        $data = City::where('province_code', $request->get('code'))
            ->pluck('name', 'code');

        // $cities = City::where('province_code', $request->get('code'))->get();
        // print_r($cities);        

        return response()->json($data);
        // return "test";
    }

    public function getDistricts(Request $request)
    {
        $data = District::where('city_code', $request->get('code'))
            ->pluck('name', 'code');

        // $cities = City::where('province_code', $request->get('code'))->get();
        // print_r($cities);        

        return response()->json($data);
        // return "test";
    }

    public function getVillages(Request $request)
    {
        $data = Village::where('district_code', $request->get('code'))
            ->pluck('name', 'code');

        // $cities = City::where('province_code', $request->get('code'))->get();
        // print_r($cities);        

        return response()->json($data);
        // return "test";
    } 

    public function formPengajuan() {
        $user = User::find(Auth::id());
        $developer = $user->developers()->first();
        // return $developers;
        $tluTipeRumah = Tlu_tipe_rumah::pluck('tipe_rumah', 'id');
        $tluFungsiBangunan = Tlu_fungsi_bangunan::find(1);
        $provinces = Province::pluck('name', 'code');
        $perumahanDevelopers = Perumahan_developer::where('developer_id', $developer->id)->pluck('nama_perumahan', 'id');
        $pengawas = Pengawas::pluck('nama_perusahaan', 'id');
        return view('developer.form-pengajuan-developer', compact(
            'tluTipeRumah',
            'tluFungsiBangunan',
            'provinces',
            'developer',
            'perumahanDevelopers', 
            'pengawas'
            )
        );

    }

    public function editDataPengajuan(Request $request) {
        // $input = $request->all();
        // return $input;
        $role = Auth::user()->role;
        $logPengajuanDevelopers = Log_pengajuan_developer::where('pengajuan_developer_id', $request->id)
        ->where('role_status_peng_dev', '!=', $role)->get();
        // return $logPengajuanDevelopers;
        if (count($logPengajuanDevelopers) > 0) {
            $pengajuanDeveloper = Pengajuan_developer::find($request->id);
            if ($pengajuanDeveloper->ijin_edit) {
                return redirect()->route('developer.editFormPengajuan', ['id' => $request->id]);        
            }else{
                return redirect()->route('developer.detailPengajuan', ['id' => $request->id])->with('fail','Data tidak bisa edit. Hubungi konsultan untuk permohonan ijin edit data');
            }
        }

        return redirect()->route('developer.editFormPengajuan', ['id' => $request->id]);        
    }

    public function editFormPengajuan(Request $request) {

        // $input = $request->all();
        // return $input;
        $user = User::find(Auth::id());
        $developer = $user->developers()->first();
        
        $pengajuanDeveloper = Pengajuan_developer::find($request->id);
        $pengajuanDeveloperDetails = Pengajuan_developer_detail::select(['id','blok_rumah'])->where('pengajuan_developer_id', $pengajuanDeveloper->id)->pluck('id', 'blok_rumah')->toJson();
        // return $pengajuanDeveloperDetails;
        $blokRumahOri = $pengajuanDeveloperDetails;

        $tluTipeRumah = Tlu_tipe_rumah::pluck('tipe_rumah', 'id');
        $tluFungsiBangunan = Tlu_fungsi_bangunan::find(1);
        $provinces = Province::pluck('name', 'code');
        $developerId = $request->old('developer_id') !== null ? $request->old('developer_id') : $pengajuanDeveloper->developer_id;
        $perumahanDevelopers = Perumahan_developer::where('developer_id', $developerId)->pluck('nama_perumahan', 'id');
        $pengawas = Pengawas::pluck('nama_perusahaan', 'id');
        return view('developer.edit-pengajuan-developer', compact(
            'pengajuanDeveloper',
            'developer',
            'tluTipeRumah',
            'tluFungsiBangunan',
            'provinces',
            'perumahanDevelopers',
            'blokRumahOri',
            'pengawas' 
            )
        );


    }

    public function simpanPengajuan(Request $request) {

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
        $tluStatusPengajuanDeveloper = Tlu_status_pengajuan_developer::find(11);
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
                'izin_pemanfataan_tanah' => $request->izin_pemanfaatan_tanah, 
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
            return redirect()->route('developer.detailPengajuan', ['id'=>$newPengajuanDeveloper->id])->with('success','Data pengajuan berhasil ditambahkan'); 
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

        $jumlahLantai = number_format($request->input('jumlah_lantai'), 2, '.', '');
        $request->merge(['jumlah_lantai' => $jumlahLantai]);

        $luasLantai = str_replace(".","", $request->input('luas_lantai'));
        $luasLantai = str_replace(",",".", $luasLantai);
        $request->merge(['luas_lantai' => $luasLantai]);        

        $hargaJualPerUnit = str_replace(".","", $request->input('harga_jual_per_unit'));
        $hargaJualPerUnit = str_replace(",",".", $hargaJualPerUnit);
        $request->merge(['harga_jual_per_unit' => $hargaJualPerUnit]);

        $userId = Auth::id();
        $tluStatusPengajuanDeveloper = Tlu_status_pengajuan_developer::find(12);
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
            $pengajuanDeveloper->ijin_edit = 0;
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
            return redirect()->route('developer.detailPengajuan', ['id'=>$request->id])->with('success','Data berhasil diupdate');  
        } catch (Exception $e) {       
            // Rollback Transaction
            DB::rollback();
            // return redirect()->back()->with('fail',$e->getErrors());
            return redirect()->route('developer.detailPengajuan', ['id'=>$request->id])->with('fail',$e->getErrors());  
            // throw $e;
            // ada yang error   
        }        


    }

    public function detailPengajuan(Request $request) {
        
        $pengajuanDeveloper = Pengajuan_developer::find($request->id);
        // return $pengajuanDeveloper;
        $pengajuanDeveloperDetails = Pengajuan_developer_detail::where('pengajuan_developer_id', $pengajuanDeveloper->id)->get();

        $logPengajuanDevelopers = Log_pengajuan_developer::where('pengajuan_developer_id', $pengajuanDeveloper->id)->get();
        $pilihanStatus = $pengajuanDeveloper->tlu_status_pengajuan_developer->pilihan_status;
        $pilihanStatus = json_decode($pilihanStatus, true);
        // return $pilihanStatus
        $key = strtolower(Auth::user()->role);
        // return $pilihanStatus[$key];

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

        return view('developer.detail-pengajuan-developer', compact(
                'pengajuanDeveloper',
                'pengajuanDeveloperDetails',
                'logPengajuanDevelopers', 
                'roleStatus',
                'denganApersi'
            )
        );        

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
        return view('developer.laporan-pengajuan', compact(
            'pengajuanDeveloper',
            'pengajuanDeveloperDetails'
        ));    

    }    


}
