<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home.index', 'uses' => 'HomeController@index'));

Route::get('/sso', array('as' => 'sso.login', 'uses' => 'SsoController@login'));

Route::get('/profile', array('as' => 'user.profile', 'uses' => 'UserController@profile' , 'before' => 'auth'));

Route::get('/sso/logout', array('as' => 'sso.logout', 'uses' => 'SsoController@logout'));
