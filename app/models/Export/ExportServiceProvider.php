<?php
/**
 * User: thomas
 * Date: 31/03/14
 * Time: 18:58
 */

namespace Export;


use Illuminate\Support\ServiceProvider;

class ExportServiceProvider extends ServiceProvider{

    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['export'] = $this->app->share(function($app)
        {
            return new Repository($app['files']);
        });
    }

    public function boot()
    {

    }

    public function provides()
    {
        return array('export');
    }


} 