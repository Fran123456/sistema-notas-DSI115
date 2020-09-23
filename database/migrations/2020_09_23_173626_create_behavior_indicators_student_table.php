<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBehaviorIndicatorsStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('behavior_indicators_student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('behavior_indicator_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('school_period_id')->nullable();
            $table->unsignedBigInteger('school_year_id')->nullable();
            $table->unsignedBigInteger('degree_id')->nullable();
            //$table->string('score')->nullable();
            //$table->timestamps();

             $table->foreign('behavior_indicator_id')
              ->references('id')
              ->on('behavior_indicators')
              ->onDelete('cascade')
              ->onUpdate('cascade');

              $table->foreign('student_id')
              ->references('id')
              ->on('students')
              ->onDelete('cascade')
              ->onUpdate('cascade');

              $table->foreign('school_period_id')
              ->references('id')
              ->on('school_period')
              ->onDelete('cascade')
              ->onUpdate('cascade');

               $table->foreign('school_year_id')
              ->references('id')
              ->on('school_years')
              ->onDelete('cascade')
              ->onUpdate('cascade');

              $table->foreign('degree_id')
              ->references('id')
              ->on('degrees')
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
        Schema::dropIfExists('behavior_indicators_student');
    }
}
