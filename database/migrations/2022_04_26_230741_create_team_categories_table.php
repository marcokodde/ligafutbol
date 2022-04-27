<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('Usuario que lo crea');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->comment('Id de Categoría');
            $table->foreignId('payment_id')->constrained('payments')->onDelete('cascade')->comment('Id del pago');
            $table->string('qty_teams',100)->comment('Equipos Agregados');
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
        Schema::dropIfExists('team_categories');
    }
}
