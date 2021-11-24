<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perumahan_developer;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PerumahanDeveloperController extends Controller
{
    //
    public function index(Request $request)
    {
        //return "developer id = ".$request->id;
        // return view('perumahanDeveloper.index');
        $input = $request->all();
        // print_r($input);
        $developer_id = $request->developer_id;
        // $perumahanDevelopers = Perumahan_developer::where('developer_id', $request->id)->paginate(1);
        $perumahanDevelopers = Perumahan_developer::select('*')
            ->where('developer_id', '=', $developer_id)
            ->where('nama_perumahan', 'LIKE','%'.$request->nama_perumahan.'%')
            ->paginate(5)->withQueryString();
        // return $perumahanDevelopers;
        return view('perumahanDeveloper.index', compact('perumahanDevelopers', 'developer_id'));
    }

    public function tambah(Request $request)
    {
        // $input = $request->all();
        // print_r($input);

        $provinces = Province::pluck('name', 'code');
        $cities = City::where('province_code', $request->old('province_code'))->pluck('name', 'code');
        $districts = District::where('city_code', $request->old('city_code'))->pluck('name', 'code');
        $villages = Village::where('district_code', $request->old('district_code'))->pluck('name', 'code');    
        $user = User::find(Auth::id());
        $developer = $user->developers()->first();
        return view('perumahanDeveloper.tambah-perumahan', compact(
            'developer',
            'provinces',
            'cities',
            'districts', 
            'villages'
            ));
    }

    public function edit(Request $request) {

        $perumahanDeveloper = Perumahan_developer::find($request->id);
        $provinceCode = $request->old('province_code') !== null ? $request->old('province_code') : $perumahanDeveloper->province_code;
        $cityCode = $request->old('city_code') !== null ? $request->old('city_code') : $perumahanDeveloper->city_code;
        $districtCode = $request->old('district_code') !== null ? $request->old('district_code') : $perumahanDeveloper->district_code; 
        
        $provinces = Province::pluck('name', 'code');
        $cities = City::where('province_code', $provinceCode)->pluck('name', 'code');
        $districts = District::where('city_code', $cityCode)->pluck('name', 'code');
        $villages = Village::where('district_code', $districtCode)->pluck('name', 'code');
        // $user = User::find(Auth::id());
        // $developer = $user->developers()->first();
        return view('perumahanDeveloper.edit-perumahan', compact(
            'perumahanDeveloper', 
            'provinces',
            'cities',
            'districts',
            'villages'
        ));
    }

    public function simpan(Request $request) 
    {

        $input = $request->all();
        // return $input;

        // $request->validate(
        //     [
        //         'nama_perumahan' => 'required',
        //         'province_code'=>'required',
        //         'city_code'=>'required', 
        //         'district_code'=>'required',     
        //         'village_code'=>'required',
        //         'alamat'=>'required',        
                
        //     ], 
        //     [
        //         'nama_perumahan.required' => 'Nama perumahan harus diisi',
        //         'province_code.required' => 'Provinsi belum dipilih',
        //         'city_code.required' => 'Kabupaten/Kota belum dipilih',
        //         'district_code.required' => 'Kecamatan belum dipilih',
        //         'village_code.required' => 'Desa belum dipilih',
        //         'alamat.required' => 'Alamat belum dipilih',
        //     ]
        // );    
        
        $rules = [
            // 'nama_perumahan' => 'required|unique:perumahan_developers,nama_perumahan,' . $request->id,
            'nama_perumahan' => ['required', Rule::unique('perumahan_developers')->where('developer_id', $request->developer_id)->ignore($request->id)],
            'province_code'=>'required',
            'city_code'=>'required', 
            'district_code'=>'required',     
            'village_code'=>'required',
        ];

        $messages = [
            'nama_perumahan.required' => 'Nama perumahan harus diisi',
            'nama_perumahan.unique' => 'sudah terdaftar',
            'province_code.required' => 'Provinsi belum dipilih',
            'city_code.required' => 'Kabupaten/Kota belum dipilih',
            'district_code.required' => 'Kecamatan belum dipilih',
            'village_code.required' => 'Desa belum dipilih',
        ];        
       
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            // return redirect()->route('developer.tambahPerumahanDeveloper', ['developer_id'=>$request->developer_id])->withInput()->withErrors($validator->errors());
            if (isset($request->id)) {
                return redirect()->route('developer.editPerumahanDeveloper', ['id'=>$request->id])->withInput()->withErrors($validator->errors());    
            }
            return redirect()->route('developer.tambahPerumahanDeveloper', ['developer_id'=>$request->developer_id])->withInput()->withErrors($validator->errors());        
        }

        // return $input;
        $createPerumahanDeveloper = Perumahan_developer::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'developer_id'=>$request->developer_id,
                'nama_perumahan'=>$request->nama_perumahan,
                'province_code'=>$request->province_code,
                'city_code'=>$request->city_code,
                'district_code'=>$request->district_code,
                'village_code'=>$request->village_code,
                'kampung'=>$request->kampung,
                'alamat'=>$request->alamat,
            ]
        );
        return redirect()->route('developer.listPerumahanDeveloper', ['developer_id'=>$request->developer_id])->with('success','Data berhasil disimpan.'); 
        // return $input;

    }   

    public function delete(Request $request) {
        $perumahanDeveloper = Perumahan_developer::find($request->id);
        $developerId = $perumahanDeveloper->developer_id;

        if ($perumahanDeveloper->delete()) {
            return redirect()->route('developer.listPerumahanDeveloper', ['developer_id'=>$developerId])->with('success','Data berhasil dihapus.'); 
        }else{
            return redirect()->route('developer.listPerumahanDeveloper', ['developer_id'=>$developerId])->with('fail','Data gagal dihapus.');
        }

    }

    public function getPerumahanDeveloperAdditionalInfo(Request $request) {
        // $input = $request->all();
        // return $input;
        $perumahanDeveloper = Perumahan_developer::find($request->id);
        return view('perumahanDeveloper.perumahan-developer-additional-info', compact(
            'perumahanDeveloper'
        ));
    }

}
