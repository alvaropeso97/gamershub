<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EtiquetasMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etiquetas', function (Blueprint $table) {
            $table->integer('cod_art');
            $table->string('nombre', 30);
            $table->foreign('cod_art')
                ->references('id')->on('articulos')
                ->onDelete('cascade');
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
        Schema::drop('etiquetas');
    }
}
