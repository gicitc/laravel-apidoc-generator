<?php

namespace Gicitc\ApiDoc;

use Illuminate\Support\ServiceProvider;
use Gicitc\ApiDoc\Commands\RebuildDocumentation;
use Gicitc\ApiDoc\Commands\GenerateDocumentation;

class ApiDocGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'apidoc');

        $this->publishes([
            __DIR__.'/../resources/views' => app()->basePath().'/resources/views/vendor/apidoc',
        ], 'apidoc-views');

        $this->publishes([
            __DIR__.'/../config/apidoc.php' => app()->basePath().'/config/apidoc.php',
        ], 'apidoc-config');

        $this->mergeConfigFrom(__DIR__.'/../config/apidoc.php', 'apidoc');

        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateDocumentation::class,
                RebuildDocumentation::class,
            ]);
        }
    }

    /**
     * Register the API doc commands.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
