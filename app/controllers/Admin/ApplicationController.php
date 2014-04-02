<?php

namespace Admin;

use Application\Application;
Use Application\Status;
use Application\Category\Category;
use Application\Location\Area;
use Application\Location\Region;
use View;
use Response;
use Input;
use Redirect;
use Session;
use Export;

class ApplicationController extends \BaseController {

    /**
     * @var \Application\Application
     */
    protected $apps;

    /**
     * @var \Application\Category\Subcategory
     */
    protected $subcategory;

    /**
     * @var \Application\Location\Area
     */
    protected $areas;

    /**
     * @var \Application\Location\Region
     */
    protected $regions;


    protected $status;

    public function __construct(Application $apps, Category $categories, Area $areas, Region $regions, Status $status)
    {
        $this->apps = $apps;

        $this->categories= $categories;

        $this->areas = $areas;

        $this->regions = $regions;

        $this->status = $status;
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $apps = $this->results()->paginate();

        $filters = \Request::query();

        unset($filters['page']);

        $apps->appends($filters);

        $this->layout->content = View::make('admin/applications/index', compact('apps'));
	}

    /**
     * Export our applications using the same filtersets as our index page
     */
    public function export()
    {
        $headers = array(
            'naam organisatie' => 'OrganisationName',
            'straat' => 'Street',
            'huisnummer' => 'NrAndBox',
            'postcode' => 'ZipCode',
            'woonplaats' => 'Village',
            'email' => 'Email',
            'telefoon' => 'Telephone',
            'website' => 'Website',
            'contact voornaam' => 'contact_firstname',
            'contact achternaam' => 'contact_lastname',
            'omschrijving' => 'Description',
            'omschrijving (frans)' => 'Description_Translated',
            'wedstrijd' => 'disclaimer',
            'aangemaakt' => 'created_at',
        );

        $apps = $this->results()->get(array_values($headers));

        $file = Export::go($apps, array_keys($headers));

        return Response::download($file);
    }

    protected function results()
    {
        $apps = $this->apps;

        if(Input::get('name'))
        {
            $apps = $apps->where('OrganisationName', 'like', Input::get('name') . '%');
        }

        if(Input::get('validForMap') != '1')
        {
            $apps = $apps->validForMap();
        }

        if(Input::get('disclaimer') == 1)
        {
            $apps = $apps->fromCampaign();
        }

        return $apps->orderBy('created_at', 'desc');
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $application = new Application;

        extract($this->getOptions());

        if(Session::has('errors'))
        {
            $errors = Session::get('errors');
        }
        else
        {
            $errors = array();
        }

		$this->layout->content = View::make('admin/applications/create', compact($this->getViewVariableNames()));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $application = $this->apps->create(Input::except('_token'));

        if(count($application->getErrors()))
        {
            return Redirect::back()->withInput()->withErrors($application->getErrors());
        }

        return Redirect::route('admin.applications.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $application = $this->apps->find($id);

        extract($this->getOptions());

        if(Session::has('errors'))
        {
            $errors = Session::get('errors');
        }
        else
        {
            $errors = array();
        }

		$this->layout->content = View::make('admin.applications.edit', compact($this->getViewVariableNames()));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$application = $this->apps->find($id);

        $input = Input::except('_token');

        if(!Input::has('IsOnlineApplication'))
        {
            $input['IsOnlineApplication'] = 0;
        }

        if(!input::has('show_in_list'))
        {
            $input['show_in_list'] = 0;
        }

        if($application->update($input))
        {
            return Redirect::back();
        }
        else
        {
            return Redirect::back()->with('errors', $application->getErrors())->withInput();
        }



	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    protected function getViewVariableNames()
    {
        return array('application', 'categories', 'provincies', 'regions', 'status', 'errors');
    }

    protected function getOptions()
    {
        $categories = $this->getCategoryOptions();

        $provincies = $this->getRegionOptions();

        $regions = $this->getAreaOptions();

        $status = $this->getStatusOptions();

        return compact('categories', 'provincies', 'regions', 'status');
    }

    protected function getCategoryOptions()
    {
        $select = array('' => 'Selecteer een categorie');

        $categories = $this->categories->with(array(
            'subcategories' => function($query)
                {
                    $query->orderBy('CategoryDutch');
                }
        ))->orderBy('CategoryDutch')->get();

        $options = array();

        foreach($categories as $category)
        {
            $options[$category->CategoryDutch] = $category->subcategories->lists('CategoryDutch', 'id');
        }

        return $select + $options;
    }

    protected function getRegionOptions()
    {
        return array('' => 'Selecteer een provincie') + $this->regions->orderBy('sort')->get()->lists('Region_NL', 'id');
    }

    protected function getAreaOptions()
    {
        return array('' => 'Selecteer een regio') + $this->areas->orderBy('ApplicationArea_NL')->get()->lists('ApplicationArea_NL', 'id');
    }

    protected function getStatusOptions()
    {
        return $this->status->all()->lists('Status', 'ID');
    }

}