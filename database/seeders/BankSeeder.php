<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Bank 1',
                'username' => 'bank_1',
                'email' => 'bank1@somewhere.com',
                'role' => 'BANK',
                'password' => Hash::make('password'),
            ]
        ];
        User::insert($users);

        $banks = [
            [
                'nama' => 'Bank 1',
            ],
        ];    

        Bank::insert($banks);        

        $bank = Bank::find(1);
        $bank->users()->attach(40);                

    }
}
