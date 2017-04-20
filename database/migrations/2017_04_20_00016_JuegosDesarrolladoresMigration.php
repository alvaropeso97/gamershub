<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JuegosDesarrolladoresMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juegos_desarroladores', function (Blueprint $table) {
            $table->integer('juego_id');
            $table->integer('desarrollador_id');

            $table->foreign('juego_id')
                ->references('id')->on('juegos')->onDelete('cascade');

            $table->foreign('desarrollador_id')
                ->references('id')->on('desarrolladores')->onDelete('cascade');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Revertir las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('juegos_desarroladores');
    }
}
