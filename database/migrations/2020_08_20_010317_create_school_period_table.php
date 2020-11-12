<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_period', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('nperiodo')->nullable();
           // $table->string('nuevo') ->nullable();
            $table->boolean('current')->default(false);
            $table->boolean('finish')->default(false);
            $table->unsignedBigInteger('school_year_id')->nullable();
          //  $table->timestamps();

          $table->foreign('school_year_id')
              ->references('id')
              ->on('school_years')
              ->onDelete('cascade')
              ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_period');
    }
}
