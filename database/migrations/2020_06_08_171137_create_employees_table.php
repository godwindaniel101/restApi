<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees' ,function(Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id')->nullable();
        $table->integer('company_id')->nullable();
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('middle_name')->nullable();
        $table->string('date_of_birth')->nullable();
        $table->string('martial_status')->nullable();
        $table->string('sex')->nullable();
        $table->string('phone_no')->nullable();
        $table->string('alt_phone_no')->nullable();
        $table->string('email')->nullable();
        $table->string('department')->nullable();
        $table->string('position')->nullable();
        $table->string('salary')->nullable();
        $table->string('access_level')->nullable();
        $table->string('experience_years')->nullable();
        $table->string('qualification')->nullable();
        $table->string('employee_type')->nullable();
        $table->string('start_date')->nullable();
        $table->string('country')->nullable();
        $table->string('state')->nullable();
        $table->string('city')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
