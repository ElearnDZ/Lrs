<?php

namespace Lrs\Tracker\Listeners;

use Lrs\Tracker\Events\LrsDestroy;
use Lrs\Tracker\Locker\Repository\Client\EloquentRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LrsDestroyFired
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
    public function handle(LrsDestroy $event)
    {
        $repo = new EloquentRepository();
        $repo->store([], ['lrs_id' => $event->modelID]);
        $clients = $repo->index(['lrs_id' => $event->modelID]);
        foreach ($clients as $client) {
            $repo->destroy($client->_id, ['lrs_id' => $event->modelID]);
        }
    }
}
