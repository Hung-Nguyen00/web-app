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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/read/{id}', 'PostUserController@store')->name('read');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


Route::group(['middleware' => ['auth']], function (){
    Route::get('/send-email', 'EmailController@index')->name('email.index');

    // post
    Route::resource('posts', 'PostController')->except([
       'show', 'index'
    ]);
    Route::get('/latestPost', 'PostUserController@index')->name('posts.latest');
    // category
    Route::resource('category', 'CategoryController')->except([
        'show',
    ]);
    // User
    Route::get('/users/{id}', 'PostUserController@show')->name('user.ownPosts');
    Route::get('/users/{id}', 'PostUserController@show')->name('user.ownPosts');
    Route::delete('/users/{id}', 'PostUserController@destroy')->name('user.destroy');
    // admin
    Route::group(['middleware' => ['admin']], function (){
        Route::get('/users', 'UserController@index')->name('user.index');
    });

});
Route::resource('category', 'CategoryController')->only([
    'show',
]);

Route::resource('posts', 'PostController')->only([
    'show', 'index'
]);
