<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'uuid' => $this->faker->uuid(),
            'stripe_id' => $this->faker->uuid(),
            'description' => $this->faker->realText(),
            'url' => $this->faker->slug(),
            'price' => $this->faker->randomFloat(2, 0, 200)
        ];
    }
}
