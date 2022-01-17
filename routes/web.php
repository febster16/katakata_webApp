<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/search/{id?}', 'HomeController@search')->name('home.search');
Route::get('/post/{post}', 'HomeController@post_detail')->name('post');
Route::get('/create_post', 'HomeController@create_post')->name('user.create_post')->middleware('auth');
Route::post('/store_post', 'HomeController@store_post')->name('user.store_post')->middleware('auth');
Route::get('/my_post', 'HomeController@my_post')->name('user.my_post')->middleware('auth');
Route::get('/my_post/{id}/edit', 'HomeController@my_post_edit')->name('user.my_post.edit')->middleware('auth');
Route::post('/update_post/{id}', 'HomeController@my_post_update')->name('user.update_post')->middleware('auth');
Route::delete('/my_post/{id}/destroy', 'HomeController@my_post_destroy')->name('user.mypost.destroy');
Route::post('add_comment','HomeController@add_comment')->name('post.addcomment')->middleware('auth');

Route::get('user/logout','HomeController@logout')->name('user.logout');
Route::get('user/profile','HomeController@profile')->name('user.profile');
Route::post('user/profile','HomeController@update_profile')->name('user.update.profile');

Route::prefix('admin','admin/home')->group(function(){


    Route::auth();
    Route::get('/', 'AdminsController@index')->name('admin.index');
    Route::get('/dashboard', 'AdminsController@index')->name('admin.dashboard');
    Route::get('/posts', 'PostController@index')->name('post.index');
    Route::get('/posts/create', 'PostController@create')->name('post.create');
    Route::post('/posts', 'PostController@store')->name('post.store');
    Route::delete('/posts/{post}/destroy', 'PostController@destroy')->name('post.destroy');
    Route::patch('/posts/{post}/update', 'PostController@update')->name('post.update');
    Route::get('/posts/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::post('posts/assign', 'PostController@assign')->name('post.assign');
    Route::post('posts/unassign', 'PostController@unassign')->name('post.unassign');

    Route::put('/users/{user}/update', 'UserController@update')->name('user.profile.update');

    Route::delete('/users/{user}/destroy', 'UserController@destroy')->name('user.destroy');

    //Route::middleware(['role:admin','auth'])->group(function(){

        
        Route::get('users', 'UserController@index')->name('user.index');
        Route::get('users/create', 'UserController@create')->name('user.create');
        Route::post('users', 'UserController@store')->name('user.store');
        Route::delete('users/{id}/destroy', 'UserController@destroy')->name('user.destroy');
        Route::patch('users/{id}/update', 'UserController@update')->name('user.update');
        Route::get('users/{id}/edit', 'UserController@edit')->name('user.edit');


        Route::get('category', 'CategoryController@index')->name('category.index');
        Route::get('category/create', 'CategoryController@create')->name('category.create');
        Route::post('category', 'CategoryController@store')->name('category.store');
        Route::delete('category/{id}/destroy', 'CategoryController@destroy')->name('category.destroy');
        Route::patch('category/{id}/update', 'CategoryController@update')->name('category.update');
        Route::get('category/{id}/edit', 'CategoryController@edit')->name('category.edit');
        Route::post('category/assign', 'CategoryController@assign')->name('category.assign');
        Route::post('category/unassign', 'CategoryController@unassign')->name('category.unassign');


        Route::get('comment/pending', 'CommentController@pending_comment')->name('pending.comment');
        Route::get('comment/approved', 'CommentController@approved_comment')->name('approved.comment');
        Route::get('comment/{id}/edit', 'CommentController@edit')->name('comment.edit');
        Route::patch('comment/{id}/update', 'CommentController@update')->name('comment.update');
        Route::delete('comment/{id}/destroy', 'CommentController@destroy')->name('comment.destroy');
        Route::get('comment/status/{status}/{id}', 'CommentController@status')->name('comment.status');
    // });

    Route::middleware(['can:view,user'])->group(function(){
        Route::get('users/{user}/profile', 'UserController@show')->name('user.profile.show');
    });

    Auth::routes();

});





