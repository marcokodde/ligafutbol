<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->comment('Tarea padre');
            $table->foreignId('user_require_id')->constrained('users');
            $table->foreignId('user_responsible_id')->constrained('users');
            $table->foreignId('status_id')->constrained('statuses');
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
        Schema::dropIfExists('sub_tasks');
    }
}
