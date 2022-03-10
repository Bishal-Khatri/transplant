<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Grocery\Database\Seeders\GroceryDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RolesAndPermissionSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(GroceryDatabaseSeeder::class);
        $this->call(AddressTableSeeder::class);
    }
}
