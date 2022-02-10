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
        User::create([
            'name' => 'Bishal Khatri',
            'email' => "bishal.khatri343@gmail.com",
            'phone_number' => 9842721343,
            'password' => Hash::make('password')
        ]);

        SmsTemplate::create([
            'key' => 'otp',
            'template' => "Your D-ONE login OTP is @{otp}",
        ]);
    }
}
