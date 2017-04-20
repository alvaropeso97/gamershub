<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JuegosMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juegos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('titulo', 255);
            $table->string('descripcion', 255);
            $table->string('dispo_en', 255);
            $table->string('jugadores', 255);
            $table->string('duracion', 255);
            $table->string('idioma', 50);
            $table->date('fecha_lanzamiento');
            $table->string('img_header', 255);
            $table->string('img_box', 255);
            $table->timestamps();
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
        Schema::drop('juegos');
    }
}
