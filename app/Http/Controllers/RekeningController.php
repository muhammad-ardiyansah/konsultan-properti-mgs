<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tlu_bank;
use App\Models\Tlu_no_rekening;
use Illuminate\Validation\Rule;

class RekeningController extends Controller
{
    public function indexRekeningKonsultan(Request $request) {

        $tluBanks = Tlu_bank::pluck('nama_bank', 'id');

        DB::enableQueryLog();
        $tluNoRekenings = Tlu_no_rekening::where([ 
            [function ($query) use ($request) {

                if (!empty($request->tlu_bank_id)) {
                    $query->where('tlu_bank_id', $request->tlu_bank_id);
                }

                if (!empty($request->no_rekening)) {
                    $query->where('no_rekening', 'LIKE', '%'.$request->no_rekening.'%');
                }                

                if (!empty($request->nama_pemilik_rekening)) {
                    $query->where('nama_pemilik_rekening', 'LIKE', '%'.$request->nama_pemilik_rekening.'%');
                }                                                

                
            }]
            ])->paginate(10)->withQueryString();
            // ])->toSql();
            // dd($pengajuanDevelopers);
            // $quries = DB::getQueryLog();
            // dd($quries);


        return view('rekening.index-rekening-konsultan', compact(
            'tluNoRekenings',
            'tluBanks'
        ));

    }

    public function tambahRekeningKonsultan(Request $request) {
        
        $tluBanks = Tlu_bank::pluck('nama_bank', 'id');

        return view('rekening.tambah-rekening-konsultan', compact(
            'tluBanks'
        ));

    }

    public function editRekeningKonsultan(Request $request) {
    
        $tluBanks = Tlu_bank::pluck('nama_bank', 'id');
        $tluNoRekening = Tlu_no_rekening::find($request->id);
        return view('rekening.edit-rekening-konsultan', compact(
            'tluBanks',
            'tluNoRekening'
        ));        
        
    }

    public function simpanRekeningKonsultan(Request $request)
    {

        // $input = $request->all();
        // return response()->json($input);

        $request->validate(
            [
                'tlu_bank_id'=>'required',
                'no_rekening' => ['required', Rule::unique('tlu_no_rekenings')->where('tlu_bank_id', $request->tlu_bank_id)->ignore($request->id)],
                'nama_pemilik_rekening'=>'required',
            ], 
            [
                'tlu_bank_id.required' => 'Nama Bank belum dipilih',
                'no_rekening.required' => 'Nomor rekening belum diisi',
                'no_rekening.unique' => 'sudah terdaftar untuk bank yang dipilih',
                'nama_pemilik_rekening.required' => 'Nama Pemilik Rekening belum diisi',
            ]
        );

        $simpan = Tlu_no_rekening::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'tlu_bank_id' => $request->tlu_bank_id,
                'no_rekening' => $request->no_rekening,
                'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
            ]
        );

        if ($simpan) {
            return redirect()->route('konsultan.indexRekeningKonsultan', )->with('success','Data berhasil disimpan.'); 
        }else{
            return redirect()->route('konsultan.indexRekeningKonsultan', )->with('fail','Data gagal disimpan.'); 
        }    
    }
    
    public function deleteRekeningKonsultan(Request $request) {

        // $input = $request->all();
        // return $input;

        $tluNoRekening = Tlu_no_rekening::find($request->id);

        if ($tluNoRekening->delete()) {
            return redirect()->route('konsultan.indexRekeningKonsultan')->with('success','Data berhasil dihapus.'); 
        }else{
            return redirect()->route('konsultan.indexRekeningKonsultan')->with('fail','Data gagal dihapus.');
        }

    }    


}
