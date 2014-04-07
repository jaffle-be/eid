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

    switch(App::getLocale())
    {
        case 'nl':
            Route::get('algemene-voorwaarden', array('as' => 'disclaimer', 'uses' => 'HomeController@getDisclaimer'));
            Route::get('wedstrijd-reglement', array('as' => 'reglement', 'uses' => 'HomeController@getReglement'));
            break;
        case 'fr':
            Route::get('règlement-du-concours', array('as' => 'reglement', 'uses' => 'HomeController@getReglement'));
            Route::get('termes-et-conditions', array('as' => 'disclaimer', 'uses' => 'HomeController@getDisclaimer'));
            break;
    }


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

Route::get('admin/export', array('as' => 'admin.applications.export', 'uses' =>'Admin\\ApplicationController@export'));


/**
 * Api routes
 */

Route::group(array('prefix' => 'api'), function(){

    Route::get('application', 'Api\\ApplicationController@getIndex');

    Route::get('application/query-city', 'Api\\ApplicationController@getCityQuery');

    Route::post('application/delete', 'Api\\ApplicationController@postDelete');

});