<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tlu_jenis_input_pengukuran;

class TluJenisPengukuransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tlu_jenis_input_pengukuran::create([
            'id' => 0,
            'jenis_input' => 'Tidak ada input',
        ]);

        Tlu_jenis_input_pengukuran::create([
            'id' => 1,
            'jenis_input' => 'Input angka',
        ]);

        Tlu_jenis_input_pengukuran::create([
            'id' => 2,
            'jenis_input' => 'Input text',
        ]);

        Tlu_jenis_input_pengukuran::create([
            'id' => 3,
            'jenis_input' => 'Checkbox',
        ]);        

        Tlu_jenis_input_pengukuran::create([
            'id' => 4,
            'jenis_input' => 'Selectbox',
        ]);

    }
}
