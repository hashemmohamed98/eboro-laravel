<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo');
            $table->string('slider_image');
            $table->string('android_link');
            $table->string('iOS_link');
            $table->string('tax');
            $table->string('Dli_time');
            $table->string('shipping');
            $table->string('shipping2')->default(1);
            $table->string('min_shipping');
            $table->string('product_array');
            $table->string('providers_array');
            $table->string('product_offer_array');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('linkedin');
            $table->string('youtube');
            $table->string('about_en');
            $table->string('about_it');
            $table->string('privacy_en');
            $table->string('privacy_it');
            $table->string('contact_email_1');
            $table->string('contact_email_2');
            $table->string('contact_email_3');
            $table->string('contact_map');
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
        Schema::dropIfExists('settings');
    }
}
