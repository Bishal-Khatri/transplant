<?php

namespace Database\Seeders;

use App\Models\SmsTemplate;
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
        $users = [
            [
                'name' => 'iions technology',
                'email' => "admin@iionstech.com",
                'phone_number' => 9842721343,
                'password' => Hash::make('super@iionstech#343'),
                'user_type' => 'administrator',
                'role' => 'super-admin'
            ],
//            [
//                'name' => 'Restaurant User',
//                'email' => "restaurant@gmail.com",
//                'phone_number' => 9842700001,
//                'password' => Hash::make('password'),
//                'user_type' => 'administrator',
//                'role' => 'restaurant'
//            ],
//            [
//                'name' => 'Administrator User',
//                'email' => "administrator@gmail.com",
//                'phone_number' => 9842700003,
//                'password' => Hash::make('password'),
//                'user_type' => 'administrator',
//                'role' => 'administrator'
//            ]
        ];

        foreach($users as $value){
            $user = User::create([
                "name" => $value['name'],
                "email" => $value['email'],
                "phone_number" => $value['phone_number'],
                "password" => $value['password'],
                "user_type" => $value['user_type'],
            ]);

            $user->assignRole($value['role']);
        }


//        SmsTemplate::create([
//            'key' => 'otp',
//            'template' => "Your D-ONE login OTP is @{otp}",
//        ]);
    }
}
