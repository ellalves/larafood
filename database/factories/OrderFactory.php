<?php

namespace Database\Factories;

use App\Models\FormPayment;
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
        $payment = FormPayment::first();

        return [
            'tenant_id' => $tenant != null ? $tenant : Tenant::factory()->create(),
            'form_payment_id' => $payment != null ? $tenant : FormPayment::factory()->create(),
            'identify' => uniqid() . Str::random(10),
            'address' => $this->faker->address(),
            'total_paid' => 60.0,
            'total_discount' => 20.0,
            'total' => 80.0,
            'status' => 'open',
        ];
    }
}
