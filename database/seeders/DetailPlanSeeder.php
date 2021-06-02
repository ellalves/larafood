<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\DetailPlan;
use Illuminate\Database\Seeder;

class DetailPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        DetailPlan::factory()
                        ->count(3)
                        ->for($plan)
                        ->create();
    }
}
