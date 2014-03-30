<?php
/**
 * User: thomas
 * Date: 30/03/14
 * Time: 12:46
 */

namespace Import;


use Illuminate\Filesystem\Filesystem;

class Parser {

    protected $handle;

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $file;

    public function __construct(Filesystem $file)
    {
        $this->file = $file;
    }

    public function load($file)
    {
        $this->workingFile = $file;

        ini_set('auto_detect_line_endings',TRUE);

        $this->handle = fopen($file, 'r');
    }

    public function close()
    {
        fclose($this->handle);

        $this->file->move($this->workingFile, $this->parsedName());
    }

    protected function parsedName()
    {
        $info = pathinfo($this->workingFile);

        return $info['dirname'] . '/' . $info['filename'] . '_' . time() . '.' . $info['extension'];
    }

    public function parse()
    {
        $entries = array();

        while($entry = fgetcsv($this->handle, null, ';'))
        {
            array_push($entries, $entry);
        }

        $this->map = array_shift($entries);

        $this->entries = $entries;

        return true;
    }

    public function entries()
    {
        return $this->entries;
    }

    public function map()
    {
        return $this->map;
    }

} 