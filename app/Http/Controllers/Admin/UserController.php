<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
	public function index()
	{
		// if (\Gate::allows('isAdmin')) {
		// 	echo 'Admin user role is allowed';
		// } else {
		// 	echo 'Admin are not allowed not allowed';
		// }
		return View::make('admin.user');
	}

	public function login()
	{
		//check login from cookie
		$userCookie = Cookie::get('userCredential');
		// attempt to do the login
		if ($userCookie) {
			$userCookie = json_decode($userCookie);
			$userdata = array(
				'username' => $userCookie->username,
				'password' => $userCookie->password
			);
			$user = User::where(['username' => $userCookie->username])->first();
			if ($user) {
					if (Auth::attempt($userdata)) {
						// update db
						$user->LastLoginDate = Carbon::now();
						$user->LastLoginIp = request()->ip();
						$user->save();

						Session::put('user', Auth::user());
						return Redirect::action('Admin\SiteController@index');
						// return Redirect::action('Admin\OrderController@index');
					}
			}
					
		}
		return View::make('admin.login');
	}

	public function doLogin(Request $request)
	{
		// validate the info, create rules for the inputs
		$rules = array(
				'username' => 'required|min:1', // make sure the email is an actual email
				'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make($request->all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::action('Admin\UserController@login')
			->withErrors($validator) // send back all errors to the login form
			->withInput($request->except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {
			$user = User::where(['username' => $request->username])->first();
			if ($user) {
					// create our user data for the authentication
					$userdata = array(
						'username'  => $request->username,
						'password'  => $request->password
					);

					// attempt to do the login
					if (Auth::attempt($userdata)) {
						if ($request->has('rememberMe')) {
							Cookie::queue(Cookie::make('userCredential', json_encode($userdata), 60 * 24 * 365)); // cookie 1 year
						}
						$user->LastLoginDate = Carbon::now();
						$user->LastLoginIp = $request->ip();
						$user->save();
						Cookie::queue(Cookie::make("userFullName", $user->FirstName. ' ' .$user->LastName, 60*24*365));
						Session::put('user', Auth::user());
						return Redirect::action('Admin\SiteController@index');
						// return Redirect::action('Admin\OrderController@index');
					} else {
						Session::flash('message','Sai tên đăng nhập hoặc mật khẩu!');
						return Redirect::action('Admin\UserController@login')
						->withInput($request->except('password'));
					}
			
			} else {
				Session::flash('message','Tài khoản không tồn tại!');
				return Redirect::action('Admin\UserController@login')
				->withInput($request->except('password'));
			}
		}
	}

	public function doLogout() {
// 		Auth::logout();
		Cookie::queue(Cookie::forget('userCredential'));
		Cookie::queue(Cookie::forget('userFullName'));
		Session::flush();
		return Redirect::action('Admin\UserController@login');
	}
}
