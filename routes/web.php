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

Auth::routes();
Route::any('/', 'Controller@index')->name('home');
Route::prefix('posts')->group(function () {
    Route::get('/{category_id?}', 'PostController@index')->where('category_id', '[0-9]+')->name('posts.index');
    Route::get('/{category_id}/{id}', 'PostController@show')->where('category_id', '[0-9]+')->name('posts.show');
    Route::get('/create/{category_id?}', 'PostController@create')->middleware('auth')->name('posts.create');
    Route::post('/save', 'PostController@save')->middleware('auth')->name('posts.save');
    Route::post('/update', 'PostController@update')->middleware('auth')->name('posts.update');
});

Route::prefix('users')->group(function () {
    Route::get('/profile', 'UserController@profile')->middleware('auth')->name('users.profile');
    Route::get('/member/{id}', 'UserController@member')->name('users.member');
    Route::post('/', 'UserController@update')->middleware('auth')->name('users.update');
});
