<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DpdController extends Controller
{
    //
    function index(){
        // return view('dashboards.admins.index');
        return view('dpd.dashboard-dpd');
    }    
}
