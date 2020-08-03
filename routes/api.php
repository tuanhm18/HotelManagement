<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('admin/services/{id?}', 'Api\ServiceController@get');

Route::get('/admin/rooms/{id?}', 'Api\RoomController@get');
Route::post('admin/rooms', 'Api\RoomController@create');
Route::put('admin/rooms', 'Api\RoomController@update');
Route::delete('admin/rooms/{id}','Api\RoomController@delete');

Route::get('/admin/positions/{id?}', 'Api\Positonstroller@get');
Route::post('admin/positions', 'Api\Positonstroller@create');
Route::put('admin/positions', 'Api\Positonstroller@update');
Route::delete('admin/positions/{id}','Api\Positonstroller@delete');

Route::get('/admin/customers/{id?}', 'Api\Customerstroller@get');
Route::post('admin/customers', 'Api\Customerstroller@create');
Route::put('admin/customers', 'Api\Customerstroller@update');
Route::delete('admin/customers/{id}','Api\Customerstroller@delete');
// Route::group(['middleware'=>'auth'], function() {
//     Route::get('/admin/rooms', 'Api/RoomController@get');
// });