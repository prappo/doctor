<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pId');
            $table->string('from');
            $table->string('to');
            $table->string('rx')->nullable();
            $table->string('chief_complaints')->nullable();
            $table->string('general_examinations')->nullable();
            $table->string('advice_for_investigations')->nullable();
            $table->string('advice')->nullable();
            $table->string('next_visit_date')->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
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
        Schema::drop('prescriptions');
    }
}
