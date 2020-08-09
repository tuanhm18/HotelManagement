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
Route::post('admin/services', 'Api\ServiceCotroller@create');
Route::put('admin/services/}', 'Api\ServiceController@update');
Route::delete('admin/services/{id}', 'Api\ServiceController@delete');

Route::get('/admin/rooms/{id?}', 'Api\RoomController@get');
Route::post('admin/rooms', 'Api\RoomController@create');
Route::put('admin/rooms', 'Api\RoomController@update');
Route::delete('admin/rooms/{id}','Api\RoomController@delete');

Route::get('/admin/positions/{id?}', 'Api\PositionController@get');
Route::post('admin/positions', 'Api\PositionController@create');
Route::put('admin/positions', 'Api\PositionController@update');
Route::delete('admin/positions/{id}','Api\PositionController@delete');

Route::get('/admin/customers/{id?}', 'Api\CustomerController@get');
Route::post('admin/customers', 'Api\CustomerController@create'); 
Route::put('admin/customers', 'Api\CustomerController@update');
Route::delete('admin/customers/{id}','Api\CustomerController@delete');

Route::get('/admin/bills/{id?}', 'Api\BillController@get');
Route::post('admin/bills', 'Api\BillController@create');
Route::put('admin/bills', 'Api\BillController@update');
Route::delete('admin/bills/{id}','Api\BillController@delete');
// Route::group(['middleware'=>'auth'], function() {
//     Route::get('/admin/rooms', 'Api/RoomController@get');
// });