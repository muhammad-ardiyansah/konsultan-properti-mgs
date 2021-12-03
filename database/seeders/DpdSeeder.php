<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dpd;

class DpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dpds = [
            [
                'nama' => 'DPD Apersi Aceh',
                'province_code' => '11',
            ],
            [
                'nama' => 'DPD Apersi Sumatera Utara',
                'province_code' => '12',
            ],
            [
                'nama' => 'DPD Apersi Sumatera Barat',
                'province_code' => '13',
            ],                        
            [
                'nama' => 'DPD Apersi Riau',
                'province_code' => '14',
            ], 
            [
                'nama' => 'DPD Apersi Jambi',
                'province_code' => '15',
            ],                        
            [
                'nama' => 'DPD Apersi Sumatera Selatan',
                'province_code' => '16',
            ], 
            [
                'nama' => 'DPD Apersi Bengkulu',
                'province_code' => '17',
            ], 
            [
                'nama' => 'DPD Apersi Lampung',
                'province_code' => '18',
            ], 
            [
                'nama' => 'DPD Apersi Kep. bangka belitung',
                'province_code' => '19',
            ], 
            [
                'nama' => 'DPD Apersi Kep. Riau',
                'province_code' => '21',
            ],            
            [
                'nama' => 'DPD Apersi DKI Jakarta',
                'province_code' => '31',
            ],
            [
                'nama' => 'DPD Apersi Jawa Barat',
                'province_code' => '32',
            ],                        
            [
                'nama' => 'DPD Apersi Jawa Tengah',
                'province_code' => '33',
            ],
            [
                'nama' => 'DPD Apersi DI Yogyakarta',
                'province_code' => '34',
            ], 
            [
                'nama' => 'DPD Apersi Jawa Timur',
                'province_code' => '35',
            ],            
            [
                'nama' => 'DPD Apersi Banten',
                'province_code' => '36',
            ],            
            [
                'nama' => 'DPD Apersi Bali',
                'province_code' => '51',
            ],
            [
                'nama' => 'DPD Apersi NTB',
                'province_code' => '52',
            ],
            [
                'nama' => 'DPD Apersi NTT',
                'province_code' => '53',
            ], 
            [
                'nama' => 'DPD Apersi Kalimantan Barat',
                'province_code' => '61',
            ], 
            [
                'nama' => 'DPD Apersi Kalimantan Tengah',
                'province_code' => '62',
            ], 
            [
                'nama' => 'DPD Apersi Kalimantan Selatan',
                'province_code' => '63',
            ], 
            [
                'nama' => 'DPD Apersi Kalimantan Timur',
                'province_code' => '64',
            ], 
            [
                'nama' => 'DPD Apersi Kalimantan Utara',
                'province_code' => '65',
            ],
            [
                'nama' => 'DPD Apersi Sulawesi Utara',
                'province_code' => '71',
            ], 
            [
                'nama' => 'DPD Apersi Sulawesi Tengah',
                'province_code' => '72',
            ],
            [
                'nama' => 'DPD Apersi Sulawesi Selatan',
                'province_code' => '73',
            ], 
            [
                'nama' => 'DPD Apersi Sulawesi Tenggara',
                'province_code' => '74',
            ],
            [
                'nama' => 'DPD Apersi Gorontalo',
                'province_code' => '75',
            ],
            [
                'nama' => 'DPD Apersi Sulawesi Barat',
                'province_code' => '76',
            ],
            [
                'nama' => 'DPD Apersi Maluku',
                'province_code' => '81',
            ],
            [
                'nama' => 'DPD Apersi Maluku Utara',
                'province_code' => '82',
            ],
            [
                'nama' => 'DPD Apersi Papua',
                'province_code' => '91',
            ],
            [
                'nama' => 'DPD Apersi Papua Barat',
                'province_code' => '92',
            ],                                                                                                                                                                                         
        ];

        Dpd::insert($dpds);

        $dpd1 = Dpd::find(1);
        $dpd1->users()->attach(6);
        
        $dpd2 = Dpd::find(2);
        $dpd2->users()->attach(7);
        
        $dpd3 = Dpd::find(3);
        $dpd3->users()->attach(8);
        
        $dpd4 = Dpd::find(4);
        $dpd4->users()->attach(9);      
        
        $dpd5 = Dpd::find(5);
        $dpd5->users()->attach(10);
        
        $dpd6 = Dpd::find(6);
        $dpd6->users()->attach(11);
        
        $dpd7 = Dpd::find(7);
        $dpd7->users()->attach(12);
        
        $dpd8 = Dpd::find(8);
        $dpd8->users()->attach(13);   
        
        $dpd9 = Dpd::find(9);
        $dpd9->users()->attach(14);
        
        $dpd10 = Dpd::find(10);
        $dpd10->users()->attach(15);
        
        $dpd11 = Dpd::find(11);
        $dpd11->users()->attach(16);        

        $dpd12 = Dpd::find(12);
        $dpd12->users()->attach(17);
        
        $dpd13 = Dpd::find(13);
        $dpd13->users()->attach(18);     
        
        $dpd14 = Dpd::find(14);
        $dpd14->users()->attach(19);
        
        $dpd15 = Dpd::find(15);
        $dpd15->users()->attach(20);
        
        $dpd16 = Dpd::find(16);
        $dpd16->users()->attach(21);      
        
        $dpd17 = Dpd::find(17);
        $dpd17->users()->attach(22);
        
        $dpd18 = Dpd::find(18);
        $dpd18->users()->attach(23);
        
        $dpd19 = Dpd::find(19);
        $dpd19->users()->attach(24);
        
        $dpd20 = Dpd::find(20);
        $dpd20->users()->attach(25);
        
        $dpd21 = Dpd::find(21);
        $dpd21->users()->attach(26);
        
        $dpd22 = Dpd::find(22);
        $dpd22->users()->attach(27);     
        
        $dpd23 = Dpd::find(23);
        $dpd23->users()->attach(28);   
        
        $dpd24 = Dpd::find(24);
        $dpd24->users()->attach(29);
        
        $dpd25 = Dpd::find(25);
        $dpd25->users()->attach(30);
        
        $dpd26 = Dpd::find(26);
        $dpd26->users()->attach(31);      
        
        $dpd27 = Dpd::find(27);
        $dpd27->users()->attach(32);
        
        $dpd28 = Dpd::find(28);
        $dpd28->users()->attach(33);    
        
        $dpd29 = Dpd::find(29);
        $dpd29->users()->attach(34);     
        
        $dpd30 = Dpd::find(30);
        $dpd30->users()->attach(35);
        
        $dpd31 = Dpd::find(31);
        $dpd31->users()->attach(36);   
        
        $dpd32 = Dpd::find(32);
        $dpd32->users()->attach(37);       
        
        $dpd33 = Dpd::find(33);
        $dpd33->users()->attach(39);        

        $dpd34 = Dpd::find(34);
        $dpd34->users()->attach(38);        

    }
}
