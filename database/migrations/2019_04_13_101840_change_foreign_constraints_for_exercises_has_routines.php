<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForeignConstraintsForExercisesHasRoutines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exercises_has_routines', function (Blueprint $table) {
            $table->dropForeign(['exercise_id']);
            $table->dropForeign(['routine_id']);

            $table->foreign('exercise_id')
                ->references('id')
                ->on('exercises')
                ->onDelete('cascade');


            $table->foreign('routine_id')
                ->references('id')
                ->on('routines')
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
        Schema::table('exercises_has_routines', function (Blueprint $table) {
            $table->dropForeign(['exercise_id']);
            $table->dropForeign(['routine_id']);

            $table->foreign('exercise_id')
                ->references('id')
                ->on('exercises');


            $table->foreign('routine_id')
                ->references('id')
                ->on('routines');
        });
    }
}
