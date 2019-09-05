<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender', ['male', 'female']);
            $table->unsignedSmallInteger('country_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('age');
            $table->string('avatar')->nullable();
            $table->text('social_links')->nullable();
            $table->enum('role', ['user', 'delegate', 'admin', 'super_admin']);
            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('set null');
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
