<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->integer('type');
            $table->integer('forum_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('forum_topic_id')->nullable()->unsigned();
            $table->timestamps();
            $table->engine = 'InnoDB';

            $table->foreign('forum_id')
                ->references('id')->on('forums')->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('forum_topic_id')
                ->references('id')->on('forums_topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forums_topics');
    }
}
