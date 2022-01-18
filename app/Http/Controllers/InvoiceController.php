<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Developer;
use App\Models\Perumahan_developer;
use Laravolt\Indonesia\Models\Province;
use App\Models\Pengajuan_developer;
use App\Models\Pengajuan_developer_detail;
use App\Models\Invoice_header;
use App\Models\Invoice_detail;
use App\Models\Tlu_bank;
use App\Models\Tlu_no_rekening;
use App\Models\Jurnal_developer;

class InvoiceController extends Controller
{
    
    public function indexInvoiceKonsultanOld(Request $request) {
        
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

    public function indexInvoiceKonsultan(Request $request) {

        // if ($request->all()) {
        // $input = $request->all();        
        // return $input;
        // }

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

        $searchAtPengajuanDeveloper = false;
        if ( !empty($request->kode_pengajuan) || $request->approval != 0 || !empty($request->developer_id) || !empty($request->perumahan_developer_id) ) {
            $searchAtPengajuanDeveloper = true;
        }

        DB::enableQueryLog();

        $invoiceHeaders = Invoice_header::when(!empty($request->no_invoice), function ($query, $role) use ($request) {
            $query->where('no_invoice', 'LIKE', '%'.$request->no_invoice.'%');
        })->when(!empty($request->invoice_date), function ($query, $role) use ($request) {

            $arrInvoiceDate = explode('-', $request->invoice_date);
            $invoiceDateAwal = \Carbon\Carbon::parse($arrInvoiceDate[0]);
            $invoiceDateAkhir = \Carbon\Carbon::parse($arrInvoiceDate[1]);

            // echo "invoiceDateAwal : ".$invoiceDateAwal->format('Y-m-d');
            // echo "<br />";
            // echo "invoiceDateAkhir : ".$invoiceDateAkhir->format('Y-m-d');
            // echo "<br />";

            // $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $invoiceDateAwal->format('Y-m-d'));
            // $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $invoiceDateAkhir->format('Y-m-d'));
            
            $startDate = $invoiceDateAwal->format('Y-m-d');
            $endDate = $invoiceDateAkhir->format('Y-m-d');

            // echo $startDate." - ".$endDate;

             $query->whereBetween('invoice_date', [$startDate, $endDate]);
        
        })->when(!empty($request->invoice_due_date), function ($query, $role) use ($request) {

            $arrInvoiceDueDate = explode('-', $request->invoice_due_date);
            $invoiceDueDateAwal = \Carbon\Carbon::parse($arrInvoiceDueDate[0]);
            $invoiceDueDateAkhir = \Carbon\Carbon::parse($arrInvoiceDueDate[1]);

            // echo "invoiceDueDateAwal : ".$invoiceDueDateAwal->format('Y-m-d');
            // echo "<br />";
            // echo "invoiceDueDateAkhir : ".$invoiceDueDateAkhir->format('Y-m-d');
            // echo "<br />";

            // $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $invoiceDueDateAwal->format('Y-m-d'));
            // $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $invoiceDueDateAkhir->format('Y-m-d'));
            
            $startDate = $invoiceDueDateAwal->format('Y-m-d');
            $endDate = $invoiceDueDateAkhir->format('Y-m-d');

            // echo $startDate." - ".$endDate;

             $query->whereBetween('invoice_due_date', [$startDate, $endDate]);
        
        })->when($searchAtPengajuanDeveloper, function ($query, $role) use ($request) {
            $query->whereHas('pengajuan_developer', function ($q) use ($request) {
                
                if (!empty($request->kode_pengajuan)) {
                    $q->where('kode_pengajuan',  'LIKE', '%'.$request->kode_pengajuan.'%');
                }

                if ($request->approval ==1){
                    $q->whereNull('province_code_apersi');
                }

                if ($request->approval ==2){
                    $q->whereNotNull('province_code_apersi');

                    if (!empty($request->province_code_apersi)) {
                        $q->where('province_code_apersi', $request->province_code_apersi);
                    }    
                    
                }                

                if (!empty($request->developer_id)) {
                    $q->where('developer_id', $request->developer_id);
                }

                if (!empty($request->perumahan_developer_id)) {
                    $q->where('perumahan_developer_id', $request->perumahan_developer_id);
                }                
   

            });
        })
        ->sortable()->paginate($perPage)->withQueryString();


        // dd($pengajuanDevelopers);
        // $quries = DB::getQueryLog();
        // dd($quries);

        return view('invoice.index-invoice-konsultan', compact(
            // 'developerId',
            'invoiceHeaders',
            'provinces',
            'developers',
            'perumahanDevelopers',
            'perPageLists'
        ));


    }

    public function tambahInvoiceKonsultan(Request $request) {

        $isKodePengajuanWasSet = false;
        $isPengajuanExist = false;
        $pengajuanDeveloper = [];
        $pengajuanDeveloperDetails = [];
        $denganApersi = false;
        $jmlBlokRumahDiajukan = 0;
        $blokRumahDisetujui = '';
        $jmlBlokRumahDisetujui = 0;

        if (isset($request->kode_pengajuan)) {

            $isKodePengajuanWasSet = true;
            $pengajuanDeveloper = Pengajuan_developer::where('kode_pengajuan', $request->kode_pengajuan)->first();
            // return $pengajuanDeveloper;

            if (!empty($pengajuanDeveloper->province_code_apersi)) $denganApersi = true;

            // if ($pengajuanDeveloper->count() > 0) {
            if (!empty($pengajuanDeveloper)) {

                $pengajuanDeveloperDetails = Pengajuan_developer_detail::where('pengajuan_developer_id', $pengajuanDeveloper->id)->doesntHave('invoice_detail')->get();
                // return $pengajuanDeveloperDetails;
                $blokRumahDisetujui = Pengajuan_developer_detail::select('blok_rumah')
                ->where('pengajuan_developer_id', $pengajuanDeveloper->id)
                ->where(function($query){
                    $query->where('tlu_sts_peng_blk_rmh_id', 31)
                          ->orWhere('tlu_sts_peng_blk_rmh_id', 71);

                })->get()->pluck('blok_rumah')->toArray();
                // print_r($blokRumahDisetujui);
                $jmlBlokRumahDiajukan = count(explode(',', $pengajuanDeveloper->blok_rumah));
                $jmlBlokRumahDisetujui = count($blokRumahDisetujui);
                $blokRumahDisetujui = implode(',', $blokRumahDisetujui);
                 
                // return $blokRumahDisetujui;

                $isPengajuanExist = true;

            }

        }    

        return view('invoice.tambah-invoice-konsultan', compact(
            'isKodePengajuanWasSet',
            'isPengajuanExist',
            'denganApersi',
            'jmlBlokRumahDiajukan',
            'blokRumahDisetujui',
            'jmlBlokRumahDisetujui',
            'pengajuanDeveloper',
            'pengajuanDeveloperDetails',
        ));

    }

    public function editInvoiceKonsultan(Request $request) {
        
        $invoiceHeader = Invoice_header::find($request->id);
        $invoiceDetails = Invoice_detail::where('invoice_header_id', $invoiceHeader->id)->orderBy('harga_satuan')->get();
        $invoiceDetailsGroupBy = $invoiceDetails->groupBy('harga_satuan');
        // return $invoiceDetailsGroupBy;

        $pengajuanDeveloper = Pengajuan_developer::find($invoiceHeader->pengajuan_developer_id);
        if (!empty($pengajuanDeveloper->province_code_apersi)) $denganApersi = true;

        $blokRumahDisetujui = Pengajuan_developer_detail::select('blok_rumah')
        ->where('pengajuan_developer_id', $invoiceHeader->pengajuan_developer_id)
        ->where(function($query){
            $query->where('tlu_sts_peng_blk_rmh_id', 31)
                  ->orWhere('tlu_sts_peng_blk_rmh_id', 71);

        })->get()->pluck('blok_rumah')->toArray();
        // print_r($blokRumahDisetujui);
        $jmlBlokRumahDiajukan = count(explode(',', $pengajuanDeveloper->blok_rumah));
        $jmlBlokRumahDisetujui = count($blokRumahDisetujui);
        $blokRumahDisetujui = implode(',', $blokRumahDisetujui);
        
        return view('invoice.edit-invoice-konsultan', compact(
            'invoiceHeader',
            'invoiceDetails',
            'invoiceDetailsGroupBy',
            'pengajuanDeveloper',
            'denganApersi',
            'jmlBlokRumahDiajukan',
            'jmlBlokRumahDisetujui',
            'blokRumahDisetujui',
        ));

    }

    public function simpanInvoiceKonsultan(Request $request) {

        // $input = $request->all();        
        // return $input;
        
        $kodeUnik = $this->generateUniqueNumber();
        // return $kodeUnik;

        $request->validate(
            [
                'no_invoice' => 'required|unique:invoice_headers,no_invoice,' . $request->id,
                'nama_perusahaan' => 'required',
                'nama' => 'required',
                'harga_jasa_satuan.*' => 'required_with:blok_rumah_inv.*'
            ], 
            [
                'no_invoice.required' => 'No. invoice harus diisi',
                'no_invoice.unique' => 'sudah terdaftar',
                'nama_perusahaan.required' => 'Nama perusahaan harus diisi',
                'nama.required' => 'Nama harus diisi', 
                'harga_jasa_satuan.*.required_with' => 'Isikan harga satuan'
            ]
        );        

        // $input = $request->all();        
        // return $input;        

        DB::beginTransaction();

        try {       

            $newInvoiceHeader = Invoice_header::create([
                'developer_id' => $request->developer_id,
                'pengajuan_developer_id' => $request->pengajuan_developer_id, 
                'no_invoice' => $request->no_invoice, 
                'nama_perusahaan' => $request->nama_perusahaan, 
                'no_telpon' => $request->no_telpon, 
                'nama' => $request->nama, 
                'alamat' => $request->alamat, 
                'npwp' => $request->npwp, 
                'ktp_nik' => $request->ktp_nik, 
                'email' => $request->email,
                'referensi' => $request->referensi,
                'no_referensi' => $request->no_referensi,
                // 'keterangan',
                // 'blok_invoice',
                'invoice_date' => $request->invoice_date,
                'invoice_due_date' => $request->invoice_due_date, 
                'keterangan' => $request->keterangan,
                'kode_unik' => $kodeUnik,
                // 'jumlah_tagihan',
                // 'total_tagihan'              
            ]);

            $jumlahTagihan = 0;
            $hargaJasaSatuan = 0;
            $arrBlokRumah = [];
            $invoiceDetails = [];
            // foreach ($request->blok_rumah_inv as $blokRumah) {
            for ($idx = 0; $idx < count($request->blok_rumah_inv); $idx++) {   
                
                if(!empty($request->blok_rumah_inv[$idx])) {

                    $hargaJasaSatuan = str_replace(".","", $request->harga_jasa_satuan[$idx]);
                    $jumlahTagihan = $jumlahTagihan + $hargaJasaSatuan; 
                    array_push($arrBlokRumah, $request->blok_rumah_inv[$idx]);

                    $invoiceDetails[] = [
                        'invoice_header_id' => $newInvoiceHeader->id,
                        'pengajuan_developer_detail_id' => $request->blok_rumah_inv[$idx],
                        'harga_satuan' => $hargaJasaSatuan,    
                    ];

                }

            }             

            if (count($invoiceDetails) > 0) {
                Invoice_detail::insert($invoiceDetails); 

                $blokRumahInvoice = Pengajuan_developer_detail::select('blok_rumah')
                ->whereIn('id', $arrBlokRumah)
                ->get()->pluck('blok_rumah')->toArray();
                // return $blokRumahInvoice;

                $newInvoiceHeader->blok_invoice = implode(',', $blokRumahInvoice);
                $newInvoiceHeader->jumlah_tagihan = $jumlahTagihan;
                $newInvoiceHeader->total_tagihan = $jumlahTagihan + $kodeUnik;
                $newInvoiceHeader->save();

                $newJurnalDeveloper = Jurnal_developer::create([
                    'developer_id' => $request->developer_id,
                    'invoice_header_id' => $newInvoiceHeader->id, 
                    'param' => 'TAGIHAN',
                    'jumlah' => (0 - $jumlahTagihan),
                    'jumlah_rubah_jadi' => (0 - $jumlahTagihan),
                ]);    

            }

            // Commit Transaction
            DB::commit();
            // Semua proses benar
            // return redirect()->back()->with('success','Invoice berhasil dibuat.');
            return redirect()->route('konsultan.editInvoiceKonsultan', ['id'=>$newInvoiceHeader->id])->with('success','Invoice berhasil dibuat');     
        } catch (Exception $e) {       
            // Rollback Transaction
            DB::rollback();
            return redirect()->back()->with('fail',$e->getErrors());
            // throw $e;
            // ada yang error   
        }


    }

    public function generateUniqueNumber()
    {
        do {
            $code = random_int(0, 1000);
        } while (Invoice_header::where("kode_unik", "=", $code)->first());
  
        return $code;
    }

    public function viewInvoiceKonsultan(Request $request) {

        $invoiceHeader = Invoice_header::find($request->id);
        $invoiceDetails = Invoice_detail::where('invoice_header_id', $invoiceHeader->id)->orderBy('harga_satuan')->get();
        $invoiceDetailsGroupBy = $invoiceDetails->groupBy('harga_satuan');
        // return $invoiceDetailsGroupBy;

        $pengajuanDeveloper = Pengajuan_developer::find($invoiceHeader->pengajuan_developer_id);

        $blokRumahDisetujui = Pengajuan_developer_detail::select('blok_rumah')
        ->where('pengajuan_developer_id', $invoiceHeader->pengajuan_developer_id)
        ->where(function($query){
            $query->where('tlu_sts_peng_blk_rmh_id', 31)
                  ->orWhere('tlu_sts_peng_blk_rmh_id', 71);

        })->get()->pluck('blok_rumah')->toArray();
        // print_r($blokRumahDisetujui);
        $jmlBlokRumahDiajukan = count(explode(',', $pengajuanDeveloper->blok_rumah));
        $jmlBlokRumahDisetujui = count($blokRumahDisetujui);
        $blokRumahDisetujui = implode(',', $blokRumahDisetujui);

        $tluNoRekenings = Tlu_no_rekening::All();

        return view('invoice.view-invoice-konsultan', compact(
            'invoiceHeader',
            'invoiceDetails',
            'invoiceDetailsGroupBy',
            'pengajuanDeveloper',
            'jmlBlokRumahDiajukan',
            'jmlBlokRumahDisetujui',
            'blokRumahDisetujui',
            'tluNoRekenings',
        ));

    }

    public function indexInvoiceDeveloper(Request $request) {

        // if ($request->all()) {
        // $input = $request->all();        
        // return $input;
        // }

        $user = User::find(Auth::id());
        $developer = $user->developers()->first();       
        $developerId = $developer->id;

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

        $searchAtPengajuanDeveloper = false;
        if ( !empty($request->kode_pengajuan) || $request->approval != 0 || !empty($request->developer_id) || !empty($request->perumahan_developer_id) ) {
            $searchAtPengajuanDeveloper = true;
        }

        DB::enableQueryLog();

        $invoiceHeaders = Invoice_header::where('developer_id', $developerId)->when(!empty($request->no_invoice), function ($query, $role) use ($request) {
            $query->where('no_invoice', 'LIKE', '%'.$request->no_invoice.'%');
        })->when(!empty($request->invoice_date), function ($query, $role) use ($request) {

            $arrInvoiceDate = explode('-', $request->invoice_date);
            $invoiceDateAwal = \Carbon\Carbon::parse($arrInvoiceDate[0]);
            $invoiceDateAkhir = \Carbon\Carbon::parse($arrInvoiceDate[1]);

            // echo "invoiceDateAwal : ".$invoiceDateAwal->format('Y-m-d');
            // echo "<br />";
            // echo "invoiceDateAkhir : ".$invoiceDateAkhir->format('Y-m-d');
            // echo "<br />";

            // $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $invoiceDateAwal->format('Y-m-d'));
            // $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $invoiceDateAkhir->format('Y-m-d'));
            
            $startDate = $invoiceDateAwal->format('Y-m-d');
            $endDate = $invoiceDateAkhir->format('Y-m-d');

            // echo $startDate." - ".$endDate;

             $query->whereBetween('invoice_date', [$startDate, $endDate]);
        
        })->when(!empty($request->invoice_due_date), function ($query, $role) use ($request) {

            $arrInvoiceDueDate = explode('-', $request->invoice_due_date);
            $invoiceDueDateAwal = \Carbon\Carbon::parse($arrInvoiceDueDate[0]);
            $invoiceDueDateAkhir = \Carbon\Carbon::parse($arrInvoiceDueDate[1]);

            // echo "invoiceDueDateAwal : ".$invoiceDueDateAwal->format('Y-m-d');
            // echo "<br />";
            // echo "invoiceDueDateAkhir : ".$invoiceDueDateAkhir->format('Y-m-d');
            // echo "<br />";

            // $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $invoiceDueDateAwal->format('Y-m-d'));
            // $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $invoiceDueDateAkhir->format('Y-m-d'));
            
            $startDate = $invoiceDueDateAwal->format('Y-m-d');
            $endDate = $invoiceDueDateAkhir->format('Y-m-d');

            // echo $startDate." - ".$endDate;

             $query->whereBetween('invoice_due_date', [$startDate, $endDate]);
        
        })->when($searchAtPengajuanDeveloper, function ($query, $role) use ($request) {
            $query->whereHas('pengajuan_developer', function ($q) use ($request) {
                
                if (!empty($request->kode_pengajuan)) {
                    $q->where('kode_pengajuan',  'LIKE', '%'.$request->kode_pengajuan.'%');
                }

                if ($request->approval ==1){
                    $q->whereNull('province_code_apersi');
                }

                if ($request->approval ==2){
                    $q->whereNotNull('province_code_apersi');

                    if (!empty($request->province_code_apersi)) {
                        $q->where('province_code_apersi', $request->province_code_apersi);
                    }    
                    
                }                

                if (!empty($request->developer_id)) {
                    $q->where('developer_id', $request->developer_id);
                }

                if (!empty($request->perumahan_developer_id)) {
                    $q->where('perumahan_developer_id', $request->perumahan_developer_id);
                }                
   

            });
        })
        ->sortable()->paginate($perPage)->withQueryString();


        // dd($pengajuanDevelopers);
        // $quries = DB::getQueryLog();
        // dd($quries);

        return view('invoice.index-invoice-developer', compact(
            // 'developerId',
            'invoiceHeaders',
            'provinces',
            'developers',
            'perumahanDevelopers',
            'perPageLists'
        ));


    }

    public function viewInvoiceDeveloper(Request $request) {

        $invoiceHeader = Invoice_header::find($request->id);
        $invoiceDetails = Invoice_detail::where('invoice_header_id', $invoiceHeader->id)->orderBy('harga_satuan')->get();
        $invoiceDetailsGroupBy = $invoiceDetails->groupBy('harga_satuan');
        // return $invoiceDetailsGroupBy;

        $pengajuanDeveloper = Pengajuan_developer::find($invoiceHeader->pengajuan_developer_id);

        $blokRumahDisetujui = Pengajuan_developer_detail::select('blok_rumah')
        ->where('pengajuan_developer_id', $invoiceHeader->pengajuan_developer_id)
        ->where(function($query){
            $query->where('tlu_sts_peng_blk_rmh_id', 31)
                  ->orWhere('tlu_sts_peng_blk_rmh_id', 71);

        })->get()->pluck('blok_rumah')->toArray();
        // print_r($blokRumahDisetujui);
        $jmlBlokRumahDiajukan = count(explode(',', $pengajuanDeveloper->blok_rumah));
        $jmlBlokRumahDisetujui = count($blokRumahDisetujui);
        $blokRumahDisetujui = implode(',', $blokRumahDisetujui);

        $tluNoRekenings = Tlu_no_rekening::All();

        return view('invoice.view-invoice-developer', compact(
            'invoiceHeader',
            'invoiceDetails',
            'invoiceDetailsGroupBy',
            'pengajuanDeveloper',
            'jmlBlokRumahDiajukan',
            'jmlBlokRumahDisetujui',
            'blokRumahDisetujui',
            'tluNoRekenings',
        ));

    }

    public function tambahKonfirmasiDeveloper(Request $request) {

        $invoiceHeader = Invoice_header::find($request->id);
        $invoiceDetails = Invoice_detail::where('invoice_header_id', $invoiceHeader->id)->orderBy('harga_satuan')->get();
        $invoiceDetailsGroupBy = $invoiceDetails->groupBy('harga_satuan');
        // return $invoiceDetailsGroupBy;

        $pengajuanDeveloper = Pengajuan_developer::find($invoiceHeader->pengajuan_developer_id);

        $blokRumahDisetujui = Pengajuan_developer_detail::select('blok_rumah')
        ->where('pengajuan_developer_id', $invoiceHeader->pengajuan_developer_id)
        ->where(function($query){
            $query->where('tlu_sts_peng_blk_rmh_id', 31)
                  ->orWhere('tlu_sts_peng_blk_rmh_id', 71);

        })->get()->pluck('blok_rumah')->toArray();
        // print_r($blokRumahDisetujui);
        $jmlBlokRumahDiajukan = count(explode(',', $pengajuanDeveloper->blok_rumah));
        $jmlBlokRumahDisetujui = count($blokRumahDisetujui);
        $blokRumahDisetujui = implode(',', $blokRumahDisetujui);

        $tluNoRekenings = Tlu_no_rekening::All();

        return view('invoice.tambah-konfirmasi-developer', compact(
            'invoiceHeader',
            'invoiceDetails',
            'invoiceDetailsGroupBy',
            'pengajuanDeveloper',
            'jmlBlokRumahDiajukan',
            'jmlBlokRumahDisetujui',
            'blokRumahDisetujui',
            'tluNoRekenings',
        ));

    }

    public function simpanKonfirmasiDeveloper(Request $request) {
        
        // $input = $request->all();        
        // return $input;

        $request->validate(
            [
                'tlu_no_rekening_id' => 'required',
                'bank_pengirim' => 'required',
                'no_rekening_pengirim' => 'required',
                'nama_pemilik_rekening_pengirim' => 'required',
                'tgl_transfer' => 'required',
                'bukti_transfer' => 'required',
                'jumlah_konfirmasi' => 'required',
            ], 
            [
                'tlu_no_rekening_id.required' => 'No. Rekening tujuan belum dipilih',
                'bank_pengirim.required' => 'Bank pengirim belum diisi',
                'no_rekening_pengirim.required' => 'No. rekening pengirim belum diisi',
                'nama_pemilik_rekening_pengirim.required' => 'Nama pemilik rekening belum diisi', 
                'tgl_transfer.required' => 'Tanggal transfer belum diisi',
                'bukti_transfer.required' => 'Bukti transfer belum dipilih',
                'jumlah_konfirmasi.required' => 'Jumlah Konfirmasi belum diisi',
                
            ]
        );


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
