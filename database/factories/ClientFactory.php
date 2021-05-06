<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElements(["M", "F"])[0];
        return [
            'name' => $this->faker->firstName($gender) . ' ' . $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'sex' => $gender,
            'uuid' => $this->faker->uuid(),
            'document' => $this->faker->cpf(false),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->numerify('(##)#####-####'),
            'birth' => $this->faker->dateTimeBetween('-90 years', 'now', 'America/Bahia'),
            'bio' => $this->faker->realText(),
            'email_verified_at' => now(),
            'password' => 'password', // '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
