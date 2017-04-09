<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackableTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('history',
                function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event');
            $table->morphs('trackable');
            $table->morphs('causer');
            $table->timestamps();
        });
        Schema::create('history_data',
                function (Blueprint $table) {
            $table->bigInteger('history_id');
            $table->string('field');
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('history');
        Schema::drop('history_data');
    }

}