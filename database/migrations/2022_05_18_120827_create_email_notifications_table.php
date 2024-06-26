<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->comment('Nombre');
            $table->string('email')->comment('correo electrónico');
            $table->boolean('noty_create_user')->nullable()->default(0)->comment('Notificar cuando se cree un usuario');
            $table->boolean('noty_payment')->nullable()->default(0)->comment('Notificar cuando alguien hizo un pago');
            $table->boolean('noty_without_payment')->nullable()->default(0)->comment('Notificar cuando alguien no pudo realizar pago');
            $table->boolean('noty_register_teams')->nullable()->default(0)->comment('Notificar cuando registren equipos');
            $table->boolean('noty_register_players')->nullable()->default(0)->comment('Notificar cuando registren jugadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_notifications');
    }
}
