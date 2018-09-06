<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

Route::get('/', 'PagesController@root')->name('root');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
Route::match(['get', 'post'], 'users/{user}/verify', 'UsersController@verify')->name('users.verify');
Route::get('users/{user}/topics', 'UsersController@topics')->name('users.topics');
Route::get('users/{user}/replies', 'UsersController@replies')->name('users.replies');

Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

// 话题
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

// 回复
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

// 消息
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

// 视频系列
Route::get('series', 'SeriesController@index')->name('series.index');
Route::get('series/{series}', 'SeriesController@show')->name('series.show');

// 视频
Route::get('videos/{video}', 'VideosController@show')->name('videos.show');

// 公告
Route::resource('notices', 'NoticesController', ['only' => ['create', 'store', 'show']]);
Route::post('notices/upload_image', 'NoticesController@uploadImage')->name('notices.upload_image');
