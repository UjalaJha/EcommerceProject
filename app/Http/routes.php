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
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


//crud using datatable.js on city
Route::resource('city', 'CityController');
Route::get('/city','CityController@index');
Route::get('/cityjson','CityController@jsondata');
Route::post ( '/deleteitem','CityController@delete' );
Route::post ( '/edititem','CityController@editdata' );




//product 
Route::get('/products','ProductController@index');
Route::get('/productsjson','ProductController@jsondata');
Route::get('/productaddedit/{data?}','ProductController@addedit');
Route::get('/changestatus/{id}','ProductController@changestatus');
Route::post ('/productsubmitForm','ProductController@submitform' );


//test without datable.js
Route::post('/cityTest/list','CityTestController@getCity');
Route::get('/citytest','CityTestController@index');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/log_in', function () {
    return view('authenticate.login');
});
Route::auth();

Route::get('/home', 'HomeController@index');
