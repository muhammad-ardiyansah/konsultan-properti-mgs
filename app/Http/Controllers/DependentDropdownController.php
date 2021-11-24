<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;

class DependentDropdownController extends Controller
{
    public function index()
    {
        $provinces = Province::pluck('name', 'code');

        return view('dependent-dropdown.index', [
            'provinces' => $provinces,
        ]);
    }

    public function store(Request $request)
    {
        $cities = City::where('province_code', $request->get('code'))
            ->pluck('name', 'code');

        // $cities = City::where('province_code', $request->get('code'))->get();
        // print_r($cities);        

        return response()->json($cities);
        // return "test";
    }    

}
