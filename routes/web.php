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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'PostController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');

Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('login/google', 'Auth\LoginController@Provider');

Route::get('login/google/callback', 'Auth\LoginController@Callback');

Route::get('login/twitter', 'Auth\LoginController@twitterProvider');

Route::get('login/twitter/callback', 'Auth\LoginController@twitterCallback');

//resource routes

Route::resource('roles','RoleController');

Route::resource('users','UserController');

Route::resource('posts','PostController');

Route::resource('permissions','PermissionController');