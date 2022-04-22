<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name',150)->comment('Nombre del torneo');
            $table->tinyInteger('max_players_by_team')->default(6)->comment('Máximo de jugadores x Equipo');
            $table->boolean('players_only_available_teams')->default(0)->comment('Asignar jugadores solo a equipoos habilitados');
            $table->boolean('coaches_only_available_teams')->default(1)->comment('Asignar entrenadores solo a equipoos habilitados');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
