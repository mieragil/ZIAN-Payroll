<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('date_hired')->nullable();
            $table->string('emp_status')->nullable();
            $table->string('weeks_of_training')->nullable();
            $table->string('rate')->nullable();
            $table->string('salary_type')->nullable();
            $table->string('position')->nullable();
            $table->string('department')->nullable();
            $table->string('priority')->nullable();
            $table->string('active')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
