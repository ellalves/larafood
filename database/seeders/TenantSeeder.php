<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Tenant::factory()
                    ->for(Plan::first())
                    ->create();
    }
}
