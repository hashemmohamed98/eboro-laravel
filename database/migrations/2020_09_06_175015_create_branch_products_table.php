<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->string('name');
            $table->double('price');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('type')->nullable();
            $table->string('additions')->nullable();
            $table->string('calories')->nullable();
            $table->string('size')->nullable();
            $table->tinyInteger('has_alcohol')->nullable();
            $table->tinyInteger('has_pig')->nullable();
            $table->tinyInteger('has_outofstock')->nullable();
            $table->timestamp('start_outofstock')->nullable();
            $table->timestamp('end_outofstock')->nullable();
            $table->enum('product_type',['Food','Sauce','Addition']);
            $table->timestamp('publish_at')->nullable();
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
        Schema::dropIfExists('branch_products');
    }
}
