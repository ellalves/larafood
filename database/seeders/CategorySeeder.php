<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::factory()
                        ->count(9)
                        ->for(Tenant::first())
                        ->create();
        
        Product::inRandomOrder()->first()->categories()->attach($category);
    }
}
