<?php

namespace App\Listeners;

use App\Events\SiteCreatedEvent;
use App\Mail\SiteCreatedMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUserAboutSiteCreatedListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SiteCreatedEvent $event)
    {
        $details = (array)$event;
        Mail::send('mail.SiteCreated', ['details' => $details], function ($message) use($details) {
            $message->to($details['email']);
        });
    }
}
