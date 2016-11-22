<?php namespace Lrs\Tracker\Locker\Graphing;

use Illuminate\Support\ServiceProvider;

class GraphServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->bind(
            'Lrs\Tracker\Locker\Graphing\GraphingInterface',
            'Lrs\Tracker\Locker\Graphing\Graphing'
        );

    }


}