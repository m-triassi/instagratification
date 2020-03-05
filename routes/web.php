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


Route::middleware(["auth"])->group(function () {

    Route::get('/', 'PagesController@index')->name('index');
    // Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/post/{postID}', 'PostsController@show')->name('post.show');
    Route::get('/user/{id}', 'UserController@show')->name('user.show');
    Route::get('/search/{user}', 'UserController@searchUser')->name('user.searchUser');
    Route::get('/comments/{postID}', 'CommentsController@refresh')->name('comments.refresh');

    Route::post('/post/like', 'PostsController@like')->name('post.like');
    Route::post('/post/create', 'PostsController@create')->name('post.create');
    Route::post('/comment/create', 'CommentsController@create')->name('comment.create');
    Route::post('/user/follow', 'UserController@follow')->name('user.follow');
    Route::post('/user/unfollow', 'UserController@unfollow')->name('user.unfollow');
    Route::post('/comment/destroy', 'CommentsController@destroy')->name('comment.destroy');
});
