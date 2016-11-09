<?php

namespace Lrs\Tincan;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use \App;

class TincanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    protected $defer = false;

    public function boot()
    {
         require __DIR__.'/Http/routes.php';
        //$this->setupRoutes($this->app->router);
        // $this->loadViewsFrom(__DIR__ .'/../views','todo');
    }

     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('tincan',function($app){
            return new Tincan;
        });
    }
}
