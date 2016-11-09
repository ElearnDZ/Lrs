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
        // require __DIR__.'/Http/routes.php';
        $this->setupRoutes($this->app->router);
        // $this->loadViewsFrom(__DIR__ .'/../views','todo');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Priyabp\Lrs\Tracker\App\Http\Controllers'], function($router)
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
        $this->app->bind('tincan',function($app){
            return new Tincan;
        });
    }
}
