<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {




        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address');
            $table->string('mobile');
            $table->string('verify_code')->nullable();
            $table->string('image')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();

            $table->tinyInteger('online')->default(0);
            $table->timestamp('last_session')->nullable();

            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('active')->default(1);
            $table->string('vehicle_type')->nullable();

            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();

            $table->timestamp('trial_ends_at')->nullable();
            $table->string('nationality')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('front_id_image')->nullable();
            $table->string('back_id_image')->nullable();
            $table->string('license_image')->nullable();
            $table->string('license_expire')->nullable();

            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('apple_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
