<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->integer('role_id')->unsigned()->default(1);
            $table->string('name', 30);
            $table->string('surname', 30);
            $table->date('birthdate');
            $table->integer('country_id')->unsigned();
            $table->string('city', 30);
            $table->string('gender', 1)->nullable();
            $table->string('avatar', 255)->default('http://img.gamershub.es/base/usuario-default.png');
            $table->integer('favorite_genre')->nullable();
            $table->string('signature', 500)->nullable();
            $table->string('xbox_gamertag', 50)->nullable();
            $table->string('ps_id', 50)->nullable();
            $table->string('nintendo_network', 50)->nullable();
            $table->string('friend_code_wii', 50)->nullable();
            $table->string('friend_code_3ds', 50)->nullable();
            $table->string('friend_code_ds', 50)->nullable();
            $table->string('microsoft_gamertag', 50)->nullable();
            $table->string('steam_id', 50)->nullable();
            $table->string('twitter', 50)->nullable();
            $table->string('facebook', 50)->nullable();
            $table->string('google', 50)->nullable();
            $table->string('web_blog', 255)->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('verified')->default(0);
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')->on('roles');
            $table->foreign('country_id')
                ->references('id')->on('countries');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
