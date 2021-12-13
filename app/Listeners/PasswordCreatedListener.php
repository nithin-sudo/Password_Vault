<?php

namespace App\Listeners;

use App\Events\PasswordCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;

class PasswordCreatedListener
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
    public function handle(PasswordCreated $event)
    {
        $users = User::whereHas('users',function($query) {
            $query->where('id',1);
        })->get();

        Notification::send($users, new PasswordCreatedNotification($event->vault));
    }
}
