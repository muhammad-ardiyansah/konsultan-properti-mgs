<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dpd;

class DpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dpds = [   
            [
                'nama' => 'DPD Apersi Banten',
                'province_code' => '36',
            ],            
        ];

        Dpd::insert($dpds);
        //default DPD Apersi BANTEN
        $dpd1 = Dpd::find(1);
        $dpd1->users()->attach(6);   

    }
}
