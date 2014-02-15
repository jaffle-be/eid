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
        $locations = $this->apps->online();

        /**
         * Mode using zipcity -> add filters to query before executing query
         */
        if(Input::get('mode') === 'zipcity')
        {
            $zip = Input::get('near');

            //don't remove the space in delimiter
            if(is_numeric($zip))
            {
                $locations->where('ZipCode', '=', $zip);
            }
            else{ //this shouldn't be happening
                return array();
            }
        }

        $locations = $locations->get();

        /**
         * Mode using geolocation
         */
        if(Input::get('mode') === 'geolocation')
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
            $locations = $this->apps->where('Village', 'like', $input . '%')
                ->distinct()
                ->orderBy('ZipCode')
                ->orderBy('Village')
                ->get(array('Village','ZipCode'));
        }
        else
        {
            //search for matching postcodes
            $locations = $this->apps->where('ZipCode', 'like', $input . '%')
                ->distinct()
                ->orderBy('ZipCode')
                ->orderBy('Village')
                ->get(array('Village', 'ZipCode'));
        }

        return $locations->toJson();
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