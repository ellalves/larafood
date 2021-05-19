<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'icon' => $this->faker->unique()->word(),
            'uuid' => $this->faker->uuid(),
            'description' => $this->faker->sentence(3, true),
            'tenant_id' => Tenant::factory()->create() // $this->faker->randomDigitNot(0)
        ];
    }
}
