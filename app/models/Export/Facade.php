<?php
/**
 * User: thomas
 * Date: 31/03/14
 * Time: 20:03
 */

namespace Export;


class Facade extends \Illuminate\Support\Facades\Facade{

    protected static function getFacadeAccessor()
    {
        return 'export';
    }


} 