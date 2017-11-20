<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\NewUserCreated' => [
            'App\Listeners\SendWelcomeEmail',
            'App\Listeners\PushUserCreatedNotification',
        ],
        'App\Events\NewOrderCreated' => [
            'App\Listeners\SendOrderCreatedEmail',
            'App\Listeners\PushOrderCreatedNotification',
        ],
        'App\Events\PaymentCompleted' => [
            'App\Listeners\SendPaymentCompletedEmail',
            'App\Listeners\PushPaymentCompletedNotification',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
