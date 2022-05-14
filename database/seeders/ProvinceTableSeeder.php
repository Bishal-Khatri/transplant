<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Administrator\Entities\Province;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::truncate();

        Province::create( [
            'id'=>1,
            'title'=>'Province No. 1',
            'created_at'=>'2018-09-12 18:15:00',
            'updated_at'=>'2018-09-12 18:15:00'
        ] );

        Province::create( [
            'id'=>2,
            'title'=>'Province No. 2',
            'created_at'=>'2018-09-12 18:15:00',
            'updated_at'=>'2018-09-12 18:15:00'
        ] );

        Province::create( [
            'id'=>3,
            'title'=>'Province No. 3',
            'created_at'=>'2018-09-12 18:15:00',
            'updated_at'=>'2018-09-12 18:15:00'
        ] );

        Province::create( [
            'id'=>4,
            'title'=>'Gandaki Pradesh',
            'created_at'=>'2018-09-12 18:15:00',
            'updated_at'=>'2018-09-12 18:15:00'
        ] );

        Province::create( [
            'id'=>5,
            'title'=>'Province No. 5',
            'created_at'=>'2018-09-12 18:15:00',
            'updated_at'=>'2018-09-12 18:15:00'
        ] );

        Province::create( [
            'id'=>6,
            'title'=>'Karnali Pradesh',
            'created_at'=>'2018-09-12 18:15:00',
            'updated_at'=>'2018-09-12 18:15:00'
        ] );

        Province::create( [
            'id'=>7,
            'title'=>'Sudurpashchim Pradesh',
            'created_at'=>'2018-09-12 18:15:00',
            'updated_at'=>'2018-09-12 18:15:00'
        ] );
    }
}
