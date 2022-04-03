<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups')->comment('Grupo');
            $table->foreignId('user_require_id')->constrained('users');
            $table->foreignId('user_responsible_id')->constrained('users');
            $table->foreignId('status_id')->constrained('statuses');
            $table->foreignId('departament_id')->constrained('departaments');
            $table->foreignId('priority_id')->constrained('priorities');
            $table->date('deadline');
            $table->string('title')->comment('Título');
            $table->mediumText('description')->comment('Descripción');
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
        Schema::dropIfExists('tasks');
    }
}
