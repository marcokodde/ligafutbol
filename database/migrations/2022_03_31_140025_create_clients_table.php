<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->comment('Nombre del cliente');
            $table->string('email')->null();
            $table->string('address', 100)->null();
            $table->string('interior_number', 10)->nullable()->default(null)->comment('Interior Number');
			$table->integer('zipcode')->unsigned()->null();
			$table->string('phone', 15)->null();
            $table->foreignId('user_account_manager_id')->constrained('users');
            $table->foreign('zipcode')->references('zipcode')->on('zipcodes')->onDelete('cascade');
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
        Schema::dropIfExists('clients');
    }
}
