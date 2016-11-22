<?php

namespace Lrs\Tracker\Listeners;

use Lrs\Tracker\Events\UserEmailResend;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEmailResendFired
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
     * @param  UserEmailResend  $event
     * @return void
     */
    public function handle(UserEmailResend $event)
    {
        if(strcmp(config('mail.service'),'on')==0) {
            \Lrs\Tracker\Locker\Helpers\User::sendEmailValidation($event->user);
        }
    }
}
