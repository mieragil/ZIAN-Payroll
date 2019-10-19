<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('emp_id');
<<<<<<< HEAD:database/migrations/2019_10_17_172754_create_deduction_table.php
            $table->string('phic');
            $table->string('sss');
            $table->string('pag-ibig');
=======
            $table->integer('SSS');
            $table->integer('PHIC');
            $table->integer('PAG_IBIG');
>>>>>>> upstream/master:database/migrations/2019_10_11_152506_create_deductions_table.php
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
        Schema::dropIfExists('deduction');
    }
}
