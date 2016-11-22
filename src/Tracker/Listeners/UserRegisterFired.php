<?php

namespace Lrs\Tracker\Listeners;

use Lrs\Tracker\Events\UserRegister;
use Lrs\Tracker\Models\Site;
use Lrs\Tracker\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use MongoId;

class UserRegisterFired
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
     * @param  UserRegister  $event
     * @return void
     */
    public function handle(UserRegister $event)
    {
        //if first user, create site object
        if( User::count() == 1){
            $site = new Site();
            $site->name        = '';
            $site->description = '';
            $site->email       = $event->user->email;
            $site->lang        = 'en-US';
            $site->create_lrs  = array('super');
            $site->registration = 'Closed';
            $site->restrict    = 'None'; //restrict registration to a specific email domain
            $site->domain      = '';
            $site->super       = array( array('user' => new \MongoDB\BSON\ObjectID($event->user->_id) ) );
            $site->save();
        }

        //now send an email asking to verify email
        $this->sendEmail( $event->user );
    }

    private function sendEmail( $user ){
        if(strcmp(config('mail.service'),'on')==0) {
            \App\Locker\Helpers\User::sendEmailValidation($user);
        }
    }
}
