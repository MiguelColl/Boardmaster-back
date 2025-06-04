<?php

namespace App\Listeners;

use App\Events\CreatedOrder;
use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Mail;

class NotifyCreatedOrder
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreatedOrder $event): void
    {
        Mail::send(new OrderCreated($event->order));
    }
}
