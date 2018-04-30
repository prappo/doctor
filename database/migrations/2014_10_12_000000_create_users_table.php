<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_bangla')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('type')->nullable();
            $table->string('bio')->nullable();
            $table->string('bio_bangla')->nullable();
            $table->string('bio_a')->nullable();
            $table->string('bio_a_bangla')->nullable();
            $table->string('skype')->nullable();
            $table->string('cat')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
