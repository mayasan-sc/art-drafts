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

Route::get('/login/github', 'Auth\LoginController@redirectToProvider');
Route::get('/login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'PostsController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/top', 'PostsController@top')->name('top');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/create', 'PostsController@create')->name('create');
    Route::post('/store', 'PostsController@store')->name('store');
    
    Route::get('/mypage', 'PostsController@mypage',[\Auth::user()])->name('mypage');
    Route::get('/edit_mypage', 'PostsController@edit_mypage',[\Auth::user()])->name('edit_mypage');
    Route::post('/update_user', 'PostsController@update_user',[\Auth::user()])->name('update_user');

    Route::post('/like', 'LikesController@like')->name('like');
    Route::get('/like_users', 'LikesController@like_users')->name('like_users');

    Route::get('/edit', 'PostsController@edit')->name('edit');
    Route::post('/update', 'PostsController@update')->name('update');

    Route::get('/delete', 'PostsController@delete')->name('delete');
 });