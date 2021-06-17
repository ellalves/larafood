<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tenant = Tenant::first();
        
        $date = date('Y-m-d H:i:s');

        return [
            "tenant_id" => $tenant != null ? $tenant : Tenant::factory()->create(),
            "name" => $this->faker->unique()->word(),
            "description" => $this->faker->sentence(3, true),
            "uuid" => $this->faker->uuid(),
            "discount" => $this->faker->randomFloat(2, 0, 200),
            "discount_mode" => "price",
            "limit" => 10,
            "limit_mode" => "price",
            "start_validity" => $date,
            "end_validity" => $this->faker->dateTimeThisYear($date),
            "active" => 'yes',
        ];
    }
}
