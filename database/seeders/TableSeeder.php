<?php

namespace Database\Seeders;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Table::factory()
                    ->count(9)
                    ->for(Tenant::first())
                    ->create();
    }
}
