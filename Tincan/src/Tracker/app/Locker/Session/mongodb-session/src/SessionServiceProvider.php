<?php

namespace App\Locker\Session;

use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->resolving('session', function ($session) {
            $session->extend('mongodb', function ($app) {
                $manager = new \App\Locker\Session\SessionManager($app);

                return $manager->driver('mongodb');
            });
        });
    }

}
