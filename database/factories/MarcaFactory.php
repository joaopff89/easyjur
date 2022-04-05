<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MarcaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $marcas = ["Toyota", "Volkswagen", "Hyundai", "Ford", "Honda", "Nissan", "Chevrolet", "Kia", "Mercedes-Benz", "BMW"];

        return [
            'nome' => $this->faker->unique()->randomElement($marcas)
        ];
    }
}
