<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ModeloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $modelos = ["Chevrolet Onix Plus", "Volkswagen T-Cross", "Hyundai Creta", "Fiat Mobi", "Volkswagen Gol", "Jeep Compass", "Chevrolet Onix", "Jeep Renegade", "Fiat Argo", "Hyundai HB20"];

        return [
            'nome' => $this->faker->unique()->randomElement($modelos)
        ];
    }
}
