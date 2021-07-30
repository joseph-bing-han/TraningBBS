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
Route::prefix('posts')->middleware('web')->group(function () {
    Route::get('/{category_id?}', 'PostController@index')->name('posts.index');
    Route::get('/{category_id}/{id}', 'PostController@show')->name('posts.show');
});
