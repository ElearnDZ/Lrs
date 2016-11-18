<?php namespace App\Locker\Graphing;

use Illuminate\Support\ServiceProvider;

class GraphServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->bind(
            'App\Locker\Graphing\GraphingInterface',
            'App\Locker\Graphing\Graphing'
        );

    }


}