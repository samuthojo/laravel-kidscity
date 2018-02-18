<?php

namespace App\Listeners;

use App\Events\NewOrderPlaced;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Notifications\OrderReceived;

class SendNewOrderNotification
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
     * @param  NewOrderPlaced  $event
     * @return void
     */
    public function handle(NewOrderPlaced $event)
    {
        $user = User::where('email', env('ADMIN_EMAIL'))->first();

        $user->notify(new OrderReceived($event->order));

        return false;
    }
}
