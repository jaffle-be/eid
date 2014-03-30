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
 * LOCALE SETTERS
 */


$locales = array('nl', 'fr');

$locale = Request::segment(1);

if(in_array($locale, $locales))
{
    \App::setLocale($locale);
} else
{
    /**
     * default to nl locale
     * this will also be the locale for the admin section
     */
    \App::setLocale('nl');

    $locale = null;
}


/**
 * Filters
 */

Route::when('admin/*', 'admin');


/**
 * FRONTEND ROUTES
 * These routes are prefixed with the locale
 */
Route::group(array('prefix' => $locale), function()
{

    Route::get('', array('as' => 'home', 'uses' => 'HomeController@getHome'));

    /**
     * the routes for our sign-up form for our campaign
     */
    Route::get('sign-up', array('as' => 'sign-up', 'uses' => 'HomeController@getCampaign'));

    Route::post('sign-up', array('as' => 'sign-up.submit', 'uses' => 'HomeController@postCampaign'));

    Route::get('disclaimer', array('as' => 'disclaimer', 'uses' => 'HomeController@getDisclaimer'));

    /**
     * the regular routes for our sign-up form
     */

//    Route::get('sign-up', array('as' => 'sign-up', 'uses' => 'HomeController@getSignup'));

//    Route::post('sign-up', 'HomeController@postSignup');

    Route::post('/auth/login', array('as' => 'login', 'uses' => 'HomeController@postLogin'));

    Route::get('/auth/logout', array('as' => 'logout', 'uses' => 'HomeController@getLogout'));

});

/**
 * BACKEND ROUTES
 */
Route::resource('admin/applications', 'Admin\\ApplicationController');

Route::get('admin/import', 'Admin\\ImportController@import');


/**
 * Api routes
 */

Route::group(array('prefix' => 'api'), function(){

    Route::get('application', 'Api\\ApplicationController@getIndex');

    Route::get('application/query-city', 'Api\\ApplicationController@getCityQuery');

    Route::post('application/delete', 'Api\\ApplicationController@postDelete');

});