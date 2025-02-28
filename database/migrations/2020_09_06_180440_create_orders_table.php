<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->double('total_price');
            $table->double('tax_price')->nullable();
            $table->double('shipping_price')->nullable();
            $table->enum('status',['pending','in progress','to delivering' ,'on delivering','delivered','completed' ,'cancelled' ,'User Not Found'])->default('pending');
            $table->string('drop_lat');
            $table->string('drop_long');
            $table->string('drop_address')->nullable();
            $table->string('transaction_ID')->nullable();
            $table->unsignedBigInteger('delivery_id')->nullable();
            $table->foreign('delivery_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('cashier_id')->nullable();
            $table->foreign('cashier_id')->references('id')->on('branch_staff')->onDelete('cascade');
            $table->tinyInteger('payment')->default(0);
            $table->text('refuse_reason')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
