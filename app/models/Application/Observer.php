<?php

namespace Application;

use Validator;
use Input;

class Observer {

    protected static $rules = array(
        'OrganisationName' => 'required',
        'Email' => 'email',
        'Website' => 'url',
        'IsOnlineApplication' => 'in:0,1',
        'subcategory_id' => 'exists:subcategory,id',
        'FK_ApplicationStatus' => 'exists:applicationstatus,ID',
        'FK_ApplicationArea' => 'exists:applicationarea,id',
        'FK_ApplicationAreaRegion' => 'exists:applicationarearegion,id'
    );

    public function saving($m)
    {
        $this->verifyLink($m);

        $validator = $this->validator($m);

        if(!is_numeric($m->FK_ApplicationAreaRegion))
        {
            $m->FK_ApplicationAreaRegion = null;
        }

        if(!is_numeric($m->FK_ApplicationArea))
        {
            $m->FK_ApplicationArea = null;
        }

        if(empty($m->FK_ApplicationStatus))
        {
            $m->FK_ApplicationStatus = 0;
        }

        if($validator->fails())
        {
            $m->setErrors($validator->messages());

            return false;
        }
    }

    public function updating($m)
    {

    }

    public function creating($m)
    {

    }

    protected function validator($m)
    {
        return Validator::make($m->toArray(), static::$rules);
    }

    /**
     * Auto prefix the provided url with 'http://'
     * @param $m
     */
    protected function verifyLink($m)
    {
        if(!empty($m->Website) && !preg_match('#^http://#',$m->Website))
        {
            $m->Website = 'http://' . $m->Website;
        }
    }

} 