<?php
/**
 * User: thomas
 * Date: 31/03/14
 * Time: 19:00
 */

namespace Export;

use Application\Application;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use App;

class Repository {

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * @var string
     */
    protected $filepath;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        $this->filepath = App::make('path.storage') . '/tmp/applications.csv';
    }

    public function go(Collection $apps, array $headers)
    {
        $handle = fopen($this->filepath, 'w+');

        $this->put($handle, $headers);

        $this->items($handle, $apps);

        fclose($handle);

        return $this->filepath;
    }

    protected function items($handle, Collection $apps)
    {
        while($app = $apps->shift())
        {
            $item = $this->item($app);

            $this->put($handle, $item);
        }
    }

    protected function item(Application $app)
    {
        $app = $app->toArray();

        $app = array_values($app);

        foreach($app as $key => $value)
        {
            $value = str_replace('"', "'", $value);
            $value = str_replace(';', '.', $value);
            $value = preg_replace('/[\n\r]/', ' ', $value);
            $app[$key] = utf8_decode($value);
        }

        return $app;
    }

    protected function put($handle, array $data)
    {
        fputcsv($handle, $data, ";");
    }

} 