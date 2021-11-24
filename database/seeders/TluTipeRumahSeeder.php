<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TluTipeRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $typeRumah = [
            [
                'tipe_rumah' => "Tipe Rumah 21",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'tipe_rumah' => "Tipe Rumah 22",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],			
			[
                'tipe_rumah' => "Tipe Rumah 23",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'tipe_rumah' => "Tipe Rumah 24",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],			
            [
                'tipe_rumah' => "Tipe Rumah 25",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],			
            [
                'tipe_rumah' => "Tipe Rumah 26",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'tipe_rumah' => "Tipe Rumah 27",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],			
            [
                'tipe_rumah' => "Tipe Rumah 28",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],			
            [
                'tipe_rumah' => "Tipe Rumah 29",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'tipe_rumah' => "Tipe Rumah 30",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],			
            [
                'tipe_rumah' => "Tipe Rumah 31",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],	
            [
                'tipe_rumah' => "Tipe Rumah 32",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],				
            [
                'tipe_rumah' => "Tipe Rumah 33",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],				
            [
                'tipe_rumah' => "Tipe Rumah 34",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],				
            [
                'tipe_rumah' => "Tipe Rumah 35",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],	
            [
                'tipe_rumah' => "Tipe Rumah 36",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],								
        ]; 
        \DB::table('tlu_tipe_rumahs')->insert($typeRumah);        

    }
}
