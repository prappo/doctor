<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupScrapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_scrapers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('group_id')->nullable();
            $table->string('group_name')->nullable();
            $table->string('privacy')->nullable();
            $table->string('description')->nullable();
            $table->string('owner')->nullable();
            $table->string('link')->nullable();
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
        Schema::drop('group_scrapers');
    }
}
