<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('task_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('project_id')->nullable();
            $table->string('task_name')->nullable();
            $table->string('assiged_to')->nullable();
            $table->string('assign_by')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('warn_date')->nullable();
            $table->string('task_priority')->nullable();
            $table->string('task_status')->nullable();
            $table->string('task_description')->nullable();
            $table->string('percentage_completed')->nullable();
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
