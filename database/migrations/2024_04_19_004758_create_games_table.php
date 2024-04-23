<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->unsignedBigInteger('round_id');
            $table->unsignedBigInteger('local_team_id');
            $table->unsignedBigInteger('visit_team_id');
            $table->integer('local_score')->default(0);
            $table->integer('visit_score')->default(0);
            $table->string('result')->nullable();
            $table->string('points_winner')->nullable();
            $table->integer('extra_points_winner')->nullable();
            $table->timestamps();
            $table->foreign('round_id')->references('id')->on('rounds')->onDelete('cascade');
            $table->foreign('local_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('visit_team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
