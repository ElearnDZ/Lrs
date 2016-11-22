<?php

namespace Lrs\Tracker\Events;

use Lrs\Tracker\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserDomainCheck extends Event
{
    use SerializesModels;

    public $emailID;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->emailID = $email;
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
