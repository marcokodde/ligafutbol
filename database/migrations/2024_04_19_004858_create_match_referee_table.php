<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchRefereeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_referee', function (Blueprint $table) {
            $table->unsignedBigInteger('match_id');
            $table->unsignedBigInteger('referee_id');
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->foreign('referee_id')->references('id')->on('referees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_referee');
    }
}
