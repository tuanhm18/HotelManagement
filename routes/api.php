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
<<<<<<< HEAD
Route::get('/admin/employees/{id?}', 'Api\EmployeeController@get');
=======
Route::post('admin/services', 'Api\ServiceController@create');
Route::put('admin/services/', 'Api\ServiceController@update');
Route::delete('admin/services/{id}', 'Api\ServiceController@delete');
>>>>>>> 94886ea21735cba2779028c268f09c49b3f3f49a

Route::get('/admin/rooms/{id?}', 'Api\RoomController@get');
Route::get('/admin/rooms-available', 'Api\RoomController@getAvailable');

Route::post('admin/rooms', 'Api\RoomController@create');
Route::put('admin/rooms', 'Api\RoomController@update');
Route::delete('admin/rooms/{id}','Api\RoomController@delete');

Route::get('/admin/positions/{id?}', 'Api\PositionController@get');
Route::post('admin/positions', 'Api\PositionController@create');
Route::put('admin/positions', 'Api\PositionController@update');
Route::delete('admin/positions/{id}','Api\PositionController@delete');

Route::get('/admin/customers/{id?}', 'Api\CustomerController@get');
<<<<<<< HEAD
Route::post('/admin/customers', 'Api\CustomerController@create');
Route::put('/admin/customers', 'Api\CustomerController@update');
Route::delete('/admin/customers/{id}','Api\CustomerController@delete');
=======
Route::post('admin/customers', 'Api\CustomerController@create'); 
Route::put('admin/customers', 'Api\CustomerController@update');
Route::delete('admin/customers/{id}','Api\CustomerController@delete');
>>>>>>> 94886ea21735cba2779028c268f09c49b3f3f49a

Route::get('/admin/bills/{id?}', 'Api\BillController@get');
Route::post('/admin/bills', 'Api\BillController@create');
Route::delete('/admin/bills/{id}', 'Api\BillController@delete');
Route::put('/admin/bills', 'Api\BillController@update');
// Route::post('admin/bills', 'Api\BillController@create');
// Route::put('admin/bills', 'Api\BillController@update');
// Route::delete('admin/bills/{id}','Api\BillController@delete');

Route::get('/admin/servicebills/{id?}', 'Api\ServiceBillController@get');
Route::put('/admin/servicebills', 'Api\ServiceBillController@update');
// Route::group(['middleware'=>'auth'], function() {
//     Route::get('/admin/rooms', 'Api/RoomController@get');
// });