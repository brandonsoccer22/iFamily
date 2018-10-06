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

/*Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});
*/

Route::get('/', function () {	
    return view('home');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');




//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'UserController@setUser');

#example with middleware
#Route::put('/', ['middleware'=>'auth', 'uses'=>'AuthController@setAccount']);

#add user routes
Route::get('/addUser', ['middleware'=>['auth','is_parent','has_user'], 'uses'=>'UserController@index']);
Route::post('/submit-new-user', 'UserController@addUser')->middleware('auth', 'is_parent','has_user');


#choir routes
Route::get('/reviewChoirs', ['middleware'=>['auth','is_parent','has_user'], 'uses'=>'ChoirController@index']);
Route::post('/submit-new-choir', 'ChoirController@put')->middleware('auth', 'is_parent','has_user');

#groceries routes
Route::get('/groceries', ['middleware'=>['auth','has_user'], 'uses'=>'GroceryController@index']);
Route::get('/groceries/create', ['middleware'=>['auth','has_user'], 'uses'=>'GroceryController@create']);
Route::post('/groceries', ['middleware'=>['auth','has_user'], 'uses'=>'GroceryController@store']);
Route::post('/groceries/done', ['middleware'=>['auth','has_user'], 'uses'=>'GroceryController@done']);
Route::post('/groceries/delete', ['middleware'=>['auth','has_user'], 'uses'=>'GroceryController@delete']);

#polls routes
Route::get('/polls', ['middleware'=>['auth','has_user'], 'uses'=>'PollController@index']);
Route::get('/polls/create', ['middleware'=>['auth','has_user'], 'uses'=>'PollController@create']);
Route::post('/polls', ['middleware'=>['auth','has_user'], 'uses'=>'PollController@store']);
Route::post('/polls/vote', ['middleware'=>['auth','has_user'], 'uses'=>'PollController@vote']);
Route::post('/polls/done', ['middleware'=>['auth','has_user'], 'uses'=>'PollController@done']);