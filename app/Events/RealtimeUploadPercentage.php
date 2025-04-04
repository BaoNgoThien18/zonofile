<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class RealtimeUploadPercentage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $arr;

    /**
     * Create a new event instance.
     */
    public function __construct(array $arr)
    {
        $this->arr = $arr;
    }

    
    public function broadcastOn()
    {
        return new Channel('RealtimeUploadPercentage');
    }

   
    public function broadcastAs()
    {
        return 'RealtimeUploadPercentage';
    }

   
    public function broadcastWith()
    {
        return [
            'data' => $this->arr,
        ];
    }
}
