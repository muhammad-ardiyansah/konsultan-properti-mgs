<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tlu_list_checkbox;

class TluListCheckboxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tlu_list_checkbox::create([
            'list_checkbox' => 'Tidak Rusak, Rusak Ringan, Rusak Sedang, Rusak Berat',
        ]);

        Tlu_list_checkbox::create([
            'list_checkbox' => 'Tidak Ada, Ada',
        ]);

        Tlu_list_checkbox::create([
            'list_checkbox' => 'Tidak Mengganggu, Mengganggu',
        ]);
        
        Tlu_list_checkbox::create([
            'list_checkbox' => 'Tidak Ada, Kecil, Sedang, Besar',
        ]);        

        Tlu_list_checkbox::create([
            'list_checkbox' => 'Kurang, Sedang, Baik, Sangat Baik',
        ]);        

    }
}
