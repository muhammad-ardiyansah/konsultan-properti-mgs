<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use App\Models\User;
use App\Models\Developer;
use App\Models\Perumahan_developer;
use App\Models\Pengajuan_developer;
use App\Models\Pengajuan_developer_detail;
use App\Models\Tlu_status_pengajuan_developer;
use App\Models\Tlu_status_pengajuan_blok_rumah;
use App\Models\Log_pengajuan_developer;
use App\Models\Log_pengajuan_blok_rumah;

class DpdController extends Controller
{
    //
    public function index(){
        // return view('dashboards.admins.index');
        return view('dpd.dashboard-dpd');
    }    

    public function listPengajuan(Request $request) {

        $user = User::find(Auth::id());
        // $dpd = $user->dpds()->get();
        $dpd = $user->dpds()->first();
        $dpdProvinceCode = $dpd->province_code;
        $dpdId = $dpd->id;
        // return $dpd;       
        // return $dpdProvinceCode;

        $provinces = Province::pluck('name', 'code');
        // $developers = Developer::pluck('nama_perusahaan', 'id');
        // DB::enableQueryLog();
        // $developers = Developer::whereHas('pengajuan_developers', function ($query) use ($dpdProvinceCode) {
        //     $query->where('province_code_apersi', $dpdProvinceCode);
        // })->pluck('nama_perusahaan', 'id');
        $developers = Developer::whereRelation('pengajuan_developers', 'province_code_apersi', $dpdProvinceCode)->pluck('nama_perusahaan', 'id');
        // $quries = DB::getQueryLog();
        // dd($quries);

        //  $perumahanDevelopers = Perumahan_developer::where('developer_id', $request->developer_id)
        // ->pluck('nama_perumahan', 'id');
        $perumahanDevelopers = Perumahan_developer::whereRelation('pengajuan_developers', 'province_code_apersi', $dpdProvinceCode)->pluck('nama_perumahan', 'id');            
        
        $statusPengajuanLists = collect([
            // ['id' => '11, 61', 'nama_status' => 'Pengajuan Baru'],
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

        // DB::enableQueryLog();
        $pengajuanDevelopers = Pengajuan_developer::where([
            ['pengajuan_developers.province_code_apersi', '=', $dpdProvinceCode],
            ['pengajuan_developers.pengajuan_ke_apersi', '=', 1], 
            [function ($query) use ($request) {

                if (!empty($request->kode_pengajuan)) {
                    $query->where('kode_pengajuan', 'LIKE', '%'.$request->kode_pengajuan.'%');
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
            

        return view('dpd.list-pengajuan-developer', compact(
            // 'developerId',
            'pengajuanDevelopers',
            'provinces',
            'developers',
            'perumahanDevelopers',
            'statusPengajuanLists',
            'perPageLists'
        ));

    }

    public function detailPengajuan(Request $request) {
        
        $pengajuanDeveloper = Pengajuan_developer::find($request->id);
        $pengajuanDeveloperDetails = Pengajuan_developer_detail::where('pengajuan_developer_id', $pengajuanDeveloper->id)->get();
        // return $pengajuanDeveloper;
        $logPengajuanDevelopers = Log_pengajuan_developer::where('pengajuan_developer_id', $pengajuanDeveloper->id)->get();

        // $tluStatusPengajuanDeveloper = Tlu_status_pengajuan_developer::find($detailPengajuan->tlu_sts_peng_dev_id);
        $pilihanStatus = $pengajuanDeveloper->tlu_status_pengajuan_developer->pilihan_status;
        $pilihanStatus = json_decode($pilihanStatus, true);
        // $key = 'dpd';
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

        return view('dpd.detail-pengajuan-developer', compact(
                'pengajuanDeveloper', 
                'pengajuanDeveloperDetails',
                'logPengajuanDevelopers',
                'roleStatus'
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
        $userId = Auth::id();

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
                'user_id' => $userId
            ]); 

            $pengajuanDeveloper->tlu_sts_peng_dev_id = $request->id_status;
            $pengajuanDeveloper->save();

            if ($request->id_status == 31) {

                foreach ($blokRumahs as $blok) {

                    $pengajuanDeveloperDetails = Pengajuan_developer_detail::find($blok->id);
                    $idStatus = 21;
                    if ($blok->checked) {
                        $idStatus = 31;
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

}
