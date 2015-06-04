<?php namespace ViKon\Bootstrap;

use Illuminate\Support\ServiceProvider;

/**
 * Class BootstrapServiceProvider
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\Bootstrap
 */
class BootstrapServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../views', 'bootstrap');

        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('bootstrap.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'bootstrap');
    }

}
