<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnalisisMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('articulo');
            $table->integer('juego');
            $table->integer('jugabilidad');
            $table->integer('graficos');
            $table->integer('sonidos');
            $table->integer('innovacion');
            $table->timestamps();

            $table->foreign('articulo')
                ->references('id')->on('articulos')->onDelete('cascade');

            $table->foreign('juego')
                ->references('id')->on('juegos')->onDelete('cascade');
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
        Schema::drop('analisis');
    }
}
