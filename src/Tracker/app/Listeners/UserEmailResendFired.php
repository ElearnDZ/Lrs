<?php

namespace App\Listeners;

use App\Events\UserEmailResend;
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
            \App\Locker\Helpers\User::sendEmailValidation($event->user);
        }
    }
}
