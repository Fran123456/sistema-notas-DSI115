<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDegreeSchoolYearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degree_school_year', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('degree_id')->nullable();
            $table->unsignedBigInteger('school_year_id')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('full')->default(0);
           //  $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('degree_id')
                ->references('id')
                ->on('degrees')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('degree_school_year');
    }
}
