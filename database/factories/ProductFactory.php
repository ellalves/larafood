<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(1),
            'uuid' => $this->faker->uuid(),
            'url' => $this->faker->slug(),
            'description' => $this->faker->realText(),
            'price' => 12.9, // $this->faker->randomFloat(2, 0, 200),
            'tenant_id' => Tenant::factory()->create()
        ];
    }
}
