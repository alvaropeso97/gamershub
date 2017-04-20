<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComentariosMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_articulo');
            $table->integer('id_usuario');
            $table->text('comentario');
            $table->timestamps();

            $table->foreign('id_articulo')
                ->references('id')->on('articulos')->onDelete('cascade');

            $table->foreign('id_usuario')
                ->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('comentarios');
    }
}
