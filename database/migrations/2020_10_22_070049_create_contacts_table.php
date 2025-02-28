<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->nullable(); // only for the auth client
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('subject')->nullable();
            $table->longText('message');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('file')->nullable();
            $table->longText('re_message')->nullable(); // for admin to solve issue
            $table->enum('state',['open','closed'])->default('open'); //open on user edit , close on admin re_message
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
        Schema::dropIfExists('contacts');
    }
}
