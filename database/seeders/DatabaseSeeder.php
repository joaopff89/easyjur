<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Versao;
use App\Models\Dica;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Marca::factory(10)->create();
        Modelo::factory(10)->create();
        Versao::factory(10)->create();
        Dica::factory(100)->create();
    }
}
