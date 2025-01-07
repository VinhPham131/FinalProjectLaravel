<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendDiscordNotification
{
    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        Log::info('Sending Discord notification');
        $webhookUrl = env('DISCORD_WEBHOOK_URL');

        $message = [
            'content' => "New Order Created!\n**Order Code:** {$event->order->code}\n**Name:** {$event->order->first_name} {$event->order->last_name}\n**Email:** {$event->order->email}\n**Total Price:** {$event->order->total_price}\n**Payment Method:** {$event->order->payment}\n**Shipping Address:** {$event->order->address}, {$event->order->country} \n**Status:** {$event->order->status}",
        ];

        $response = Http::post($webhookUrl, $message);

        if ($response->failed()) {
            Log::error('Failed to send Discord notification', ['response' => $response->body()]);
        } else {
            Log::info('Discord notification sent successfully', ['response' => $response->body()]);
        }
    }
}
