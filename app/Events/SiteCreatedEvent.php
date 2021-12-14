<?php

namespace App\Events;

use App\Models\Vault;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class SiteCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $email;

    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email,$message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
