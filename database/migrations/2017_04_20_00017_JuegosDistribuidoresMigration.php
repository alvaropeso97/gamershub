<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JuegosDistribuidoresMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juegos_distribuidores', function (Blueprint $table) {
            $table->integer('juego_id');
            $table->integer('distribuidor_id');

            $table->foreign('juego_id')
                ->references('id')->on('juegos')->onDelete('cascade');

            $table->foreign('distribuidor_id')
                ->references('id')->on('distribuidores')->onDelete('cascade');
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
        Schema::drop('juegos_distribuidores');
    }
}
