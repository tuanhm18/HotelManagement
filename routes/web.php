<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/admin/login',  ['as' => 'login', 'uses' => 'Admin\UserController@login']);

Route::post('/admin/login', 'Admin\UserController@doLogin');
 Route::group(['middleware'=>'auth'], function() {
     Route::get('/admin', 'Admin\SiteController@index');
     Route::get('/admin/logout', 'Admin\UserController@doLogout');
     Route::get('/admin/booking', 'Admin\BookingController@view');
     Route::get('/admin/rooms', 'Admin\RoomController@view');
     Route::get('admin/services', 'Admin\ServiceController@view');
     Route::get('admin/postitions', 'Admin\PositionController@view');
     Route::get('admin/customers', 'Admin\CustomerController@view');
 });
