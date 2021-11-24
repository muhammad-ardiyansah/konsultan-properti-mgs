<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tlu_fungsi_bangunan;

class TluFungsiBangunanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tlu_fungsi_bangunan::create([
            'fungsi_bangunan' => 'Rumah Hunian',
        ]);
    }
}
