<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Application\Entities\Banner;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'key' => 'home',
                'image' => '/banners/grocery1.jpg',
            ],
            [
                'key' => 'home',
                'image' => '/banners/food1.png',
            ],
            [
                'key' => 'home',
                'image' => '/banners/grocery2.jpg',
            ],
            [
                'key' => 'home',
                'image' => '/banners/food2.png',
            ],

            // grocery
            [
                'key' => 'grocery',
                'image' => '/banners/grocery1.jpg',
            ],
            [
                'key' => 'grocery',
                'image' => '/banners/grocery2.jpg',
            ],
            [
                'key' => 'grocery',
                'image' => '/banners/grocery3.jpg',
            ],
            [
                'key' => 'grocery',
                'image' => '/banners/grocery4.jpg',
            ],
            [
                'key' => 'grocery',
                'image' => '/banners/grocery5.jpg',
            ],

            // restaurant
            [
                'key' => 'restaurant',
                'image' => '/banners/food1.png',
            ],
            [
                'key' => 'restaurant',
                'image' => '/banners/food2.png',
            ],
            [
                'key' => 'restaurant',
                'image' => '/banners/food3.png',
            ],
            [
                'key' => 'restaurant',
                'image' => '/banners/food4.png',
            ],
            [
                'key' => 'restaurant',
                'image' => '/banners/food5.png',
            ],
        ];

        foreach($data as $value){
            Banner::create([
                "key" => $value['key'],
                "image" => $value['image'],
            ]);

        }

    }
}
