<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserExercise extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exercise', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exercise_id')->unsigned();
            $table->foreign('exercise_id')->references('id')->on('exercise')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('exercise_day');
            $table->integer('sets');
            $table->integer('reps');
            $table->boolean('control')->default(false);
            $table->timestamp('added_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_exercise');
    }
}
