<?php
/**
 * User: thomas
 * Date: 30/03/14
 * Time: 10:48
 */

namespace Import;


class Facade extends \Illuminate\Support\Facades\Facade{

    protected static function getFacadeAccessor()
    {
        return 'importer';
    }


} 