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


Route::get('/admin/rooms/{id?}', 'Api\RoomController@get');
Route::get('admin/services/{id?}', 'Api\ServiceController@get');
Route::post('admin/rooms', 'Api\RoomController@create');
Route::put('admin/rooms', 'Api\RoomController@update');
Route::delete('admin/rooms/{id}','Api\RoomController@delete');
// Route::group(['middleware'=>'auth'], function() {
//     Route::get('/admin/rooms', 'Api/RoomController@get');
// });