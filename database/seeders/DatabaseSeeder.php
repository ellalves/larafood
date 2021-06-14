<?php

namespace Database\Seeders;

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
            PlanSeeder::class,
            DetailPlanSeeder::class,
            TenantSeeder::class,
            UserSeeder::class,
            GroupSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            ProductSeeder::class,
            TableSeeder::class,
            CategorySeeder::class,
            ClientSeeder::class,
            CountrySeeder::class,
            AddressSeeder::class,
        ]);
    }
}
