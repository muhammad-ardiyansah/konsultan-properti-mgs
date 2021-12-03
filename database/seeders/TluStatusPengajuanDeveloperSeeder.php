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
            'pilihan_status'=> '{"konsultan_province_code_apersi_not_null":[{"id_status":"62","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"63","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"24","text":"Ajukan ke DPD","route":"route(\'konsultan.setStatusPengajuan\')"}],"konsultan":[{"id_status":"62","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"63","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"64","text":"Proses Pengajuan","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"12","text":"Edit Data","route":"route(\'developer.setStatusPengajuan\')"}}',
            'role' => 'DEVELOPER'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 12,
            'nama_status' => 'Edit Data',
            'keterangan' => 'Developer telah merubah data',
            'pilihan_status'=> '{"konsultan_province_code_apersi_not_null":[{"id_status":"62","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"63","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"24","text":"Ajukan ke DPD","route":"route(\'konsultan.setStatusPengajuan\')"}],"konsultan":[{"id_status":"62","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"63","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"64","text":"Proses Pengajuan","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"12","text":"Edit Data","route":"route(\'developer.editDataPengajuan\')"}}',
            'role' => 'DEVELOPER'
        ]);        
        
        Tlu_status_pengajuan_developer::create([
            'id' => 21,
            'nama_status' => 'Ditolak DPD',
            'keterangan' => 'Pengajuan ditolak DPD',
            'pilihan_status'=>'{"konsultan_province_code_apersi_not_null":[{"id_status":"62","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"63","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"24","text":"Ajukan ke DPD","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"12","text":"Edit Data","route":"route(\'developer.editDataPengajuan\')"},"dpd":{"id_status":"31","text":"Setujui","route":"route(\'dpd.setStatusPengajuan\')"}}',
            'role' => 'DPD'
        ]);
        
        Tlu_status_pengajuan_developer::create([
            'id' => 22,
            'nama_status' => 'Edit Data',
            'keterangan' => 'Data dirubah',
            'pilihan_status'=>'{"konsultan_province_code_apersi_not_null":[{"id_status":"22","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"23","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"44","text":"Ajukan ke DPP","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"22","text":"Edit Data","route":"route(\'developer.editDataPengajuan\')"}}',
            'role' => 'DPD'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 23,
            'nama_status' => 'Hold/Pending',
            'keterangan' => 'Pengajuan ditunda/hold',
            'pilihan_status' => '{"konsultan_province_code_apersi_not_null":[{"id_status":"22","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"44","text":"Ajukan ke DPP","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"22","text":"Edit Data","route":"route(\'developer.editDataPengajuan\')"}}',
            'role' => 'DPD'
        ]);        

        Tlu_status_pengajuan_developer::create([
            'id' => 24,
            'nama_status' => 'Menunggu persetujuan DPD',
            'pilihan_status' => '{"dpd":[{"id_status":"21","text":"Tolak","route":"route(\'dpd.setStatusPengajuan\')"},{"id_status":"31","text":"Setujui","route":"route(\'dpd.setStatusPengajuan\')"}]}',
            'keterangan' => 'Pengajuan diteruskan ke DPD',
            'role' => 'DPD'
        ]);        

        Tlu_status_pengajuan_developer::create([
            'id' => 31,
            'nama_status' => 'Disetujui DPD',
            'keterangan' => 'Pengajuan Disetujui DPD',
            'pilihan_status' => '{"konsultan_province_code_apersi_not_null":[{"id_status":"22","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"23","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"44","text":"Ajukan ke DPP","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"22","text":"Edit Data","route":"route(\'developer.editDataPengajuan\')"},"dpd":{"id_status":"21","text":"Tolak","route":"route(\'dpd.setStatusPengajuan\')"}}',
            'role' => 'DPD'
        ]);        

        Tlu_status_pengajuan_developer::create([
            'id' => 41,
            'nama_status' => 'Ditolak DPP',
            'keterangan' => 'Pengajuan ditolak DPP',
            'pilihan_status'=>'{"konsultan_province_code_apersi_not_null":[{"id_status":"22","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"23","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"44","text":"Ajukan ke DPP","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"22","text":"Edit Data","route":"route(\'developer.editDataPengajuan\')"},"dpp":{"id_status":"51","text":"Setujui","route":"route(\'dpp.setStatusPengajuan\')"}}',
            'role' => 'DPP'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 42,
            'nama_status' => 'Edit Data',
            'keterangan' => 'Data dirubah',
            'pilihan_status'=>'{"konsultan_province_code_apersi_not_null":[{"id_status":"42","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"43","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"42","text":"Edit Data","route":"route(\'developer.editDataPengajuan\')"}}',
            'role' => 'DPP'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 43,
            'nama_status' => 'Hold/Pending',
            'keterangan' => 'Pengajuan ditunda/hold',
            'pilihan_status' => '{"konsultan_province_code_apersi_not_null":[{"id_status":"42","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"}],"developer":{"id_status":"42","text":"Edit Data","route":"route(\'developer.editDataPengajuan\')"}}',
            'role' => 'DPP'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 44,
            'nama_status' => 'Menunggu persetujuan DPP',
            'keterangan' => 'Pengajuan diteruskan ke DPP',
            'pilihan_status' => '{"dpp":[{"id_status":"41","text":"Tolak","route":"route(\'dpp.setStatusPengajuan\')"},{"id_status":"51","text":"Setujui","route":"route(\'dpp.setStatusPengajuan\')"}]}',
            'role' => 'DPP'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 51,
            'nama_status' => 'Disetujui DPP',
            'keterangan' => 'Pengajuan disetujui DPP',
            'pilihan_status'=>'{"konsultan_province_code_apersi_not_null":[{"id_status":"42","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"43","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"67","text":"Tolak","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"71","text":"Setujui","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"42","text":"Edit Data","route":"route(\'developer.editDataPengajuan\')"}}',
            'role' => 'DPP'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 61,
            'nama_status' => 'Pengajuan baru',
            'keterangan' => 'Input pengajuan oleh Konsultan',
            'pilihan_status' => '{"konsultan_province_code_apersi_not_null":[{"id_status":"62","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"63","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"24","text":"Ajukan ke DPD","route":"route(\'konsultan.setStatusPengajuan\')"}],"konsultan":[{"id_status":"62","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"63","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"64","text":"Proses Pengajuan","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"12","text":"Edit Data","route":"route(\'developer.setStatusPengajuan\')"}}',
            'role' => 'KONSULTAN'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 62,
            'nama_status' => 'Edit data',
            'keterangan' => 'Konsultan telah merubah data',
            'pilihan_status' => '{"konsultan_province_code_apersi_not_null":[{"id_status":"62","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"63","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"24","text":"Ajukan ke DPD","route":"route(\'konsultan.setStatusPengajuan\')"}],"konsultan":[{"id_status":"62","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"63","text":"Hold/Pending","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"64","text":"Proses Pengajuan","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"12","text":"Edit Data","route":"route(\'developer.setStatusPengajuan\')"}}',
            'role' => 'KONSULTAN'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 63,
            'nama_status' => 'Hold/Pending',
            'keterangan' => 'Pengajuan ditunda/hold',
            'pilihan_status' => '{"konsultan_province_code_apersi_not_null":[{"id_status":"62","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"24","text":"Ajukan ke DPD","route":"route(\'konsultan.setStatusPengajuan\')"}],"konsultan":[{"id_status":"62","text":"Edit Data","route":"route(\'konsultan.editDataPengajuan\')"},{"id_status":"64","text":"Proses Pengajuan","route":"route(\'konsultan.setStatusPengajuan\')"}],"developer":{"id_status":"12","text":"Edit Data","route":"route(\'developer.setStatusPengajuan\')"}}',
            'role' => 'KONSULTAN'
        ]);        

        Tlu_status_pengajuan_developer::create([
            'id' => 64,
            'nama_status' => 'Pengajuan diproses',
            'keterangan' => 'Konsultan memproses pengajuan',
            'pilihan_status' => '{"konsultan":[{"id_status":"67","text":"Tolak","route":"route(\'konsultan.setStatusPengajuan\')"},{"id_status":"71","text":"Setujui","route":"route(\'konsultan.setStatusPengajuan\')"}]}',
            'role' => 'KONSULTAN'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 67,
            'nama_status' => 'Ditolak Konsultan',
            'keterangan' => 'Pengajuan ditolak konsultan',
            'pilihan_status' => '{"konsultan_province_code_apersi_not_null":{"id_status":"71","text":"Setujui","route":"route(\'konsultan.setStatusPengajuan\')"},"konsultan":{"id_status":"71","text":"Setujui","route":"route(\'konsultan.setStatusPengajuan\')"}}',
            'role' => 'KONSULTAN'
        ]);

        Tlu_status_pengajuan_developer::create([
            'id' => 71,
            'nama_status' => 'Disetujui Konsultan',
            'keterangan' => 'Pengajuan disetujui konsultan',
            'role' => 'KONSULTAN'
        ]);


    }
}
