<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Group;
use App\Models\Tenant;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = Group::factory()
                    ->count(1)
                    ->create();
        
        Plan::first()->groups()->attach($group->first()->id);
    }
}
