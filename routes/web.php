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
Route::get('/edit-profile', 'UserController@editPage');
Route::post('/user-patch', 'UserController@patch');

#example with middleware
#Route::put('/', ['middleware'=>'auth', 'uses'=>'AuthController@setAccount']);

#add user routes
Route::get('/addUser', ['middleware'=>['auth','is_parent','has_user'], 'uses'=>'UserController@index']);
Route::post('/submit-new-user', 'UserController@addUser')->middleware('auth', 'is_parent','has_user');


#choir routes
Route::get('/reviewChoirs', ['middleware'=>['auth','is_parent','has_user'], 'uses'=>'ChoirController@index']);
Route::post('/submit-new-choir', 'ChoirController@put')->middleware('auth', 'is_parent','has_user');
Route::get('/edit-choir', 'ChoirController@get')->middleware('auth', 'is_parent','has_user');
Route::post('/submit-edit-choir', 'ChoirController@patch')->middleware('auth', 'is_parent','has_user');
Route::get('/delete-choir', 'ChoirController@delete')->middleware('auth', 'is_parent','has_user');
Route::get('/view-choirs', 'ChoirController@view')->middleware('auth', 'has_user');
Route::get('/submit-choir', 'ChoirController@submit')->middleware('auth', 'has_user');



#groceries routes
Route::get('/groceries', ['middleware'=>['auth','has_user'], 'uses'=>'GroceryController@index']);
Route::get('/groceries/create', ['middleware'=>['auth','has_user'], 'uses'=>'GroceryController@create']);
Route::post('/groceries', ['middleware'=>['auth','has_user'], 'uses'=>'GroceryController@store']);
Route::post('/groceries/done', ['middleware'=>['auth','has_user'], 'uses'=>'GroceryController@done']);
Route::post('/groceries/delete', ['middleware'=>['auth','has_user'], 'uses'=>'GroceryController@delete']);
Route::post('/groceries/filter', ['middleware'=>['auth','has_user'], 'uses'=>'GroceryController@filter']);

#polls routes
Route::get('/polls', ['middleware'=>['auth','has_user'], 'uses'=>'PollController@index']);
Route::get('/polls/create', ['middleware'=>['auth','has_user'], 'uses'=>'PollController@create']);
Route::post('/polls', ['middleware'=>['auth','has_user'], 'uses'=>'PollController@store']);
Route::post('/polls/vote', ['middleware'=>['auth','has_user'], 'uses'=>'PollController@vote']);
Route::post('/polls/done', ['middleware'=>['auth','has_user'], 'uses'=>'PollController@done']);

#admin
Route::get('/delete_user', ['middleware'=>['auth','has_user'], 'uses'=>'DeleteUserController@view']);
Route::post('/deleteuser', ['middleware'=>['auth','has_user'], 'uses'=>'DeleteUserController@delete']);
Route::post('/recoveruser',['middleware'=>['auth', 'has_user'], 'uses'=>'DeleteUserController@recover']);
Route::post('/deletefamily',['middleware'=>['auth', 'has_user'], 'uses'=>'DeleteUserController@deletefamily']);

Route::get('/stats', ['middleware'=>['auth','has_user'], 'uses'=>'StatsController@view']);
Route::post('/recoverpoll', ['middleware'=>['auth','has_user'], 'uses'=>'StatsController@recoverpoll']);
Route::post('/recoverchore', ['middleware'=>['auth','has_user'], 'uses'=>'StatsController@recoverchore']);
Route::post('/recovergrocery', ['middleware'=>['auth','has_user'], 'uses'=>'StatsController@recovergrocery']);
Route::post('/deletepoll', ['middleware'=>['auth','has_user'], 'uses'=>'StatsController@deletepoll']);
Route::post('/deletechore', ['middleware'=>['auth','has_user'], 'uses'=>'StatsController@deletechore']);
Route::post('/deletegrocery', ['middleware'=>['auth','has_user'], 'uses'=>'StatsController@deletegrocery']);



