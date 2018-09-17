<?php

use Illuminate\Support\Facades\Auth;

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


//login routes
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/', function () {	
    return view('home');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::post('/submit-new-user', ['middleware'=>'auth', 'uses'=>'UserController@addUser']);



//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'UserController@setUser');

#example with middleware
#Route::put('/', ['middleware'=>'auth', 'uses'=>'AuthController@setAccount']);

#add user routes
Route::get('/addUser', ['middleware'=>'auth', 'uses'=>'UserController@index']);