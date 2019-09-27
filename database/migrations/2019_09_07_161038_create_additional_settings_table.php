<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_settings', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('site_icon')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('site_video_url')->nullable();
            $table->string('default_page_background')->nullable();
            $table->string('site_slogan')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_facebook_url')->nullable();
            $table->string('site_twitter_url')->nullable();
            $table->string('site_instagram_url')->nullable();
            $table->string('site_youtube_url')->nullable();
            $table->string('site_phone_number')->nullable();
            $table->string('site_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_settings');
    }
}
