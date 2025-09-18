<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class ContactRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The contact instance associated with the event.
     *
     * @var \App\Models\Contact
     */
    public Contact $contact;

    /**
     * Create a new event instance.
     *
     * Initializes the event with the given contact model.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     *
     * @example
     * event(new ContactRegistered($contact));
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * By default, this event is assigned to a private channel.
     * It is not currently set up for broadcasting.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(): Channel|array
    {
        return new PrivateChannel('channel-name');
    }
}
