<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Tipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Versao;

class DicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'tipo_id' => Tipo::all()->random()->id,
            'marca_id' => Marca::all()->random()->id,
            'modelo_id' => Modelo::all()->random()->id,
            'versao_id' => mt_rand(0, 3) ? Versao::all()->random()->id : null,
            'descricao' => $this->faker->unique()->sentence()
        ];
    }
}
