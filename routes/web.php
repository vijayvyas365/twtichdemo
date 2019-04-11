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
//
//Route::get('/', function () {
//    return Redirect::route('user.dashboard');
//});

Route::get('/', function () {
    return Redirect::route('user.index');
});

Route::get('login', array('as' => 'login', 'uses' => 'Auth\LoginController@login'));
Route::get('logout', array('as' => 'auth.logout', 'uses' => 'Auth\LoginController@logout'));
Route::get('authenticate', array("as" => "auth.handleLogin", "uses" => 'Auth\LoginController@handleLogin'));


