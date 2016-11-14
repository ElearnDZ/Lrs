<?php

namespace Lrs\Tracker;

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
    }
    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Lrs\Controllers'], function($router)
        {
            require __DIR__.'/app/Http/routes.php';
        });
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
