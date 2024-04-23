<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('tournament_id');
            $table->unsignedBigInteger('referee_id');
            $table->unsignedBigInteger('stadium_id');

            $table->json('goals')->nullable();
            $table->json('local_changes')->nullable();
            $table->json('visit_changes')->nullable();
            $table->integer('total_players');
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
            $table->foreign('referee_id')->references('id')->on('referees')->onDelete('cascade');
            $table->foreign('stadium_id')->references('id')->on('stadiums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
