<?php

// namespace App\Events;

// use Illuminate\Broadcasting\Channel;
// use Illuminate\Broadcasting\InteractsWithSockets;
// use Illuminate\Broadcasting\PresenceChannel;
// use Illuminate\Broadcasting\PrivateChannel;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Foundation\Events\Dispatchable;
// use Illuminate\Queue\SerializesModels;

// class NewNotificationEvent
// {
//     use Dispatchable, InteractsWithSockets, SerializesModels;

//     public $notification;

//     /**
//      * Create a new event instance.
//      */
//     public function __construct($notification)
//     {
//         $this->notification = $notification;
//     }

//     /**
//      * Get the channels the event should broadcast on.
//      *
//      * @return array<int, \Illuminate\Broadcasting\Channel>
//      */
//     public function broadcastOn(): array
//     {
//         return [
//             new Channel('notifications.' . $this->notification->customer_id)
//         ];
//     }

//     public function broadcastWith()
//     {
//         return ['notification' => $this->notification];
//     }

//     public function broadcastAs()
//     {
//         return 'NewNotificationEvent';
//     }

//}
