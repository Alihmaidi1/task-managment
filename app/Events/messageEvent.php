<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class messageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

     public $data;
     public $id;


     public $type;

     public function __construct($data,$type,$id)
    {


        $this->data=$data;
        $this->type=$type;
        $this->id=$id;



    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public.'.$this->type.".".$this->id);
    }


    public function broadcastAs()
    {
        return "newmessage";
    }


    public function broadcastWith()
    {
        return ["data"=>$this->data];
    }
}