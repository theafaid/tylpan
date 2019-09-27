<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->enum('gender', ['male', 'female'])->nullable(); // required
            $table->string('phone_number')->nullable(); // required
            $table->string('age')->nullable(); // required
            $table->string('avatar')->nullable(); // not required
            $table->text('social_links')->nullable(); // not required
            $table->enum('education_level', ['high_school', 'some_college', 'bachelor', 'master', 'doctoral'])->nullable(); // required
            $table->text('education_brief')->nullable(); // required
            $table->text('certifications')->nullable(); // not required [uuid, ]
            $table->text('additional_details')->nullable(); // not required
            $table->string('secondary_school_grade')->nullable(); // not required
            $table->date('secondary_school_graduated_date')->nullable(); // not required
            $table->date('college_graduated_date')->nullable(); // not required
            $table->string('social_status')->nullable(); // not required
            $table->text('health_status')->nullable(); // not requried
            $table->string('speaking_languages')->nullable(); // not required
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
