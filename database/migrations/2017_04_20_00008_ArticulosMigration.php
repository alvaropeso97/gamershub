<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticulosMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_autor')->unsigned();
            $table->integer('juego_rel')->unsigned();
            $table->dateTime('fecha');
            $table->string('tipo', 3);
            $table->string('img', 255);
            $table->string('titulo', 200);
            $table->string('descripcion', 200);
            $table->text('cont');
            $table->string('lnombre', 255);
            $table->timestamps();

            $table->foreign('id_autor')
                ->references('id')->on('users')->onDelete('set null');

            $table->foreign('juego_rel')
                ->references('id')->on('juegos')->onDelete('set null');
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
        Schema::drop('articulos');
    }
}
