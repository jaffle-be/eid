<?php

namespace Application;

class Application extends \Eloquent{

    protected $table = 'applications';

    /**
     * Do not include logo into toArray and into ToJson method
     * We should really try to remove this blob stuff!
     * @var array
     */
    protected $hidden = array('Logo');

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