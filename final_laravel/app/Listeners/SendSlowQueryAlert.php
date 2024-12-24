<?php
namespace App\Listeners;

use App\Events\SlowQueryDetected;
use Illuminate\Support\Facades\Mail;

class SendSlowQueryAlert
{
    public function handle(SlowQueryDetected $event)
    {
        $admins = ['admin@gmail.com']; 

        foreach ($admins as $admin) {
            Mail::raw("A slow query was detected:\n\nQuery: {$event->query}\nTime: {$event->time}ms", function ($message) use ($admin) {
                $message->to($admin)
                        ->subject('Slow Query Detected');
            });
        }
    }
}