<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('modelo_id');
            $table->unsignedBigInteger('versao_id')->nullable();
            $table->string('descricao', 100);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('modelo_id')->references('id')->on('modelos');
            $table->foreign('versao_id')->references('id')->on('versoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dicas');
    }
}
