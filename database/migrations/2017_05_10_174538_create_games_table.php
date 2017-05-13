<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('description', 255);
            $table->string('available_on', 255);
            $table->string('players_quantity', 255);
            $table->string('duration', 255);
            $table->string('language', 50);
            $table->date('release_date');
            $table->string('header_image', 255);
            $table->string('boxed_image', 255);
            $table->timestamps();
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
        Schema::drop('games');
    }
}
