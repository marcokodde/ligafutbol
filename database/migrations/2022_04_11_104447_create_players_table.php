<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',30)->comment('Nombre');
            $table->string('last_name',30)->comment('Apellido');
            $table->date('birthday')->comment('Fecha nacimiento');
            $table->enum('gender',['Female','Male'])->default('Male')->comment('Sexo');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('Usuario Que creó');
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
        Schema::dropIfExists('players');
    }
}
