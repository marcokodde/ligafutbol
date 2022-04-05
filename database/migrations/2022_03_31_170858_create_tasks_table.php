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
            $table->foreignId('client_id')->constrained('channels');
            $table->string('title')->comment('Título');

            $table->foreignId('priority_id')->constrained('priorities');
            $table->date('deadline');
            $table->foreignId('channel_id')->constrained('channels');
            $table->foreignId('type_task_id')->constrained('task_types');
            $table->foreignId('status_id')->constrained('statuses');
            $table->mediumText('description')->comment('Descripción');

            $table->foreignId('user_require_id')->constrained('users');
            $table->foreignId('user_created_by_id')->constrained('users'); // Auth user
            $table->foreignId('user_responsible_id')->constrained('users');
            $table->foreignId('user_take_over_id')->constrained('users'); // User_responsible_id

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
