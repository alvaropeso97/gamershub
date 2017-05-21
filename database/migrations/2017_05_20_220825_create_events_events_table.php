<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();;
            $table->integer('child_event_id')->unsigned();;
            $table->timestamps();
            $table->engine = 'InnoDB';

            $table->foreign('event_id')
                ->references('id')->on('events')->onDelete('cascade');
            $table->foreign('child_event_id')
                ->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events_events');
    }
}
