<?php

namespace Application;

use Illuminate\Support\MessageBag;

class Application extends \Eloquent{

    protected $table = 'applications';

    /**
     * BASIC SETUP
     */

    /**
     * Do not include logo into toArray and into ToJson method
     * We should really try to remove this blob stuff!
     * @var array
     */
    protected $hidden = array('Logo');

    /**
     * Message bag for validation
     * @var MessageBag
     */
    protected $messages;

    protected $fillable = array(
        'OrganisationName', 'Description', 'Description_Translated', 'Street', 'NrAndBox', 'ZipCode', 'Village',
        'Email', 'Telephone', 'Website', 'Email', 'Latitude', 'Longitude', 'IsOnlineApplication',
        'FK_ApplicationArea', 'FK_ApplicationAreaRegion', 'LanguageCode', 'subcategory_id', 'FK_ApplicationStatus',
        'show_in_list', 'contact_firstname', 'contact_lastname', 'marketing_campaign_disclaimer', 'is_csv_import', 'csv_import_category'
    );

    /**
     * CUSTOMISATION
     */

    public static function boot()
    {
        static::observe(new Observer());
    }

    public function newCollection(array $models = array())
    {
        return new Collection($models);
    }

    public function setErrors(MessageBag $messages)
    {
        $this->errors = $messages;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * SCOPES
     */

    public function scopeApproved($query)
    {
        $query->whereHas('status', function($q){
            $q->where('Status', 'Approved');
        });
    }

    public function scopeFromCampaign($query)
    {
        $query->where('marketing_campaign_disclaimer', '1');
    }

    public function scopeValidForMap($query)
    {
        $query->where('IsOnlineApplication', 0)
            ->whereNotNull('Latitude')
            ->whereNotNull('Longitude')
            ->approved();
    }

    public function scopeOnline($query)
    {
        $query->where('IsOnlineApplication', 1);
    }

    public function scopeMainList($query)
    {
        $query->where('show_in_list', 1)
            ->approved();
    }

    public function scopeImported($query)
    {
        $query->where('is_csv_import', 1);
    }

    public function scopeHomepageList($query)
    {
        $query->where('show_in_list', 1);
    }

    /**
     * RELATIONS
     */

    public function subcategory()
    {
        return $this->belongsTo('Application\Category\Subcategory', 'subcategory_id');
    }

    public function city()
    {
        return $this->belongsToMany('Application\Location\City', 'applicationcities', 'application_id', 'city_id');
    }

    public function status()
    {
        return $this->belongsTo('Application\Status', 'FK_ApplicationStatus');
    }





    /**
     * Check if the application is within a specified distance
     * @param $latitude
     * @param $longitude
     * @param int $distance
     */
    public function closeEnough($latitude, $longitude, $distance = 10)
    {
        $difference = $this->distance($latitude, $longitude, $this->Latitude, $this->Longitude, 'K');

        return $difference <= $distance;
    }


    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    /*::                                                                         :*/
    /*::  This routine calculates the distance between two points (given the     :*/
    /*::  latitude/longitude of those points). It is being used to calculate     :*/
    /*::  the distance between two locations using GeoDataSource(TM) Products    :*/
    /*::                     													 :*/
    /*::  Definitions:                                                           :*/
    /*::    South latitudes are negative, east longitudes are positive           :*/
    /*::                                                                         :*/
    /*::  Passed to function:                                                    :*/
    /*::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  :*/
    /*::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  :*/
    /*::    unit = the unit you desire for results                               :*/
    /*::           where: 'M' is statute miles                                   :*/
    /*::                  'K' is kilometers (default)                            :*/
    /*::                  'N' is nautical miles                                  :*/
    /*::  Worldwide cities and other features databases with latitude longitude  :*/
    /*::  are available at http://www.geodatasource.com                          :*/
    /*::                                                                         :*/
    /*::  For enquiries, please contact sales@geodatasource.com                  :*/
    /*::                                                                         :*/
    /*::  Official Web site: http://www.geodatasource.com                        :*/
    /*::                                                                         :*/
    /*::         GeoDataSource.com (C) All Rights Reserved 2014		   		     :*/
    /*::                                                                         :*/
    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    protected function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }




} 