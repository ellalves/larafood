<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::factory(3) // Make three plans
                    ->has(Tenant::factory(3)->has(User::factory()->count(3))->count(3)) // Associa cada plano a 3 tenants
                    ->create();
    }
}
