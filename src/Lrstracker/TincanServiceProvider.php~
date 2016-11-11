<?php

namespace Lrs\Tracker;

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
         require __DIR__.'/app/Http/routes.php';
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
