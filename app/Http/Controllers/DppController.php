<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DppController extends Controller
{
    //
    function index(){
        // return view('dashboards.admins.index');
        return view('dpp.dashboard-dpp');
    }    
}
