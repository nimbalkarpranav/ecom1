<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class OrderConfirmed implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $userId;
    public $message;

    public function __construct($userId, $message)
    {
        $this->userId = $userId;
        $this->message = $message;
    }

    public function broadcastOn()
    {
       //   return new PrivateChannel('user.' . $this->userId);
        return new PrivateChannel('user.' . $this->userId);

    }


    public function broadcastAs()
    {
        return 'order.confirmed';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
        ];
    }
}
