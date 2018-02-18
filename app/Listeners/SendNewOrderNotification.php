<?php

namespace App\Listeners;

use App\Events\NewOrderPlaced;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        return false;
    }
}
