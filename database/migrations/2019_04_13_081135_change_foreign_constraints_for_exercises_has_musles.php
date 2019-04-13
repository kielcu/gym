<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForeignConstraintsForExercisesHasMusles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exercises_has_muscles', function (Blueprint $table) {

            $table->dropForeign(['exercise_id']);
            $table->dropForeign(['muscle_id']);

            $table->foreign('exercise_id')
                ->references('id')
                ->on('exercises')
                ->onDelete('cascade');


            $table->foreign('muscle_id')
                ->references('id')
                ->on('muscles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exercises_has_muscles', function (Blueprint $table) {
            $table->dropForeign(['exercise_id']);
            $table->dropForeign(['muscle_id']);

            $table->foreign('exercise_id')
                ->references('id')
                ->on('exercises');


            $table->foreign('muscle_id')
                ->references('id')
                ->on('muscles');
        });
    }
}
