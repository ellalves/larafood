<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\CountryFactory;
use Webpatser\Countries\Countries;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countryFactory = new CountryFactory();
        // dd(Countries::first());
        Countries::insert($countryFactory->definition());
    }
}
