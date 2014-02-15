<?php

namespace Application\Category;


class Category extends \Eloquent{

    public $timestamps = false;

    protected $table = 'categories';

    public function subcategories()
    {
        return $this->hasMany('Application\Category\Subcategory', 'category_id');
    }

}