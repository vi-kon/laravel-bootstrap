<?php namespace ViKon\Bootstrap;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use ViKon\Bootstrap\Console\Command\CompileCommand;

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
     * {@inheritDoc}
     */
    public function __construct($app)
    {
        $this->defer = false;

        parent::__construct($app);
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../views', 'vi-kon.bootstrap');

        $this->commands(['vi-kon.command.bootstrap.compile']);
    }

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->app->singleton(Compiler::class, function (Application $app) {
            return new Compiler($app->make('files'));
        });

        $this->app->singleton(FormBuilder::class, function (Application $app) {
            return (new FormBuilder($app->make('html'), $app->make('form')))
                ->setSessionStore($app->make('session.store'));
        });

        $this->app->singleton('vi-kon.command.bootstrap.compile', function () {
            return new CompileCommand();
        });
    }

    /**
     * {@inheritDoc}
     */
    public function provides()
    {
        return [
            Compiler::class,
            'vi-kon.command.bootstrap.compile',
        ];
    }
}
