<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            "create items",
            "edit items",
            "delete items",
            "publish items",
            "unpublish items",
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }

        $roles = [
            "subscriber" => [],
            "administrator" => [
                "create items",
                "edit items",
                "delete items",
                "publish items",
                "unpublish items",
            ],
            "restaurant" => [],
            "grocery" => [
                "create items",
                "edit items",
                "delete items",
                "publish items",
                "unpublish items",
            ],
        ];

        foreach($roles as $key=>$value){
            $role = Role::create(['name' => $key]);
            if(!blank($value)){
                $role->givePermissionTo($value);
            }
        }

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
