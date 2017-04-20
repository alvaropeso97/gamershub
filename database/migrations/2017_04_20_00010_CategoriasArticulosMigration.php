<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoriasArticulosMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_articulos', function (Blueprint $table) {
            $table->integer('id_cat');
            $table->integer('cod_art');

            $table->foreign('id_cat')
                ->references('id')->on('categorias')->onDelete('cascade');

            $table->foreign('cod_art')
                ->references('id')->on('articulos')->onDelete('cascade');
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
        Schema::drop('categorias_articulos');
    }
}
