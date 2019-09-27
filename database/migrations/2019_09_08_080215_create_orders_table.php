<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedBigInteger('delegate_id')->nullable();
            $table->unsignedBigInteger('delegate_assigned_by')->nullable();

            $table->string('code');
            $table->enum('status', ['progressing', 'failed', 'completed'])->default('progressing');
            $table->text('description_for_creator')->nullable();
            $table->text('specializations');
            $table->string('budget')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('delegate_assigned_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('delegate_id')->references('id')->on('users')->onDelete('set null');
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
