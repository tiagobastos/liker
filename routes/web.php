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

Route::get('/home', 'HomeController@index');

Route::name('posts.index')->get('/posts', 'PostController@index');
Route::name('posts.store')->post('/posts', 'PostController@store');

Route::name('posts.like')->post('/posts/{post}/like', 'PostLikeController@store');
