<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
            $table->string('alpha2_code');
            $table->string('calling_codes');
            $table->string('region');
            $table->string('timezones');
            $table->text('currencies');
            $table->string('languages');
            $table->string('flag')->nullable();
            $table->boolean('travel_from')->default(1);
            $table->boolean('travel_to')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
