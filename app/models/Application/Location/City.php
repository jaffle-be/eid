<?php

namespace Application\Location;


class City extends \Eloquent{

    public $timestamps = false;

    protected $table = 'city';

    protected $primaryKey = 'city_id';

}