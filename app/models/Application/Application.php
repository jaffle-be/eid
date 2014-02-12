<?php

namespace Application;

class Application extends \Eloquent{

    protected $table = 'applications';

    public $incrementing = false;

    public function newCollection(array $models = array())
    {
        return new Collection($models);
    }


    public function subcategory()
    {
        return $this->belongsTo('Application\Category\Subcategory', 'subcategory_id');
    }

} 