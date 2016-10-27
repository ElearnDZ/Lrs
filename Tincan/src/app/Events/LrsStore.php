<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LrsStore extends Event
{
    use SerializesModels;

    public $modelID;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($modelID)
    {
        $this->modelID=$modelID;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
