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
                'name' => 'Bishal Khatri',
                'email' => "bishal.khatri343@gmail.com",
                'phone_number' => 9842700000,
                'password' => Hash::make('password'),
                'role' => 'super-admin'
            ],
            [
                'name' => 'Restaurant User',
                'email' => "restaurant@gmail.com",
                'phone_number' => 9842700001,
                'password' => Hash::make('password'),
                'role' => 'restaurant'
            ],
            [
                'name' => 'Grocery User',
                'email' => "grocery@gmail.com",
                'phone_number' => 9842700002,
                'password' => Hash::make('password'),
                'role' => 'grocery'
            ],
            [
                'name' => 'Administrator User',
                'email' => "administrator@gmail.com",
                'phone_number' => 9842700003,
                'password' => Hash::make('password'),
                'role' => 'administrator'
            ]
        ];

        foreach($users as $value){
            $user = User::create([
                "name" => $value['name'],
                "email" => $value['email'],
                "phone_number" => $value['phone_number'],
                "password" => $value['password'],
            ]);

            $user->assignRole($value['role']);
        }


        SmsTemplate::create([
            'key' => 'otp',
            'template' => "Your D-ONE login OTP is @{otp}",
        ]);
    }
}
