<?php

namespace Admin;

use Application\Application;
use Application\Category\Category;
use Application\Location\Area;
use Application\Location\Region;
use View;
use Input;
use Redirect;

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

    public function __construct(Application $apps, Category $categories, Area $areas, Region $regions)
    {
        $this->apps = $apps;

        $this->categories= $categories;

        $this->areas = $areas;

        $this->regions = $regions;
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$apps = $this->apps;

        if(Input::get('name'))
        {
            $apps = $apps->where('OrganisationName', 'like', Input::get('name') . '%');
        }

        $apps = $apps->paginate();

        $this->layout->content = View::make('admin/applications/index', compact('apps'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $application = new Application;

        $categories = $this->getCategoryOptions();

        $regions = $this->getRegionOptions();

		$this->layout->content = View::make('admin/applications/create', compact('application', 'categories', 'regions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $application = $this->apps->create(Input::except('_token'));

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

        $categories = $this->getCategoryOptions();

        $regions = $this->getRegionOptions();

		$this->layout->content = View::make('admin.applications.edit', compact('application', 'categories', 'regions'));
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

        $application->update(Input::except('_token'));

        return Redirect::back();

//        $application->save();
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

        return array_merge($select, $options);
    }

    protected function getRegionOptions()
    {
        return array_merge(array('' => 'Selecteer een provincie'), $this->regions->orderBy('Region_NL')->get()->lists('Region_NL', 'id'));
    }

}