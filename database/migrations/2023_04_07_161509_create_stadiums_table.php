<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStadiumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stadiums', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('Nombre Categoría');
            $table->string('place', 50)->comment('Nombre lugar');
            $table->string('location', 50)->comment('Nombre Ubicacion');
            $table->boolean('active')->default(1)->comment('¿Activa?');
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
        Schema::dropIfExists('stadiums');
    }
}
