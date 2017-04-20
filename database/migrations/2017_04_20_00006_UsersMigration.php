<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersMigration extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('nombre', 30);
            $table->string('apellidos', 30);
            $table->date('fecha_nacimiento');
            $table->string('pais', 2);
            $table->string('ciudad', 30);
            $table->string('sexo', 1);
            $table->string('img_perfil', 255)->default('http://img.gamershub.es/base/usuario-default.png');
            $table->integer('genero_preferido');
            $table->string('firma_personal', 500);
            $table->string('xbox_gamertag', 50);
            $table->string('ps_id', 50);
            $table->string('nintendo_network', 50);
            $table->string('codigo_amigo_wii', 50);
            $table->string('codigo_amigo_3ds', 50);
            $table->string('codigo_amigo_ds', 50);
            $table->string('microsoft_gamertag', 50);
            $table->string('steam_id', 50);
            $table->string('twitter', 50);
            $table->string('facebook', 50);
            $table->string('google', 50);
            $table->string('web_blog', 255);
            $table->timestamps();

            $table->foreign('pais')
                ->references('cod_pais')->on('paises');
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
        Schema::drop('users');
    }
}
