<?php

namespace Application;

class Application extends \Eloquent{

    protected $table = 'applications';

    public $incrementing = false;


    public function subcategory()
    {
        return $this->belongsTo('Application\Category\Subcategory', 'subcategory_id');
    }

} 