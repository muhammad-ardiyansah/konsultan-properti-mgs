<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengawasController extends Controller
{
    //
    function index(){
        // return view('dashboards.admins.index');
        return view('pengawas.dashboard-pengawas');
    }
}
