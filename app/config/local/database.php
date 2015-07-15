<?php

return array(

    'default' => 'mysql',

    'connections' => array(

        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'port'      => '8889',
            'database'  => 'eid-local',
            'username'  => 'homestead',
            'password'  => 'secret',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),

    ),


    /*
        |--------------------------------------------------------------------------
        | Backup settings
        |--------------------------------------------------------------------------
        |
        */
    'backup' => array(
        // add the path to the restore and backup command of mysql
        // this exemple is if your are using MAMP server on a mac
        'mysql' => array(
            'dump_command_path' => '/Applications/MAMP/bin/apache2/bin/',
            'restore_command_path' => '/Applications/MAMP/bin/apache2/bin/',
        ),
    ),
);