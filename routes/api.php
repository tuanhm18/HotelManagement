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
Route::post('admin/services', 'Api\ServiceController@create');
Route::put('admin/services', 'Api\ServiceController@update');
Route::delete('admin/services/{id}', 'Api\ServiceController@delete');

Route::get('admin/roomtype/{id?}', 'Api\RoomTypeController@get');
Route::post('/admin/roomtype-validate', 'Api\RoomTypeController@validateRoomType');

Route::post('admin/roomtype', 'Api\RoomTypeController@create');
Route::put('admin/roomtype', 'Api\RoomTypeController@update');
Route::delete('admin/roomtype/{id}', 'Api\RoomTypeController@delete');

Route::get('/admin/employees/{id?}', 'Api\EmployeeController@get');
Route::post('admin/employees', 'Api\EmployeeController@create');
Route::post('/admin/employees-validate', 'Api\EmployeeController@validateEmployee');
Route::put('admin/employees', 'Api\EmployeeController@update');
Route::delete('admin/employees/{id}', 'Api\EmployeeController@delete');

Route::get('/admin/rooms/{id?}', 'Api\RoomController@get');
Route::get('/admin/rooms-available', 'Api\RoomController@getAvailable');
Route::get('/admin/rooms-valid/{id}', 'Api\RoomController@validRoomId');
Route::post('admin/rooms', 'Api\RoomController@create');
Route::post('admin/rooms/{id}', 'Api\RoomController@update');
Route::delete('admin/rooms/{id}','Api\RoomController@delete');

Route::get('/admin/positions/{id?}', 'Api\PositionController@get');
Route::post('admin/positions', 'Api\PositionController@create');
Route::put('admin/positions', 'Api\PositionController@update');
Route::delete('admin/positions/{id}','Api\PositionController@delete');
Route::post('/admin/positions-validate/', 'Api\PositionController@validatePosition');
Route::get('/admin/customers/{id?}', 'Api\CustomerController@get');

Route::post('/admin/customers', 'Api\CustomerController@create');
Route::put('/admin/customers', 'Api\CustomerController@update');
Route::delete('/admin/customers/{id}','Api\CustomerController@delete');

Route::post('admin/customers', 'Api\CustomerController@create'); 
Route::put('admin/customers', 'Api\CustomerController@update');
Route::delete('admin/customers/{id}','Api\CustomerController@delete');

Route::get('/admin/bills/{id?}', 'Api\BillController@get');
Route::post('/admin/bills', 'Api\BillController@create');
Route::delete('/admin/bills/{id}', 'Api\BillController@delete');
Route::put('/admin/bills', 'Api\BillController@update');
    // Route::post('admin/bills', 'Api\BillController@create');
// Route::put('admin/bills', 'Api\BillController@update');
// Route::delete('admin/bills/{id}','Api\BillController@delete');

Route::get('/admin/servicebills/{id?}', 'Api\ServiceBillController@get');
Route::put('/admin/servicebills', 'Api\ServiceBillController@update');
Route::get('/admin/users/{id?}', 'Api\UserManagerController@get');
Route::post('admin/users', 'Api\UserManagerController@create');
Route::post('admin/users/{id}', 'Api\UserManagerController@update');
Route::delete('admin/users/{id}', 'Api\UserManagerController@delete');
Route::post('/admin/username/{username}', 'Api\UserManagaerController@validateUserName');

Route::get('/admin/banners/{id?}', 'Api\BannerController@get');
Route::post('/admin/banners', 'Api\BannerController@create');
Route::post('/admin/banners/{id?}', 'Api\BannerController@update');
Route::delete('/admin/banners/{id}', 'Api\BannerController@delete');

// Route::group(['middleware'=>'auth'], function() {
//     Route::get('/admin/rooms', 'Api/RoomController@get');
// });