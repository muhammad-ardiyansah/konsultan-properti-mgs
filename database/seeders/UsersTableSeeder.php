<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => strtoupper('administrator'),
            'username' => 'admin',
            'email' => 'admin@somewhere.com',
            'role' => 'ADMIN',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => strtoupper('developer 1'),
            'username' => 'developer1',
            'email' => 'developer1@somewhere.com',
            'role' => 'DEVELOPER',
            'password' => Hash::make('password'),
        ]);          
        User::create([
            'name' => strtoupper('dpp 1'),
            'username' => 'dpp1',
            'email' => 'dpp1@somewhere.com',
            'role' => 'DPP',
            'password' => Hash::make('password'),
        ]);      
        User::create([
            'name' => strtoupper('konsultan 1'),
            'username' => 'konsultan1',
            'email' => 'konsultan1@somewhere.com',
            'role' => 'KONSULTAN',
            'password' => Hash::make('password'),
        ]); 
        User::create([
            'name' => strtoupper('pengawas 1'),
            'username' => 'pengawas1',
            'email' => 'pengawas1@somewhere.com',
            'role' => 'PENGAWAS',
            'password' => Hash::make('password'),
        ]);


        //User DPD
        User::create([
            'name' => 'DPD Apersi Aceh',
            'username' => 'aceh',
            'email' => 'aceh@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Sumatera Utara',
            'username' => 'sumatera_utara',
            'email' => 'sumatera_utara@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Sumatera Barat',
            'username' => 'sumatera_barat',
            'email' => 'sumatera_barat@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Riau',
            'username' => 'riau',
            'email' => 'riau@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Jambi',
            'username' => 'jambi',
            'email' => 'jambi@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);        

        User::create([
            'name' => 'DPD Apersi Sumatera Selatan',
            'username' => 'sumatera_selatan',
            'email' => 'sumatera_selatan@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);        

        User::create([
            'name' => 'DPD Apersi Bengkulu',
            'username' => 'bengkulu',
            'email' => 'bengkulu@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Lampung',
            'username' => 'lampung',
            'email' => 'lampung@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Kep. bangka belitung',
            'username' => 'kepulauan_bangka_belitung',
            'email' => 'kepulauan_bangka_belitung@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);        

        User::create([
            'name' => 'DPD Apersi Kep. Riau',
            'username' => 'kepulauan_riau',
            'email' => 'kepulauan_riau@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi DKI Jakarta',
            'username' => 'dki_jakarta',
            'email' => 'dki_jakarta@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Jawa Barat',
            'username' => 'jawa_barat',
            'email' => 'jawa_barat@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Jawa Tengah',
            'username' => 'jawa_tengah',
            'email' => 'jawa_tengah@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);
        
        User::create([
            'name' => 'DPD Apersi DI Yogyakarta',
            'username' => 'di_yogyakarta',
            'email' => 'di_yogyakarta@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Jawa Timur',
            'username' => 'jawa_timur',
            'email' => 'jawa_timur@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);        

        User::create([
            'name' => 'DPD Apersi Banten',
            'username' => 'banten',
            'email' => 'banten@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);
        
        User::create([
            'name' => 'DPD Apersi Bali',
            'username' => 'bali',
            'email' => 'bali@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);        

        User::create([
            'name' => 'DPD Apersi NTB',
            'username' => 'nusa_tenggara_barat',
            'email' => 'nusa_tenggara_barat@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi NTT',
            'username' => 'nusa_tenggara_timur',
            'email' => 'nusa_tenggara_timur@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);
        
        User::create([
            'name' => 'DPD Apersi Kalimantan Barat',
            'username' => 'kalimantan_barat',
            'email' => 'kalimantan_barat@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);        

        User::create([
            'name' => 'DPD Apersi Kalimantan Tengah',
            'username' => 'kalimantan_tengah',
            'email' => 'kalimantan_tengah@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);
        
        User::create([
            'name' => 'DPD Apersi Kalimantan Selatan',
            'username' => 'kalimantan_selatan',
            'email' => 'kalimantan_selatan@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);        

        User::create([
            'name' => 'DPD Apersi Kalimantan Timur',
            'username' => 'kalimantan_timur',
            'email' => 'kalimantan_timur@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Kalimantan Utara',
            'username' => 'kalimantan_utara',
            'email' => 'kalimantan_utara@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Sulawesi Utara',
            'username' => 'sulawesi_utara',
            'email' => 'sulawesi_utara@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Sulawesi Tengah',
            'username' => 'sulawesi_tengah',
            'email' => 'sulawesi_tengah@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Sulawesi Selatan',
            'username' => 'sulawesi_selatan',
            'email' => 'sulawesi_selatan@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Sulawesi Tenggara',
            'username' => 'sulawesi_tenggara',
            'email' => 'sulawesi_tenggara@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);
        
        User::create([
            'name' => 'DPD Apersi Gorontalo',
            'username' => 'gorontalo',
            'email' => 'gorontalo@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);        

        User::create([
            'name' => 'DPD Apersi Sulawesi Barat',
            'username' => 'sulawesi_barat',
            'email' => 'sulawesi_barat@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Maluku',
            'username' => 'maluku',
            'email' => 'maluku@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Maluku Utara',
            'username' => 'maluku_utara',
            'email' => 'maluku_utara@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Papua Barat',
            'username' => 'papua_barat',
            'email' => 'papua_barat@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'DPD Apersi Papua',
            'username' => 'papua',
            'email' => 'papua@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);        

    }
}
