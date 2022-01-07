<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengawas;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PengawasController extends Controller
{
    //
    function index(){
        // return view('dashboards.admins.index');
        return view('pengawas.dashboard-pengawas');
    }

    public function indexAjax(Request $request)
    {
        $pengawas = Pengawas::select('*')
            ->where('nama_perusahaan', 'LIKE','%'.$request->nama_perusahaan.'%')
            ->paginate(5)->withQueryString();
        // return $pengawas;
        return view('pengawas.index-ajax', compact('pengawas'));
    }    

    public function tambah(Request $request)
    {
        // $input = $request->all();
        // print_r($input);

        $provinces = Province::pluck('name', 'code');
        $cities = City::where('province_code', $request->old('province_code'))->pluck('name', 'code');
        $districts = District::where('city_code', $request->old('city_code'))->pluck('name', 'code');
        $urlTambah = $request->url_tambah;
        $urlList = $request->url_list;
        // echo "developer_id : ".$request->developer_id;
        return view('pengawas.tambah-pengawas', compact(
            'urlTambah',
            'urlList',
            'provinces',
            'cities',
            'districts'
            ));
    }

    public function edit(Request $request) {

        $pengawas = Pengawas::find($request->id);
        $provinceCode = $request->old('province_code') !== null ? $request->old('province_code') : $pengawas->province_code;
        $cityCode = $request->old('city_code') !== null ? $request->old('city_code') : $pengawas->city_code;
        $districtCode = $request->old('district_code') !== null ? $request->old('district_code') : $pengawas->district_code; 
        
        $provinces = Province::pluck('name', 'code');
        $cities = City::where('province_code', $provinceCode)->pluck('name', 'code');
        $districts = District::where('city_code', $cityCode)->pluck('name', 'code');
        

        $urlEdit = $request->url_edit;
        $urlList = $request->url_list;

        // $user = User::find(Auth::id());
        // $developer = $user->developers()->first();
        return view('pengawas.edit-pengawas', compact(
            'pengawas', 
            'provinces',
            'cities',
            'districts',
            'urlEdit',
            'urlList'
        ));
    }

    public function simpan(Request $request) 
    {
        // dd($request->url_list);
        $input = $request->all();
        // return $input;
        
        $rules = [
            // 'nama_perusahaan' => 'required|unique:perumahan_developers,nama_perumahan,' . $request->id,
            'no_register' => ['required', Rule::unique('pengawas')->ignore($request->id)],
            'nama_perusahaan' => ['required', Rule::unique('pengawas')->ignore($request->id)],
            'nama_direktur'=>'required',
            // 'email' => 'required|email|unique:pengawas',
            'email' => ['required', 'email', Rule::unique('pengawas')->ignore($request->id)],
            'province_code'=>'required',
            'city_code'=>'required', 
            'district_code'=>'required',     
        
        ];

        $messages = [
            'no_register.required' => 'No. Register harus diisi',
            'no_register.unique' => 'sudah terdaftar',
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi',
            'nama_perusahaan.unique' => 'sudah terdaftar',
            'nama_direktur.required'=>'Nama DIrektur harus diisi',
            'email.required'=>'Email harus diisi',
            'email.unique'=>'sudah terdaftar',
            'email.email'=>'format email tidak valid',
            'province_code.required' => 'Provinsi belum dipilih',
            'city_code.required' => 'Kabupaten/Kota belum dipilih',
            'district_code.required' => 'Kecamatan belum dipilih',
            
        ];        
       
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            if (isset($request->id)) {
                return redirect()->route($request->url_edit, ['id'=>$request->id, 'url_edit'=> $request->url_edit, 'url_list'=>$request->url_list])->withInput()->withErrors($validator->errors());    
            }
            return redirect()->route($request->url_tambah, ['url_tambah'=> $request->url_tambah, 'url_list'=>$request->url_list])->withInput()->withErrors($validator->errors());        
        }

        // return $input;
        $createPengawas = Pengawas::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'no_register'=>$request->no_register,
                'nama_perusahaan'=>$request->nama_perusahaan,
                'email'=>$request->email,
                'nama_direktur'=>$request->nama_direktur,
                'province_code'=>$request->province_code,
                'city_code'=>$request->city_code,
                'district_code'=>$request->district_code,
                'alamat'=>$request->alamat,
                'no_telpon'=>$request->no_telpon,
            ]
        );
        return redirect()->route($request->url_list, ['is_ajax'=>$request->is_ajax])->with('success','Data berhasil disimpan.'); 
        // return $input;

    }    

    public function delete(Request $request) {

        // $input = $request->all();
        // return $input;

        $pengawas = Pengawas::find($request->id);

        if ($pengawas->delete()) {
            return redirect()->route($request->url_list, ['is_ajax' => $request->is_ajax])->with('success','Data berhasil dihapus.'); 
        }else{
            return redirect()->route($request->url_list, ['is_ajax' => $request->is_ajax])->with('fail','Data gagal dihapus.');
        }

    }

    public function getPengawas(Request $request) {

        $data = Pengawas::pluck('nama_perusahaan', 'id');
        return response()->json($data);
    
    }

    public function getPenanggungJawabPengawas(Request $request) {

        $data = Pengawas::find($request->id);
        if (!empty($data)) {
            return response()->json($data->nama_direktur);
        }    
    }    

}
