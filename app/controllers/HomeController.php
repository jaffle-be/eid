<?php

use Application\Application;
use Application\Location\Region;
use Application\Location\Area;
use Application\Category\Category ;

class HomeController extends BaseController {

    /**
     * @var Application\Application
     */
    protected $app;

    public function __construct(Application $application, Category $categories, Area $areas, Region $regions)
    {
        $this->app = $application;

        $this->categories= $categories;

        $this->areas = $areas;

        $this->regions = $regions;
    }

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
        $categories = $this->getCategoriesForMapFilter();

        $applications = $this->app->mainList()->get();

        $this->layout->content = View::make('home', compact('categories', 'applications'));
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

    public function getSignUp()
    {
        $application = new $this->app;

        extract($this->getOptions());

        $this->layout->content = View::make('sign-up', compact('application', 'categories', 'provincies', 'regions'));
    }

    public function postSignup()
    {
        $application = $this->app->create(Input::except('_token'));

        if(count($application->getErrors()))
        {
            return Redirect::back()->withInput()->withErrors($application->getErrors())->with('message', Lang::get('general.form-failure'));
        }

        return Redirect::route('home')->with('message', true);
    }

    protected function getCategoriesForMapFilter()
    {
        $select = array('' => Lang::get('signup.select_category'));

        $categories = $this->categories->with(array(
            'subcategories' => function($q)
                {
                    $q->whereHas('applications', function($q){
                        $q->validForMap();
                    })->orderBy(App::getLocale() == 'nl' ? 'CategoryDutch' : 'CategoryFrench');;
                }
        ))->orderBy(App::getLocale() == 'nl' ? 'CategoryDutch' : 'CategoryFrench')->get();

        $options = array();

        foreach($categories as $category)
        {
            $options[App::getLocale() == 'nl' ? $category->CategoryDutch : $category->CategoryFrench ] = $category->subcategories->lists(App::getLocale() == 'nl' ? 'CategoryDutch' : 'CategoryFrench', 'id');
        }

        return $select + $options;
    }

    protected function getOptions()
    {
        $categories = $this->getCategoryOptions();

        $provincies = $this->getRegionOptions();

        $regions = $this->getAreaOptions();

        return compact('categories', 'provincies', 'regions');
    }

    protected function getCategoryOptions()
    {
        $select = array('' => Lang::get('signup.select_category'));

        $categories = $this->categories->with(array(
            'subcategories' => function($query)
                {
                    $query->orderBy(App::getLocale() == 'nl' ? 'CategoryDutch' : 'CategoryFrench');
                }
        ))->orderBy(App::getLocale() == 'nl' ? 'CategoryDutch' : 'CategoryFrench')->get();

        $options = array();

        foreach($categories as $category)
        {
            $options[App::getLocale() == 'nl' ? $category->CategoryDutch : $category->CategoryFrench ] = $category->subcategories->lists(App::getLocale() == 'nl' ? 'CategoryDutch' : 'CategoryFrench', 'id');
        }

        return $select + $options;
    }

    protected function getRegionOptions()
    {
        return array('' => Lang::get('signup.select_province')) + $this->regions->orderBy('sort')->get()->lists(App::getLocale() == 'nl' ? 'Region_NL' : 'Region_FR', 'id');
    }

    protected function getAreaOptions()
    {
        return array('' => Lang::get('signup.select_region')) + $this->areas->orderBy('ApplicationArea_NL')->get()->lists(App::getLocale() == 'nl' ? 'ApplicationArea_NL' : 'ApplicationArea_FR', 'id');
    }

}