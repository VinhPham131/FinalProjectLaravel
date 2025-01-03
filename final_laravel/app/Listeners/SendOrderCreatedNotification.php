<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
{
    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        Notification::route('mail', [ $event->order->email => $event->order->first_name . ' ' . $event->order->last_name])
            ->notify(new OrderCreatedNotification($event->order));
    }
}
