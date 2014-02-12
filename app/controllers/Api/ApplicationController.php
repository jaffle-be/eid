<?php

namespace Api;

use Application\Application;
use Input;

class ApplicationController extends \BaseController {

    /**
     * @var \Application\Application
     */
    protected $apps;

    public function __construct(Application $apps)
    {
        $this->apps = $apps;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$locations = $this->apps->online()->get();

        if(Input::has('near'))
        {
            $near = Input::get('near');

            /**
             * Only look for locations near us
             */
            if(is_array($near) && array_key_exists('latitude', $near) && array_key_exists('longitude', $near))
            {
                $locations = $this->onlyNearOnes($locations, $near);
            }
            /**
             * If we provided a zipcode look for applications with that zipcode
             */
            else if(is_int($near))
            {
                echo 'postcode';
            }
        }

        $boundsAndCenter = $locations->getBoundsAndCenter();

        $locations = $locations->toArray();

        return array_merge(compact('locations'), $boundsAndCenter);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

    protected function onlyNearOnes($locations, $near)
    {
        $latitude = $near['latitude'];
        $longitude = $near['longitude'];

        return $locations->filter(function($app) use ($latitude, $longitude)
        {
            if($app->closeEnough($latitude, $longitude))
            {
                return $app;
            }
        });

    }

}