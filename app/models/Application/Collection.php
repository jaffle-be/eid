<?php

namespace Application;

class Collection extends \Illuminate\Database\Eloquent\Collection{
    
    protected $calculations = array();

    public function getBoundsAndCenter()
    {
        $minLat = $this->minLatitude();
        $maxLat = $this->maxLatitude();

        $minLong = $this->minLongitude();
        $maxLong = $this->maxLongitude();

        return array(
            'center' => array(
                'latitude' => ($minLat + $maxLat) / 2,
                'longitude' => ($minLong + $maxLong) / 2
            ),
            'bounds' => array(
                'minLat' => $minLat,
                'maxLat' => $maxLat,
                'minLong' => $minLong,
                'maxLong' => $maxLong
            )
        );
    }
    
    public function minLatitude()
    {
        return $this->min('Latitude');
    }

    public function maxLatitude()
    {
        return $this->max('Latitude');
    }
    
    public function minLongitude()
    {
        return $this->min('Longitude');
    }

    public function maxLongitude()
    {
        return $this->max('Longitude');
    }
    


} 