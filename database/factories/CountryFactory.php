<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
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
            "id" => 1,
            "capital" => "Brasilia",
            "citizenship" => "Brasileiro",
            "country_code" => "076",
            "currency" => "real (pl. reais)",
            "currency_code" => "BRL",
            "currency_sub_unit" => "centavo",
            "full_name" => "Republica Federativa do Brasil",
            "iso_3166_2" => "BR",
            "iso_3166_3" => "BRA",
            "name" => "Brazil",
            "region_code" => "019",
            "sub_region_code" => "005",
            "eea" => false,
            "calling_code" => "55",
            "currency_symbol" => "R$",
            "currency_decimals" => "2",
            "flag" => "BR.png",
            // "updated_at" => now(),
            // "created_at" => now()
        ];
    }
}
