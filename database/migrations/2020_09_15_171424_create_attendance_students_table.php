<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_students', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->date('attendance_date');
            $table->unsignedBigInteger('student_history_id')->nullable();
            $table->boolean('active')->default(false);     
            $table->timestamps();

            $table->foreign('student_history_id')
                ->references('id')
                ->on('students_history')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->index(['student_history_id', 'attendance_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_students');
    }
}
