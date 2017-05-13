<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPrivacyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_privacy', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('public_profile')->default(1);
            $table->boolean('public_city')->default(1);
            $table->boolean('public_age')->default(1);
            $table->boolean('public_accounts')->default(1);
            $table->boolean('public_con_accounts')->default(1);
            $table->timestamps();

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
        Schema::drop('users_privacy');
    }
}
