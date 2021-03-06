<?php

namespace Api;

use Application\Application;
use Input;

class ApplicationController extends \ApiController {

    /**
     * @var \Application\Application
     */
    protected $apps;

    public function __construct(Application $apps)
    {
        $this->apps = $apps;
    }

	public function getIndex()
	{
        //prepare query object
        $locations = $this->apps->validForMap();

        /**
         * Mode using zipcity -> add filters to query before executing query
         */
        if(Input::has('mode') && Input::get('mode') === 'zipcity')
        {
            $zip = Input::get('near');

            //don't remove the space in delimiter
            if(is_numeric($zip))
            {
                $locations = $locations->where('ZipCode', '=', $zip);
            }
            else{ //this shouldn't be happening
                return array();
            }
        }

        if(Input::get('category') && Input::get('category') > 0)
        {
            $locations = $locations->whereHas('subcategory', function($q)
            {
                $q->where('id', Input::get('category'));
            });
        }

        $locations = $locations->get();

        /**
         * Mode using geolocation
         */
        if(Input::has('mode') && Input::get('mode') === 'geolocation')
        {

            $near = Input::get('near');

            /**
             * Only look for locations near us
             */
            if(is_array($near) && array_key_exists('latitude', $near) && array_key_exists('longitude', $near))
            {
                $locations = $this->onlyNearOnes($locations, $near);
            }

        }

        $boundsAndCenter = $locations->getBoundsAndCenter();

        $locations = $locations->toArray();

        return array_merge(compact('locations'), $boundsAndCenter);
	}

    public function getCityQuery()
    {
        $input = Input::get('query');

        if(!is_numeric($input))
        {
            //search for matching city names
            $locations = $this->apps
                ->validForMap()
                ->where('Village', 'like', $input . '%')
                ->distinct()
                ->orderBy('ZipCode')
                ->orderBy('Village')
                ->get(array('Village','ZipCode'));
        }
        else
        {
            //search for matching postcodes
            $locations = $this->apps
                ->validForMap()
                ->where('ZipCode', 'like', $input . '%')
                ->distinct()
                ->orderBy('ZipCode')
                ->orderBy('Village')
                ->get(array('Village', 'ZipCode'));
        }

        return $locations->toJson();
    }

    public function postDelete()
    {
        $ids = Input::get('ids');

        if(!empty($ids))
        {
            $apps = $this->apps->whereIn('id', $ids)->get();

            foreach($apps as $app)
            {
                $app->delete();
            }
        }

        return array('status' => 'oke');
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