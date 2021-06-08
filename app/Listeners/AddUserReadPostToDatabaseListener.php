<?php

namespace App\Listeners;

use App\Events\HasSomeOneReadPostEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddUserReadPostToDatabaseListener
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
     * @param  HasSomeOneReadPostEvent  $event
     * @return void
     */
    public function handle(HasSomeOneReadPostEvent $event)
    {
        $event->user->readPosts()->attach($event->id);
    }
}
