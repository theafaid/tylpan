<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('task_from');
            $table->unsignedBigInteger('task_for');
            $table->unsignedBigInteger('order_id');
            $table->string('task');
            $table->string('notice')->nullable();
            $table->enum('status', ['progressing', 'completed', 'failed'])->default('progressing');
            $table->timestamps();

            $table->foreign('task_from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_for')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
