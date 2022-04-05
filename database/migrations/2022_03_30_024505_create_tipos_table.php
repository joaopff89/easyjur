<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('tipos')->insert(["nome" => "Moto", "created_at" => NOW(), "updated_at" => NOW()]);
        DB::table('tipos')->insert(["nome" => "Carro", "created_at" => NOW(), "updated_at" => NOW()]);
        DB::table('tipos')->insert(["nome" => "Caminhão", "created_at" => NOW(), "updated_at" => NOW()]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos');
    }
}
