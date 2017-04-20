<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JuegosGenerosMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juegos_generos', function (Blueprint $table) {
            $table->integer('id_juego');
            $table->integer('id_genero');

            $table->foreign('id_juego')
                ->references('id')->on('juegos')->onDelete('cascade');

            $table->foreign('id_genero')
                ->references('id')->on('generos')->onDelete('cascade');
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
        Schema::drop('juegos_generos');
    }
}
