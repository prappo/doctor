<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('from');
            $table->string('to');
            $table->string('status');
            $table->string('seen')->nullable();
            $table->string('job_time')->nullable();
            $table->string('confirmation_seen')->nullable();
            $table->string('feedback_seen')->nullable();
            $table->string('p_seen')->nullable();
            $table->string('p_txt')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calls');
    }
}
