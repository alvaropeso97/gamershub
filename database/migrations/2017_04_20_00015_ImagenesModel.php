<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagenesModel extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre', 255);
            $table->string('carpeta', 50);
            $table->string('ancho', 10);
            $table->string('alto', 10);
            $table->string('juego_id', 255);
            $table->timestamps();

            $table->foreign('juego_id')
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
        Schema::drop('imagenes');
    }
}
