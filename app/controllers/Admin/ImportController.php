<?php
/**
 * User: thomas
 * Date: 30/03/14
 * Time: 10:49
 */

namespace Admin;
use Import;

class ImportController extends \BaseController{

    public function import()
    {
        Import::go();
    }

} 