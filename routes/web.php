<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('muscle', 'MuscleController');
Route::resource('exercise', 'ExerciseController');
Route::resource('routine', 'RoutineController');
Route::resource('training', 'TrainingController');
Route::resource('work', 'WorkController');

Route::prefix('record')->name('record.')->group(function() {
    Route::get('weight', 'RecordController@weight')->name('weight');
    Route::get('bulk', 'RecordController@bulk')->name('bulk');
});

Route::prefix('statistic')->name('statistic.')->group(function() {
    Route::get('/', 'StatisticController@work')->name('index');
});
