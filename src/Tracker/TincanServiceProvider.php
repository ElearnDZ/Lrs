<?php

namespace Lrs\Tincan;

use Illuminate\Support\ServiceProvider;

class TincanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__.'/Http/routes.php';
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
