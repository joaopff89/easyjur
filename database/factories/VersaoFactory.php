<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VersaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $versoes = ["GTI", "Raptor", "Economy", "sporting", "Fire", "Classic", "Hatch", "Unique", "weekend", "adventure"];

        return [
            'nome' => $this->faker->unique()->randomElement($versoes)
        ];
    }
}
