<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        /**
         * Antes de executar db:seed tem que retirar o 'use TenantTrait' dos 
         * models: Product, Category e Table
         */

        $this->call([
            // PlansTableSeeder::class,
            TenantsTableSeeder::class,
            UsersTableSeeder::class,
            GroupsTableSeeder::class,
            PermissionSeeder::class,
            ProductSeeder::class,
            RoleSeeder::class,
            TableSeeder::class,
            CategorySeeder::class,
            DetailPlanSeeder::class,
            ClientSeeder::class
        ]);
    }
}
