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
            'name' => 'DPD Apersi Banten',
            'username' => 'banten',
            'email' => 'banten@somewhere.com',
            'role' => 'DPD',
            'password' => Hash::make('password'),
        ]);

    }
}
