<?php

namespace App\Listeners;

use App\Events\NewUserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;
use App\Mail\NewUserCreated as NewUser;

class SendWelcomeEmail
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
     * @param  NewUserCreated  $event
     * @return void
     */
    public function handle(NewUserCreated $event)
    {
        Mail::to($event->user->email)->send(new NewUser($event->user));
    }
}
