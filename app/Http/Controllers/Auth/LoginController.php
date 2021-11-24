<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo(){
        if( Auth()->user()->role == "ADMIN"){
            return route('admin.dashboard');
        }
        elseif( Auth()->user()->role == "KONSULTAN"){
            return route('konsultan.dashboard');
        }
        elseif( Auth()->user()->role == "DPD"){
            return route('dpd.dashboard');
        }
        elseif( Auth()->user()->role == "DPP"){
            return route('dpp.dashboard');
        }
        elseif( Auth()->user()->role == "DEVELOPER"){
            return route('developer.listPengajuan');
        }
        elseif( Auth()->user()->role == "PENGAWAS"){
            return route('pengawas.dashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $input = $request->all();
        // print_r($input);die;
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);
 
        if( auth()->attempt(array('username'=>$input['username'], 'password'=>$input['password'])) ){
 
            if( auth()->user()->role == "ADMIN" ){
                return redirect()->route('admin.dashboard');
            }
            elseif( auth()->user()->role == "KONSULTAN" ){
                return redirect()->route('konsultan.dashboard');
            }
            elseif( auth()->user()->role == "DPD" ){
                return redirect()->route('dpd.dashboard');
            }
            elseif( auth()->user()->role == "DPP" ){
                return redirect()->route('dpp.dashboard');
            }            
            elseif( auth()->user()->role == "DEVELOPER" ){
                return redirect()->route('developer.listPengajuan');
            }
            elseif( auth()->user()->role == "PENGAWAS" ){
                return redirect()->route('pengawas.dashboard');
            }            

        }else{
            // return redirect()->redirect('user/login')->with('error','Username or password are wrong');
            if (isset($input['userrole'])) {
                return redirect()->route('user.login', ['userrole'=>$input['userrole']])->with('error','Username atau Password yang Anda masukkan tidak sesuai');
            }    
            return redirect()->route('user.login.dpd')->with('error','Password yang Anda masukkan tidak sesuai');
        }
     }

}
