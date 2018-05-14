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



Route::resource('city', 'CityController');
Route::post('/city/list','CityController@fetch');
Route::get('/city','CityController@index');


Route::get('/', function () {
    return view('citytest');
});
Route::post('/cityTest/list','CityTestController@getCity');
Route::get('/citytest','CityTestController@index');
