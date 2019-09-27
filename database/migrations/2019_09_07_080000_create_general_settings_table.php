<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('site_name');
            $table->string('site_description')->nullable();
            $table->string('site_keywords')->nullable();
            $table->boolean('allow_notifications')->default(true);
            $table->boolean('allow_friends')->default(true);
            $table->boolean('site_open')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
