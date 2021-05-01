<?php

namespace Database\Factories;

use App\Models\DetailPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(2),
            'url' => $this->faker->slug(),
        ];
    }
}
