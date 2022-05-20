<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('description', 80)->comment('Descripcion');
            $table->float('amount', 8, 2)->default('0')->comment('Importe');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('Usuario que lo crea');
            $table->foreignId('promoter_id')->constrained('promoters')->nullable()->onDelete('cascade')->comment('Promotor que recibe comision');
            $table->string('source', 244)->comment('Id de equipos');
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
        Schema::dropIfExists('payments');
    }
}
