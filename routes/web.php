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

Route::get('/', 'PagesController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post/{postID}', 'PostsController@show')->name('post.show');

Route::post('/post/like', 'PostsController@like')->name('post.like');
Route::post('/comment/create', 'CommentsController@create')->name('comment.create');
