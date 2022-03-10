<?php

namespace Modules\Grocery\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Grocery\Database\factories\GroceryCategoryFactory;
use Modules\Grocery\Entities\Brand;
use Modules\Grocery\Entities\GroceryCategory;
use Modules\Grocery\Entities\Item;
use Modules\Grocery\Entities\ItemQuantity;

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
        GroceryCategory::factory()->times(5)->create();
        Item::factory()->times(5)->create();
        Brand::factory()->times(5)->create();
        ItemQuantity::factory()->times(5)->create();
    }
}
