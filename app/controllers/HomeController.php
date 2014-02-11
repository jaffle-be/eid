<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getHome()
    {
        $this->layout->content = View::make('home');
    }

    public function postLogin()
    {
        $credentials = Input::all();

        Auth::attempt($credentials);

        if(Auth::user())
        {
            return Redirect::route('admin.applications.index');
        }

        else{
            return Redirect::route('home');
        }

    }

    public function getLogout()
    {
        Auth::logout();

        return Redirect::route('home');
    }

}