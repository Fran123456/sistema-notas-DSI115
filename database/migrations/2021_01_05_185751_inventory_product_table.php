<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InventoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('img')->nullable();
            $table->string('model')->nullable();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->boolean('state')->nullable();
            $table->float('stock')->nullable();
            //$table->string('score')->nullable();
            //$table->timestamps();



              $table->foreign('category_id')
              ->references('id')
              ->on('inventory_category')
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
        Schema::dropIfExists('inventory_products');
    }
}
