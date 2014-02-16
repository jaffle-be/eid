<?php

namespace Application;

use Validator;

class Observer {

    protected static $rules = array(
        'OrganisationName' => 'required',
        'Email' => 'email',
        'Website' => 'url',
        'IsOnlineApplication' => 'in:0,1',
        'subcategory_id' => 'required|exists:subcategory,id',
        'LanguageCode' => 'required',
        'FK_ApplicationStatus' => 'required|exists:applicationstatus,ID',
        'FK_ApplicationAreaRegion' => 'exists:applicationarearegion,id'
    );

    public function updating($m)
    {

        if(!is_numeric($m->FK_ApplicationAreaRegion))
        {
            $m->FK_ApplicationAreaRegion = null;
        }

        if(!is_numeric($m->FK_ApplicationArea))
        {
            $m->FK_ApplicationArea = null;
        }

        $validator = $this->validator($m);

        if($validator->fails())
        {
            $m->setErrors($validator->messages());

            return false;
        }

    }

    public function creating($m)
    {
        $validator = $this->validator($m);

        if($validator->fails())
        {
            $m->setErrors($validator->messages());

            return false;
        }
    }

    protected function validator($m)
    {
        return Validator::make($m->toArray(), static::$rules);


    }

} 