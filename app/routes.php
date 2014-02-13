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


/**
 * Filters
 */

Route::when('admin/*', 'admin');


/**
 * Routes
 */

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getHome'));

Route::post('/auth/login', array('as' => 'login', 'uses' => 'HomeController@postLogin'));

Route::get('/auth/logout', array('as' => 'logout', 'uses' => 'HomeController@getLogout'));

Route::resource('admin/applications', 'Admin\\ApplicationController');



/**
 * Api routes
 */

Route::group(array('prefix' => 'api'), function(){

    Route::get('application', 'Api\\ApplicationController@getIndex');
    Route::get('application/query-city', 'Api\\ApplicationController@getCityQuery');

});