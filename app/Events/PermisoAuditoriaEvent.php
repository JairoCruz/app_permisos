<?php

namespace App\Events;

use App\Models\Permiso;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PermisoAuditoriaEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;
    /**
     * Create a new event instance.
     */
    public function __construct(
        public Permiso $permiso,
    )
    {
        //
        $this->model = $permiso;
        //error_log($permiso->id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
