<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_comments', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('article_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('comment');
            $table->timestamps();

            $table->foreign('article_id')
                ->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
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
        //
    }
}
