<?php

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/profile', 'ProfileController@edit')->name('profile');
Route::put('/profile_update/{id?}', 'ProfileController@update')->name('profile_update');

Route::group(['prefix' => '/' ,'middleware' => ['auth','gender']], function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/posts/create', 'PostController@create')->name('posts_create');
    Route::post('/posts/store', 'PostController@store')->name('posts_store');
    Route::put('/posts/update/{id}', 'PostController@update');
    Route::get('/posts/show/{id}', 'PostController@show')->name('posts_show');
    Route::post('/comments/store', 'CommentController@store');
    Route::delete('/posts/delete/{id}', 'PostController@destroy');


});

Route::get('facebook', function () {
    return view('facebook');
});
Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');