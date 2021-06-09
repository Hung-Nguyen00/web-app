<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
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
Auth::routes();

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/read/{id}', 'PostUserController@store')->name('read');

// post
Route::resource('posts', 'PostController');
Route::get('/latestPost', 'PostUserController@index')->name('posts.latest');
Route::get('/search/', 'PostController@search')->name('posts.search');

//category
Route::resource('category', 'CategoryController')->only([
    'show'
    ]
);

// User
Route::get('/user/{id}', 'PostUserController@show')->name('user.ownPosts');
Route::get('/user/{id}', 'PostUserController@show')->name('user.ownPosts');
Route::get('/user/{user}/vouchers', 'UserController@showVouchers')->name('user.ownVouchers');
Route::delete('/user/{id}', 'PostUserController@destroy')->name('user.destroy');
// admin
Route::group(['prefix' => 'Admin','middleware' => ['CheckPermission']], function (){
        Route::get('', function ()
        {
            return view('admin.layout.app');
        })->name('admin.index');
        Route::resources([
            'vouchers' => 'Base\VoucherController',
            'users'    => 'Base\UserController',
            'roles'     => 'Base\RoleController',
        ]);
        Route::get('/export', 'Base\UserController@export')->name('users.export');
        Route::post('/export', 'Base\UserController@import')->name('users.import');

        Route::resource('posts', 'Base\PostController')->except([
            'show', 'index'
        ]);
        Route::resource('category', 'Base\CategoryController')->except([
           'show'
        ]);
        Route::resource('permissions', 'Base\PermissionRoleController');
});



