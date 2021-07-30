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
    Route::get('/{category_id}/{id}', 'PostController@show')->where('category_id', '[0-9]+')->name('posts.show');
    Route::get('/create/{category_id?}', 'PostController@create')->middleware('auth')->name('posts.create');
    Route::post('/save', 'PostController@save')->middleware('auth')->name('posts.save');
    Route::post('/update', 'PostController@update')->middleware('auth')->name('posts.update');
});
