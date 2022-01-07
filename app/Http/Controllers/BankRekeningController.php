<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tlu_bank;

class BankRekeningController extends Controller
{

    public function index(Request $request) {

        $tluBanks = Tlu_bank::select('*')
            ->where('nama_bank', 'LIKE','%'.$request->nama_bank.'%')
            ->paginate(10)->withQueryString();
        // return $perumahanDevelopers;
        return view('bankRekening.index', compact('tluBanks'));

    }

    public function tambah() {
        return view('bankRekening.tambah');
    }

    public function edit(Request $request) {
     
        $tluBank = Tlu_bank::find($request->id);
        return view('bankRekening.edit', compact(
            'tluBank'
        ));        
        
    }

    public function simpan(Request $request)
    {

        // $input = $request->all();
        // return response()->json($input);

        $request->validate(
            [
                'nama_bank' => 'required|unique:tlu_banks,nama_bank,' . $request->id,
            ], 
            [
                'nama_bank.required' => 'Nama bank harus diisi',
                'nama_bank.unique' => 'sudah terdaftar',
            ]
        );        


        $simpan = Tlu_bank::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nama_bank'=>$request->nama_bank,
            ]
        );

        if ($simpan) {
            return redirect()->route('konsultan.bankRekening', )->with('success','Data berhasil disimpan.'); 
        }else{
            return redirect()->route('konsultan.bankRekening', )->with('fail','Data gagal disimpan.'); 
        }    
    }

    public function delete(Request $request) {

        // $input = $request->all();
        // return $input;

        $tluBank = Tlu_bank::find($request->id);

        if ($tluBank->delete()) {
            return redirect()->route('konsultan.bankRekening')->with('success','Data berhasil dihapus.'); 
        }else{
            return redirect()->route('konsultan.bankRekening')->with('fail','Data gagal dihapus.');
        }

    }


}
