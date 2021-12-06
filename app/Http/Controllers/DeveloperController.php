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

        $user = User::find(Auth::id());
        $developer = $user->developers()->first();       
        $developerId = $developer->id;
        $provinces = Province::pluck('name', 'code');
        $perumahanDevelopers = Perumahan_developer::where('developer_id', $developer->id)
        ->pluck('nama_perumahan', 'id');
        // return $perumahanDevelopers;

        $statusPengajuans = collect([
            ['id' => 'Pengajuan Baru', 'nama_status' => 'Pengajuan Baru'],
            ['id' => 'Edit Data', 'nama_status' => 'Edit Data'],
            ['id' => 'Hold/Pending', 'nama_status' => 'Hold/Pending'],
            ['id' => 'Menunggu Persetujuan DPD', 'nama_status' => 'Menunggu Persetujuan DPD'],
            ['id' => 'Ditolak DPD', 'nama_status' => 'Ditolak DPD'],
            ['id' => 'Disetujui DPD', 'nama_status' => 'Disetujui DPD'],
            ['id' => 'Menunggu Persetujuan DPP', 'nama_status' => 'Menunggu Persetujuan DPP'],
            ['id' => 'Ditolak DPP', 'nama_status' => 'Ditolak DPP'],
            ['id' => 'Disetujui DPP', 'nama_status' => 'Disetujui DPP'],    
            ['id' => 'Menunggu Persetujuan Konsultan', 'nama_status' => 'Menunggu Persetujuan Konsultan'],
            ['id' => 'Ditolak Konsultan', 'nama_status' => 'Ditolak Konsultan'],
            ['id' => 'Disetujui Konsultan', 'nama_status' => 'Disetujui Konsultan'],                    
        ])->pluck('nama_status', 'id');
        // return $statusPengajuans;
        // return $statusPengajuans->pluck('nama_status', 'id');


        // $pengajuanDevelopers = Pengajuan_developer::sortable()->select('*')
        // $pengajuanDevelopers = Pengajuan_developer::where('developer_id', $developer->id)
        // ->where('nama_perumahan', 'LIKE','%'.$request->nama_perumahan.'%')
        // ->paginate(5)->withQueryString();
        // return $pengajuanDevelopers;

        // if (!empty($request->kode_pengajuan)) {
        //     // echo "kode pengajuan";
        //     $pengajuanDevelopers->where('kode_pengajuan', 'LIKE','%'.$request->kode_pengajuan.'%');
        // }    
        // $pengajuanDevelopers->paginate(5)->withQueryString();
        // $pengajuanDevelopers->get();

        $pengajuanDevelopers = Pengajuan_developer::where([
            ['pengajuan_developers.developer_id', '=', $developer->id], 
            [function ($query) use ($request) {
            // $query->('developer_id', $request->developer_id);
            if (!empty($request->kode_pengajuan)) {
                $query->where('kode_pengajuan', 'LIKE', '%'.$request->kode_pengajuan.'%');
            }

            if (!empty($request->perumahan_developer_id)) {
                $query->where('perumahan_developer_id', $request->perumahan_developer_id);
            }

            }]
            ])->sortable()->paginate(5)->withQueryString();


        return view('developer.list-pengajuan-developer', compact(
            'developerId',
            'pengajuanDevelopers',
            'provinces',
            'perumahanDevelopers',
            'statusPengajuans'
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
    
    public function getPerumahanDevelopers(Request $request) {

        $data = Perumahan_developer::where('developer_id', $request->developer_id)->pluck('nama_perumahan', 'id');
        return response()->json($data);
    
    }

    public function formPengajuan() {
        $user = User::find(Auth::id());
        $developer = $user->developers()->first();
        // return $developers;
        $tluTipeRumah = Tlu_tipe_rumah::pluck('tipe_rumah', 'id');
        $tluFungsiBangunan = Tlu_fungsi_bangunan::find(1);
        $provinces = Province::pluck('name', 'code');
        $perumahanDevelopers = Perumahan_developer::where('developer_id', $developer->id)->pluck('nama_perumahan', 'id');
        return view('developer.form-pengajuan-developer', compact(
            'tluTipeRumah',
            'tluFungsiBangunan',
            'provinces',
            'developer',
            'perumahanDevelopers', 
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
            return redirect()->back()->with('success','Input Pengajuan berhasil.');   
        } catch (Exception $e) {       
            // Rollback Transaction
            DB::rollback();
            return redirect()->back()->with('fail',$e->getErrors());
            // throw $e;
            // ada yang error   
        }
    
    }


}
