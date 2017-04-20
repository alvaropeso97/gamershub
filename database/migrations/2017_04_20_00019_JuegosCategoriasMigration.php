<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JuegosCategoriasMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juegos_categorias', function (Blueprint $table) {
            $table->integer('id_juego');
            $table->integer('id_categoria');

            $table->foreign('id_juego')
                ->references('id')->on('juegos')->onDelete('cascade');

            $table->foreign('id_categoria')
                ->references('id')->on('categorias')->onDelete('cascade');
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
        Schema::drop('juegos_categorias');
    }
}
