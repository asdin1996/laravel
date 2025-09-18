<?php

namespace App\Listeners;

use App\Events\ContactRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\WelcomeMail;

class SendWelcomeEmailListener
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * Sends a welcome email to the newly registered contact
     * when the ContactRegistered event is fired.
     *
     * This listener can be queued if needed by implementing
     * the ShouldQueue interface.
     *
     * @param  \App\Events\ContactRegistered  $event
     * @return void
     *
     * @example
     * Event: ContactRegistered
     * Listener Action: Send welcome email to $event->contact->email
     */
    public function handle(ContactRegistered $event): void
    {
        Mail::to($event->contact->email)
            ->send(new WelcomeMail($event->contact));
    }
}
