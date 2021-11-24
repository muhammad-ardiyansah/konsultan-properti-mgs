<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tlu_satuan_input_pengukuran;

class TluSatuanInputPengukuransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Tlu_satuan_input_pengukuran::create([
            'id' => 1,
            'nama_satuan' => 'centimeter',
            'lambang' => 'cm'
        ]);        

        Tlu_satuan_input_pengukuran::create([
            'id' => 2,
            'nama_satuan' => 'meter',
            'lambang' => 'm'
        ]);

        Tlu_satuan_input_pengukuran::create([
            'id' => 3,
            'nama_satuan' => 'meter persegi',
            'lambang' => 'm2'
        ]);        

        Tlu_satuan_input_pengukuran::create([
            'id' => 4,
            'nama_satuan' => 'meter kubik',
            'lambang' => 'm3'
        ]);

        Tlu_satuan_input_pengukuran::create([
            'id' => 5,
            'nama_satuan' => 'lantai',
            'lambang' => 'lantai'
        ]);
        Tlu_satuan_input_pengukuran::create([
            'id' => 6,
            'nama_satuan' => 'orang',
            'lambang' => 'orang'
        ]);

        Tlu_satuan_input_pengukuran::create([
            'id' => 7,
            'nama_satuan' => 'rabat',
            'lambang' => 'rabat'
        ]);

        Tlu_satuan_input_pengukuran::create([
            'id' => 8,
            'nama_satuan' => 'celcius',
            'lambang' => 'c'
        ]);        

        Tlu_satuan_input_pengukuran::create([
            'id' => 9,
            'nama_satuan' => 'persen',
            'lambang' => '%'
        ]);

        Tlu_satuan_input_pengukuran::create([
            'id' => 10,
            'nama_satuan' => 'tahun',
            'lambang' => 'tahun'
        ]);        

    }
}
