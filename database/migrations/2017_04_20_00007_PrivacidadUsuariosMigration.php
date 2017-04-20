<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrivacidadUsuariosMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privacidad_usuarios', function (Blueprint $table) {
            $table->integer('id_usuario')->unsigned();
            $table->boolean('mostrar_perfil');
            $table->boolean('mostrar_ciudad');
            $table->boolean('mostrar_edad');
            $table->boolean('mostrar_sexo');
            $table->boolean('mostrar_cuentas_jue');
            $table->boolean('mostrar_cuentas_con');
            $table->timestamps();

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
        Schema::drop('privacidad_usuarios');
    }
}
