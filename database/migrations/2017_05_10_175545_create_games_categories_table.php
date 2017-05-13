<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_categories', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('game_id')
                ->references('id')->on('games')->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')->on('categories')->onDelete('cascade');
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
        Schema::drop('games_categories');
    }
}
