<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DistribuidoresMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribuidores', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre', 100);
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
        Schema::drop('distribuidores');
    }
}
