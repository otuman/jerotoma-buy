<?php

namespace App\Listeners;

use App\Events\NewOrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\NewOrderCreated as OrderCreated;

class SendOrderCreatedEmail
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
        Mail::to($event->user->email)->send(new OrderCreated($event->user, $event->order));
    }
}
