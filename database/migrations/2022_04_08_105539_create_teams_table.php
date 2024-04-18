<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->comment('Equipo');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->comment('Categoría');
            $table->unsignedInteger('zipcode')->nullable()->comment('Zona postal');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('Usuario que lo crea');
            $table->boolean('active')->default(1)->comment('Activo?');
            $table->boolean('enabled')->default(0)->comment('Habilitado para toreno?');
            // Llave foránea
            $table->foreign('zipcode')->references('zipcode')->on('zipcodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
