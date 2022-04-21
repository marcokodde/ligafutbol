<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostByTeamsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('cost_by_teams', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('min')->unsigned()->comment('Equipos desde');
            $table->tinyInteger('max')->unsigned()->comment('Equipos hasta');
            $table->float('cost', 8, 2)->default('0')->comment('Costo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cost_by_teams');
    }
}
