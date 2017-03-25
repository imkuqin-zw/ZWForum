<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use ReflectionProperty;

class ReplyMention
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $toUsers = [];
    public $reply;

    /**
     * Create a new event instance.
     * @param $reply
     * @param $toUsers
     */
    public function __construct($reply,$toUsers)
    {
        $this->toUsers = $toUsers;
        $this->reply = $reply;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }

}
