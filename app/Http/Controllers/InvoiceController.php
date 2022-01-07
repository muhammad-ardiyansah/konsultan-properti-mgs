<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Developer;
use App\Models\Perumahan_developer;
use Laravolt\Indonesia\Models\Province;
use App\Models\Pengajuan_developer;
use App\Models\Pengajuan_developer_detail;


class InvoiceController extends Controller
{
    
    public function indexInvoiceKonsultan(Request $request) {
        
        // $input = $request->all();        
        // return $input;

        // $user = User::find(Auth::id());
        // $developer = $user->developers()->first();       
        // $developerId = $developer->id;
        $provinces = Province::pluck('name', 'code');
        $developers = Developer::pluck('nama_perusahaan', 'id');
        $perumahanDevelopers = Perumahan_developer::where('developer_id', $request->developer_id)
        ->pluck('nama_perumahan', 'id');

        
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

        $searchAtInvoiceHeader = false;
        if ( ($request->status_invoice != 1) &&  (!empty($request->no_invoice) || !empty($request->periode_invoice)) ) {
            $searchAtInvoiceHeader = true;
        }



        DB::enableQueryLog();
        $pengajuanDevelopers = Pengajuan_developer::where([
            ['pengajuan_developers.tlu_sts_peng_dev_id', '=', 71], 
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
            ])->when($searchAtInvoiceHeader, function ($query, $role) use ($request) {
                $query->whereHas('invoice_header', function ($q) use ($request) {
                    
                        if (!empty($request->no_invoice)) {
                            $q->where('no_invoice',  'LIKE', '%'.$request->no_invoice.'%');
                        }

                        if (!empty($request->periode_invoice)) {
                            $arrPeriodeInvoice = explode('-', $request->periode_invoice);
                            $periodeInvoiceAwal = \Carbon\Carbon::parse($arrPeriodeInvoice[0]." 00:00:00");
                            $periodeInvoiceAkhir = \Carbon\Carbon::parse($arrPeriodeInvoice[1]." 23:59:59");
        
                            // echo "periodeInvoiceAwal : ".$periodeInvoiceAwal->format('Y-m-d H:i:s');
                            // echo "<br />";
                            // echo "periodeInvoiceAkhir : ".$periodeInvoiceAkhir->format('Y-m-d H:i:s');
                            // echo "<br />";
        
                            $startDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $periodeInvoiceAwal->format('Y-m-d H:i:s'));
                            $endDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $periodeInvoiceAkhir->format('Y-m-d H:i:s'));
                            
                            // echo $startDate." - ".$endDate;
        
                            $q->whereBetween('timestamp_pembuatan', [$startDate, $endDate]);
                        }    

                });
            })->when(!$searchAtInvoiceHeader, function ($query, $role) use ($request) {
                $query->doesntHave('invoice_header');
            })
            ->sortable()->paginate($perPage)->withQueryString();
                // ])->toSql();
            // dd($pengajuanDevelopers);
            // $quries = DB::getQueryLog();
            // dd($quries);
            

        return view('invoice.index-invoice-konsultan', compact(
            // 'developerId',
            'pengajuanDevelopers',
            'provinces',
            'developers',
            'perumahanDevelopers',
            'perPageLists'
        ));
    }  

    public function invoicePageKonsultan(Request $request) {

        $pengajuanDeveloper = Pengajuan_developer::find($request->id);
        // return $pengajuanDeveloper;
        $pengajuanDeveloperDetails = Pengajuan_developer_detail::where('pengajuan_developer_id', $pengajuanDeveloper->id)->get();

        return view('invoice.invoice-page-konsultan', compact(
            'pengajuanDeveloper',
            'pengajuanDeveloperDetails',
        ));

    }


}
