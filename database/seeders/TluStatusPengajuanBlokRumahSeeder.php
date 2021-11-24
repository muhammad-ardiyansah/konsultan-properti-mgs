<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tlu_status_pengajuan_blok_rumah;

class TluStatusPengajuanBlokRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tlu_status_pengajuan_blok_rumah::create([
            'id' => 21,
            'nama_status' => 'Ditolak',
            'param' => 'dpd'
        ]);
        
        Tlu_status_pengajuan_blok_rumah::create([
            'id' => 31,
            'nama_status' => 'Disetujui',
            'param' => 'dpd'
        ]);        

        Tlu_status_pengajuan_blok_rumah::create([
            'id' => 41,
            'nama_status' => 'Ditolak',
            'param' => 'dpp'
        ]);

        Tlu_status_pengajuan_blok_rumah::create([
            'id' => 51,
            'nama_status' => 'Disetujui',
            'param' => 'dpp'
        ]);
        Tlu_status_pengajuan_blok_rumah::create([
            'id' => 71,
            'nama_status' => 'Ditolak',
            'param' => 'konsultan'
        ]);

        Tlu_status_pengajuan_blok_rumah::create([
            'id' => 81,
            'nama_status' => 'Disetujui',
            'param' => 'konsultan'
        ]);        
    }
}
