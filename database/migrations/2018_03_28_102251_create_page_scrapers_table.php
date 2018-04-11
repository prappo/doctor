<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageScrapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_scrapers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('pageId');
            $table->string('pageName');
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('location')->nullable();
            $table->string('emails')->nullable();
            $table->string('likes')->nullable();
            $table->string('about')->nullable();
            $table->string('words');

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
        Schema::drop('page_scrapers');
    }
}
