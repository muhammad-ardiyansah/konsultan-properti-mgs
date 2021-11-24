<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonsultanController extends Controller
{
    //
    function index(){
        // return view('dashboards.admins.index');
        return view('konsultan.dashboard-konsultan');
    }

    public function login(Request $request){
        print_r( $request->only('username','password'));
        die;
    }    

}
