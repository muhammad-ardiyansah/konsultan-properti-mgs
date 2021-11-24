<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Developer;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    public function loginDpdView() {
        $listDPDUsers = User::where('role', 'DPD')->orderBy('id')->get();
        // print_r ($listDPDUsers);die;
        return view('users.dpd.login-dpd',compact('listDPDUsers'));

    }

    public function formRegistrasiDeveloper() {

        $provinces = Province::pluck('name', 'code');
        return view('developer.registrasi-developer', [
            'provinces' => $provinces,
        ]);
    
    }

    public function saveRegistrasiDeveloper(Request $request) {
        // print_r($request->all());die;
        // $this->validate($request,[
        //     'nama_perusahaan'=>'required',
        //     'nama_direktur'=>'required',
        //     'no_kta_apersi'=> 'required',
        //     'province_code'=>'required'

        // ]);

        $request->validate(
            [
                'nama_perusahaan' => 'required',
                'nama_direktur'=>'required',
                'no_kta_apersi'=> 'required',
                'province_code'=>'required',      
                'alamat'=>'required',        
                'no_hp'=>'required|integer',
                'email' => 'required|email|unique:users',
                // 'username'=>'required|unique:users|min:6|alpha_dash',
                'username'=>'required|unique:users|min:6|regex:/^[0-9A-Za-z.\-_]+$/u',
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
                
            ], 
            [
                'nama_perusahaan.required' => 'Nama perusahaan harus diisi',
                'nama_direktur.required' => 'Nama Direktur harus diisi',
                'no_kta_apersi.required' => 'No. KTA Apersi harus diisi',
                'province_code.required' => 'Asal DPD Apersi belum dipilih',
                'alamat.required'=>'Alamat harus diisi',
                'no_hp.required'=>'No. HP harus diisi',
                'no_hp.integer'=>'tidak valid',
                'email.required'=>'Email harus diisi',
                'email.unique'=>'sudah terdaftar',
                'username.required'=>'Username harus diisi',
                'username.unique'=>'sudah terdaftar',
                'username.min'=>'tidak valid. Username minimal 6 karakter',
                'username.regex'=>'tidak valid. Username hanya berisi huruf, angka, titik, - ,dan _',
                'password.required'=>'Password harus diisi',
                'password.min'=>'Password minimal 8 karakter',
                'password_confirmation.required'=>'Konfirmasi Password harus diisi',
                'password_confirmation.same'=>'Password dan Konfirmasi Password harus sama',
            ]
        );        

        // print_r($request->all());
        // die;        

        DB::beginTransaction();

        try {       
           
            $newUser = User::create([
                'name' => $request->nama_perusahaan,
                'username' => $request->username,
                'email' => $request->email,
                'role' => 'DEVELOPER',
                'password' => Hash::make($request->password),
            ]);
      
            $newDeveloper = Developer::create([
                'nama_perusahaan' => $request->nama_perusahaan,
                'nama_direktur' => $request->nama_direktur,
                'no_kta_apersi' => $request->no_kta_apersi,
                'province_code' => $request->province_code,
                'alamat' => $request->alamat,
                'no_hp' => '+62'.$request->no_hp,
            ]); 

            $newUser->developers()->attach($newDeveloper->id);

            // Commit Transaction
            DB::commit();
            // Semua proses benar
            return redirect()->back()->with('success','Registrasi anda berhasil.');   
        } catch (Exception $e) {       
            // Rollback Transaction
            DB::rollback();
            return redirect()->back()->with('fail',$e->getErrors());
            // throw $e;
            // ada yang error   
        }        

        // $newUser = User::create([
        //     'name' => $request->nama_perusahaan,
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'role' => 'DEVELOPER',
        //     'password' => Hash::make($request->password),
        // ]);
  
        // $newDeveloper = Developer::create([
        //     'nama_perusahaan' => $request->nama_perusahaan,
        //     'nama_direktur' => $request->nama_direktur,
        //     'no_kta_apersi' => $request->no_kta_apersi,
        //     'province_code' => $request->province_code,
        //     'alama' => $request->alamat,
        //     'no_hp' => '+62'.$request->no_hp,
        //     'user_id' => $newUser->id,
        // ]);

    }

}
