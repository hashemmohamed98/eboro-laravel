<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypalorders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('drop_lat')->nullable();
            $table->string('drop_long')->nullable();
            $table->string('drop_address')->nullable();
            $table->string('TOKEN')->nullable();
            $table->string('BUILD')->nullable();
            $table->string('State')->nullable();
            $table->string('paypal_link')->nullable();
            $table->timestamp('ordar_at')->nullable();
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
        Schema::dropIfExists('paypalorders');
    }
}
