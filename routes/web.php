<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\ProductController;
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
    return redirect()->route('posts.index');
});


Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/read/{id}', 'PostUserController@store')->name('read');

Auth::routes();
//voucher
Route::resource('vouchers', 'VoucherController')->only([
    'store'
]);

// post
Route::resource('posts', 'PostController')->except([
    'show', 'index'
]);
Route::get('/latestPost', 'PostUserController@index')->name('posts.latest');
// category
// User
Route::get('posts/search', 'PostController@search')->name('posts.search');

Route::get('/users/{id}', 'PostUserController@show')->name('user.ownPosts');
Route::get('/users/{id}', 'PostUserController@show')->name('user.ownPosts');
Route::get('/users/{user}/vouchers', 'UserController@showVouchers')->name('user.ownVouchers');
Route::delete('/users/{id}', 'PostUserController@destroy')->name('user.destroy');
// admin
Route::group(['middleware' => ['admin']], function (){

    Route::prefix('Admin')->group(function () {
        Route::get('', function (){
            return view('admin.layout.app');
        })->name('admin.index');
        Route::resource('category', 'CategoryController')->except([
            'show',
        ]);
        Route::resource('vouchers', 'VoucherController')->except([
            'store'
        ]);

        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
        Route::put('/users/{user}', 'UserController@edit')->name('users.update');

    });

});
Route::resource('category', 'CategoryController')->only([
    'show',
]);

Route::resource('posts', 'PostController')->only([
    'show', 'index'
]);
