<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Database\Factories\AddressFactory;
use Lecturize\Addresses\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addressFactory = new AddressFactory();
        
        $client = Client::first();
        $client->addAddress(
            $addressFactory->definition()
        );
    }
}
