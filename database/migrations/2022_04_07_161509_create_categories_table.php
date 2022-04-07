<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->comment('Nombre Categoría');
            $table->date('date_from')->comment('Fecha desde');
            $table->date('date_to')->comment('Fecha hasta');
            $table->enum('gender',['Female','Male','Unisex'])->default('Unisex')->comment('Sexo');
            $table->boolean('active')->default(1)->comment('¿Activa?');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
