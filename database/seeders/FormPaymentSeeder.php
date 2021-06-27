<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\FormPayment;
use Illuminate\Database\Seeder;

class FormPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = FormPayment::factory()
                        ->count(3)
                        ->for(Tenant::first())
                        ->create();
    }
}
