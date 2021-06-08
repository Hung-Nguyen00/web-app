<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HasSomeOneReadPostEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_post;
    public $user;
    public $id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_post, $user, $id)
    {
        $this->user_post = $user_post;
        $this->user = $user;
        $this->id = $id;
    }


}
