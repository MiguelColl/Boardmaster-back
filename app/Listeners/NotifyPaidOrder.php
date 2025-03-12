<?php

namespace App\Listeners;

use App\Events\PaidOrder;

class NotifyPaidOrder
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
    public function handle(PaidOrder $event): void
    {
        $paymentID = $event->payment['id'];
        \Log::info("Order $paymentID has been paid");
    }
}
