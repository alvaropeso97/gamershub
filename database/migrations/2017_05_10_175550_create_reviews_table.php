<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->integer('gameplay_score');
            $table->integer('graphics_score');
            $table->integer('sounds_score');
            $table->integer('innovation_score');
            $table->timestamps();

            $table->foreign('article_id')
                ->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('game_id')
                ->references('id')->on('games')->onDelete('cascade');
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
        Schema::drop('reviews');
    }
}
