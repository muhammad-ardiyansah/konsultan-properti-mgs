<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tlu_list;

class TluListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Tlu_list::create([
            'list' => 'Tidak Rusak, Rusak Ringan, Rusak Sedang, Rusak Berat',
            'param'=> 'template_pemeriksaan_kelaikan'
        ]);

        Tlu_list::create([
            'list' => 'Tidak Ada, Ada',
            'param'=> 'template_pemeriksaan_kelaikan'
        ]);

        Tlu_list::create([
            'list' => 'Tidak Mengganggu, Mengganggu',
            'param'=> 'template_pemeriksaan_kelaikan'
        ]);

        Tlu_list::create([
            'list' => 'Kamar, Ruang Tamu, & Kamar Mandi | Kamar, Ruang Tamu, Ruang Keluarga, & Kamar Mandi',
            'param'=> 'template_struktural_fondasi_bagian_bangunan'
        ]);        

        Tlu_list::create([
            'list' => 'Balok Beton, Balok Batu, Batu Bata, Batako, Lain-lain',
            'param'=> 'template_struktural_fondasi_bahan_bangunan'
        ]);

        Tlu_list::create([
            'list' => 'Basement, Crawl Space, Slab',
            'param'=> 'template_struktural_fondasi_tipe'
        ]);

        Tlu_list::create([
            'list' => 'Tidak Ada, Kecil, Sedang, Besar',
            'param'=> 'template_struktural_fondasi_tk_kerusakan'
        ]);        

        Tlu_list::create([
            'list' => 'Kurang, Sedang, Baik, Sangat Baik',
            'param'=> 'template_struktural_fondasi_kondisi_menyeluruh'
        ]);

        Tlu_list::create([
            'list' => 'Kondisi bangunan secara keseluruhan layak huni | Kondisi bangunan secara keseluruhan tidak layak huni',
            'param'=> 'template_struktural_fondasi_kesimpulan'
        ]);        

    }
}
