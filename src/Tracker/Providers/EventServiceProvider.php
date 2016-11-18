<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener'],
        'App\Events\UserDomainCheck' => [
            'App\Listeners\UserDomainCheckFired'],
        'App\Events\UserRegister' => [
            'App\Listeners\UserRegisterFired'],
        'App\Events\LrsStore' => [
            'App\Listeners\LrsStoreFired'],
        'App\Events\LrsDestroy' => [
            'App\Listeners\LrsDestroyFired'],
        'App\Events\UserEmailResend' => [
            'App\Listeners\UserEmailResendFired'],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
