<?php

namespace Modules\Grocery\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Grocery\Database\factories\GroceryCategoryFactory;
use Modules\Grocery\Entities\GroceryCategory;

class GroceryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        GroceryCategory::factory()->times(15)->create();
    }
}
