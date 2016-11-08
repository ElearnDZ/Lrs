<?php

namespace Priyabp\Lrs;

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
    public function boot()
    {
        $this->setupRoutes($this->app->router);
        // require __DIR__.'/app/Http/routes.php';

        // $this->loadViewsFrom(__DIR__ .'/../resources/views','todo');
    }
    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Priyabp\Lrs\Tracker\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('lrs',function($app){
            return new Lrs;
        });
    }
}
