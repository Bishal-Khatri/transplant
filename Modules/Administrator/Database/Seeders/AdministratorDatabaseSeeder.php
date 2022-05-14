<?php

namespace Modules\Administrator\Database\Seeders;

use Database\Seeders\DistrictsTableSeeder;
use Database\Seeders\ProvinceTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdministratorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
    }
}
