<?php

namespace Application\Category;


class Subcategory extends \Eloquent{

    public $timestamps = false;

    protected $table = 'subcategory';

    public function category()
    {
        return $this->belongsTo('Application\Category\Category', 'category_id');
    }

    public function applications()
    {
        return $this->hasMany('Application\Application', 'subcategory_id');
    }
}