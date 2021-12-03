<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dpp;

class DppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dpps = [
            [
                'nama' => 'DPP Apersi Pusat',
            ],
        ];    

        Dpp::insert($dpps);        

        $dpp = Dpp::find(1);
        $dpp->users()->attach(3);

    }
}
