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
            $table->integer('user_id')->comment('User id');
            $table->string('source', 244)->coment('Source');
            $table->string('address', 80)->coment('Adress Payment');
            $table->string('phone', 12)->coment('Phone Payment');
            $table->string('zipcode', 10)->coment('Zipcode Payment');
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
