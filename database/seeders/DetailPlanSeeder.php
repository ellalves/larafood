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
        DetailPlan::factory()->count(12)->create();
    }
}
