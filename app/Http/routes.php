<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});




    Route::get('Student/index',['uses' => 'StudentController@index']);
    Route::any('Student/create',['uses' => 'StudentController@create']);
    Route::any('Student/update/{id}',['uses' => 'StudentController@update']);
    Route::any('Student/delete/{id}',['uses' => 'StudentController@delete']);
    Route::any('Student/save',['uses' => 'StudentController@save']);








