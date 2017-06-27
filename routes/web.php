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

Route::get('/', 'PagesController@index')->name('home');

Route::get('/aboutus', 'PagesController@aboutus')->name('aboutus');

Route::get('/contact', 'PagesController@contact')->name('contact');

Route::resource('expenses', 'ExpensesController', ['except' => ['show']]);

Route::resource('groups', 'GroupsController', ['except' => ['show']]);

Auth::routes();

Route::get('/password/change', 'Auth\ChangePasswordController@showChangePasswordForm')->name('password.change');

Route::post('/password/change', 'Auth\ChangePasswordController@change');

Route::get('/user/{user}/edit', 'Auth\ManageProfileController@showManageProfileForm')->name('user.edit');

Route::put('/user/{user}', 'Auth\ManageProfileController@update')->name('user.update');