<?php

namespace App\Listeners;

use App\Events\ContactRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
class SendWelcomeEmailListener
{

    use InteractsWithQueue;
    /**
     * Handle the event.
     *
     * @param  \App\Events\ContactRegistered  $event
     * @return void
     */
    public function handle(ContactRegistered $event)
    {
        Mail::to($event->contact->email)
            ->send(new \App\Mail\WelcomeMail($event->contact));
    }
}
