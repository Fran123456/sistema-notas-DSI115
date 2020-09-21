<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('school_period_id')->nullable();
            $table->unsignedBigInteger('school_year_id')->nullable();
            $table->unsignedBigInteger('degree_id')->nullable();
            $table->string('percentage')->nullable();
            $table->string('activity')->nullable();
            $table->text('description')->nullable();
            $table->string('date')->nullable();
            $table->boolean('state')->default(false);
           // $table->timestamps();

            $table->foreign('degree_id')
              ->references('id')
              ->on('degrees')
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_type');
    }
}
