<?php

namespace App\Providers;

use App\Events\HasSomeOneReadPostEvent;
use App\Listeners\SendEmailToUserListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        HasSomeOneReadPostEvent::class =>[
            \App\Listeners\AddUserReadPostToDatabaseListener::class,
            \App\Listeners\SendEmailToUserListener::class,

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
