<?php

namespace App\Listeners;

use App\Events\NewUserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;


class PushUserCreatedNotification
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
     * @param NewUserCreated  $event
     * @return void
     */
    public function handle(NewUserCreated $event)
    {

    }
}
