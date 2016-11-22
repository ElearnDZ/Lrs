<?php

namespace Lrs\Tracker\Listeners;

use Lrs\Tracker\Events\LrsStore;
use Lrs\Tracker\Locker\Repository\Client\EloquentRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LrsStoreFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LrsStore  $event
     * @return void
     */
    public function handle(LrsStore $event)
    {
        $repo = new EloquentRepository();
        $repo->store([], ['lrs_id' => $event->modelID]);
    }
}
