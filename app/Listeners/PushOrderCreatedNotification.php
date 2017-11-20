<?php

namespace App\Listeners;

use App\Events\NewOrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;


class PushOrderCreatedNotification
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
     * @param  NewOrderCreated  $event
     * @return void
     */
    public function handle(NewOrderCreated $event)
    {

    }
}
