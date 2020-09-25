<?php

use App\Events\MyEvent;
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

Route::get('/', 'FrontEnd\SiteController@view');
Route::get('/rooms', 'FrontEnd\RoomController@view');
Route::get('/about', 'FrontEnd\AboutController@view');
Route::get('/contact', 'FrontEnd\ContactController@view');
Route::get('/booking', 'FrontEnd\BookingController@view');
Route::post('/booking', 'FrontEnd\BookingController@create');
Route::get('blogs/{id}', 'FrontEnd\BlogController@view');
Route::get('test', function() {
    event(new MyEvent('Welcome'));
    return "Event has been sent";
});
Route::post('/admin/login', 'Admin\UserController@doLogin');
 Route::group(['middleware'=>'auth'], function() {
     Route::get('/admin', 'Admin\SiteController@index');
     Route::get('/admin/logout', 'Admin\UserController@doLogout');
     Route::get('/admin/booking', 'Admin\BookingController@view');
     Route::get('/admin/rooms', 'Admin\RoomController@view');
     Route::get('admin/services', 'Admin\ServiceController@view');
     Route::get('admin/postitions', 'Admin\PositionController@view');
     Route::get('admin/customers', 'Admin\CustomerController@view');
     Route::get('admin/servicebills', 'Admin\ServiceBillController@view');
     Route::get('admin/bills', 'Admin\BillController@view');
     Route::get('admin/roomtypes', 'Admin\RoomTypeController@view');
     Route::get('admin/employees', 'Admin\EmployeeController@view');
     Route::get('admin/banners', 'Admin\BannerController@view');
     Route::get('admin/blogs', 'Admin\BlogController@view');
     Route::get('admin/categories','Admin\CategoryController@view');
    Route::group(['middleware' => 'role'], function() {
        Route::get('user-list', 'Admin\UserManagerController@view');
    });
 });
