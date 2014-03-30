<?php
/**
 * User: thomas
 * Date: 30/03/14
 * Time: 10:47
 */

namespace Import;


use Application\Application;
use \Illuminate\Foundation\Application as App;

class Importer {

    protected $file = '/upload/import/file.csv';

    /**
     * @var App
     */
    protected $app;

    /**
     * @var Parser
     */
    protected $parser;

    /**
     * @var \Application\Application;
     */
    protected $application;

    /**
     * @var array
     */
    protected $map;

    /**
     * @var array
     */
    protected $entries;

    function __construct(App $app, Parser $parser, Application $application)
    {
        $this->app = $app;

        $this->parser = $parser;

        $this->application = $application;
    }

    public function go()
    {
        //read the file
        if($this->readFile())
        {
            //foreach row -> validate -> insert
            foreach($this->entries as $entry)
            {
                $converted = $this->convert($entry);

                $this->application->create($converted);
            }
        }
    }

    protected function readFile()
    {
        try{
            $this->parser->load($this->app['path.public'] . $this->file);

            if($this->parser->parse())
            {
                $this->mappings();

                $this->entries = $this->parser->entries();

                $this->parser->close();

                return true;
            }
            //always close file even on errors
            $this->parser->close();
        }
        catch(\Exception $e)
        {
            return false;
        }

    }

    protected function mappings()
    {
        $map = $this->parser->map();

        $this->map = array_flip($map);
    }

    /**
     * Append import fields and set key => value relations according to our \Application\Application model
     * @param array $entry
     */
    protected function convert(array $entry)
    {
        return array(
            'OrganisationName' => $entry[$this->map['STORENAME']],
            'Street' => $entry[$this->map['STORESTREET']],
            'NrAndBox' => $entry[$this->map['STORENUMBER']],
            'ZipCode' => $entry[$this->map['STOREPOSTAL']],
            'Village' => $entry[$this->map['STORECITY']],
            'Latitude' => str_replace(',', '.', $entry[$this->map['STORELATITUDE']]),
            'Longitude' => str_replace(',','.', $entry[$this->map['STORELONGITUDE']]),
            'Website' => $entry[$this->map['STOREWEBSITE']],
            'Email' => $entry[$this->map['STOREEMAIL']],
            'Phone' => $entry[$this->map['STOREPHONE']],
            'is_csv_import' => 1,
            'csv_import_category' => $entry[$this->map['STORECATEGORY']],
        );
    }

} 