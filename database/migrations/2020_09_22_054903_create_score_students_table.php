<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('score_type_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('school_period_id')->nullable();
            $table->unsignedBigInteger('school_year_id')->nullable();
            $table->unsignedBigInteger('degree_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->string('score')->default(0);
            $table->timestamps();

            $table->foreign('subject_id')
             ->references('id')
             ->on('subjects')
             ->onDelete('cascade')
             ->onUpdate('cascade');

             $table->foreign('score_type_id')
              ->references('id')
              ->on('score_type')
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
        Schema::dropIfExists('score_students');
    }
}
