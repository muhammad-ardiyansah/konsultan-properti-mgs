<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tlu_status_pengajuan_developer;

class TluStatusPengajuanDeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tlu_status_pengajuan_developer::create([
            'id' => 11,
            'nama_status' => 'Pengajuan baru',
            'keterangan' => 'Input pengajuan oleh Developer',
            'pilihan_status'=> '{"konsultan_province_code_apersi_not_null":[{"id_status":"62","text":"Edit Data","route":""},{"id_status":"63","text":"Hold/Pending","route":""},{"id_status":"65","text":"Ajukan ke DPD","route":""}],"konsultan":[{"id_status":"62","text":"Edit Data","route":""},{"id_status":"63","text":"Hold/Pending","route":""},{"id_status":"64","text":"Proses Pengajuan","route":""}]}',
            'role' => 'DEVELOPER'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 12,
            'nama_status' => 'Edit Data',
            'keterangan' => 'Developer merubah data',
            'pilihan_status'=> '{"konsultan_ajukan_ke_apersi":{"id_status":"65","text":"Ajukan ke DPD","route":""},"konsultan":{"id_status":"64","text":"Proses Pengajuan","route":""},"developer":{"id_status":"12","text":"Edit Data","route":""}}',
            'role' => 'DEVELOPER'
        ]);        
        
        Tlu_status_pengajuan_developer::create([
            'id' => 21,
            'nama_status' => 'Ditolak DPD',
            'keterangan' => 'Pengajuan ditolak DPD',
            'pilihan_status'=>'{"konsultan_province_code_apersi_not_null":[{"id_status":"62","text":"Edit Data","route":""},{"id_status":"63","text":"Hold/Pending","route":""},{"id_status":"65","text":"Ajukan ke DPD","route":""}],"developer":{"id_status":"12","text":"Edit Data","route":""}}',
            'role' => 'DPD'
        ]);
        
        Tlu_status_pengajuan_developer::create([
            'id' => 31,
            'nama_status' => 'Disetujui DPD',
            'keterangan' => 'Pengajuan Disetujui DPD',
            'pilihan_status' => '{"konsultan_province_code_apersi_not_null":[{"id_status":"62","text":"Edit Data","route":""},{"id_status":"63","text":"Hold/Pending","route":""},{"id_status":"66","text":"Ajukan ke DPP","route":""}],"developer":{"id_status":"12","text":"Edit Data","route":""}}',
            'role' => 'DPD'
        ]);        

        Tlu_status_pengajuan_developer::create([
            'id' => 41,
            'nama_status' => 'Ditolak DPP',
            'keterangan' => 'Pengajuan ditolak DPP',
            'pilihan_status'=>'',
            'role' => 'DPP'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 51,
            'nama_status' => 'Disetujui DPP',
            'keterangan' => 'Pengajuan disetujui DPP',
            'pilihan_status'=>'',
            'role' => 'DPP'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 61,
            'nama_status' => 'Pengajuan baru',
            'keterangan' => 'Input pengajuan oleh Konsultan',
            'role' => 'KONSULTAN'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 62,
            'nama_status' => 'Edit data',
            'keterangan' => 'Konsultan merubah data',
            'role' => 'KONSULTAN'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 63,
            'nama_status' => 'Hold/Pending',
            'keterangan' => 'Konsultan menunda proses pengajuan',
            'role' => 'KONSULTAN'
        ]);        

        Tlu_status_pengajuan_developer::create([
            'id' => 64,
            'nama_status' => 'Pengajuan diproses',
            'keterangan' => 'Konsultan memproses pengajuan',
            'role' => 'KONSULTAN'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 65,
            'nama_status' => 'Menunggu persetujuan DPD',
            'keterangan' => 'Pengajuan diteruskan ke DPD',
            'role' => 'KONSULTAN'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 66,
            'nama_status' => 'Menunggu persetujuan DPP',
            'keterangan' => 'Pengajuan diteruskan ke DPP',
            'role' => 'KONSULTAN'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 71,
            'nama_status' => 'Ditolak Konsultan',
            'keterangan' => 'Pengajuan ditolak konsultan',
            'role' => 'KONSULTAN'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 81,
            'nama_status' => 'Disetujui Konsultan',
            'keterangan' => 'Pengajuan disetujui konsultan',
            'role' => 'KONSULTAN'
        ]);


    }
}
