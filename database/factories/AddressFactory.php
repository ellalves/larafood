<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Webpatser\Countries\Countries;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "uuid" => $this->faker->uuid(),
            "street" => $this->faker->streetAddress(),
            "state" => $this->faker->state(),
            "city" => $this->faker->city(),
            "street_extra" => $this->faker->streetSuffix(),
            "lat" => $this->faker->latitude(),
            "lng" => $this->faker->longitude(),
            "post_code" => $this->faker->postcode(),
            "country" => "BR",
            "country_id" => 1,
            "is_primary" => 1
        ];
    }
}
