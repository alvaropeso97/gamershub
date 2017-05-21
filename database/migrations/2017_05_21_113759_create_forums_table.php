<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('type');
            $table->integer('forum_section_id')->unsigned();
            $table->integer('game_id')->nullable()->unsigned();
            $table->integer('category_id')->nullable()->unsigned();
            $table->string('seo_optimized_title');
            $table->timestamps();
            $table->engine = 'InnoDB';

            $table->foreign('forum_section_id')
                ->references('id')->on('forums_sections')->onDelete('cascade');
            $table->foreign('game_id')
                ->references('id')->on('games')->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forums');
    }
}
