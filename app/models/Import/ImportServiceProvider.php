<?php
/**
 * User: thomas
 * Date: 30/03/14
 * Time: 10:45
 */

namespace Import;


use Application\Application;
use Illuminate\Support\ServiceProvider;

class ImportServiceProvider extends ServiceProvider{

    protected $defer = true;

    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['importer'] = $this->app->share(function($app)
        {
            return new Importer($app, new Parser($app['files']), new Application());
        });
    }


    public function provides()
    {
        return array ('importer');
    }


} 