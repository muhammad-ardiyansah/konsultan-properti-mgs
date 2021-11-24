<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Developer;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Developer::create([
            'nama_perusahaan' => ucfirst('developer 1'),
            'nama_direktur' => ucfirst('direktur developer 1'),
            'no_kta_apersi' => '123',
            'province_code' => '32',
            'alamat' => ucfirst('bogor jawa barat'),
            'no_hp' => '12345678910'
        ]);

        $developer = Developer::find(1);
        $developer->users()->attach(2);

    }
}
