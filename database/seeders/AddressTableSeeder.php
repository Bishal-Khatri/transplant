<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Street;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            [
                'name' => 'Ilam',
            ],
            [
                'name' => 'Jhapa',
            ],
        ];

        foreach($districts as $value){
            District::create([
                "name" => $value['name']
            ]);
        }

        Street::create([
            'name' => 'Khareldhada',
            'district_id' => 1,
        ]);
        Street::create([
            'name' => 'Budhabare',
            'district_id' => 2,
        ]);

        UserAddress::create([
            'user_id' => 1,
            'district_id' => 1,
            'street_id' => 1,
            'local_address' => 'Opposite of something',

        ]);
    }
}
