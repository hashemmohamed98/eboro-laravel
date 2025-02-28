<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealproudactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mealproudacts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('Meal_id')->nullable();
            $table->foreign('Meal_id')->references('id')->on('mealoffers')->onDelete('cascade');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('branch_products')->onDelete('cascade');

            $table->longText('amounts')->nullable();

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
        Schema::dropIfExists('mealproudacts');
    }
}
