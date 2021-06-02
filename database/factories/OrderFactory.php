<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tenant = Tenant::first();

        return [
            'tenant_id' => $tenant != null ? $tenant : Tenant::factory()->create(),
            'identify' => uniqid() . Str::random(10),
            'total' => 80.0,
            'status' => 'open',
        ];
    }
}
