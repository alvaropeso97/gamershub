<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->string('type', 3);
            $table->string('image', 255);
            $table->string('title', 200);
            $table->string('description', 200);
            $table->text('content');
            $table->string('seo_optimized_title', 255);
            $table->timestamps();
            $table->engine = 'InnoDB';

            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_id')
                ->references('id')->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
