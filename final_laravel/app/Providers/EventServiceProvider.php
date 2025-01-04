<?php
namespace App\Providers;

use App\Events\OrderCreated;
use App\Events\SlowQueryDetected;
use App\Listeners\MergeCartOnLogin;
use App\Listeners\SendDiscordNotification;
use App\Listeners\SendOrderCreatedNotification;
use App\Listeners\SendSlowQueryAlert;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SlowQueryDetected::class => [
            SendSlowQueryAlert::class,
        ],
        Login::class => [
            MergeCartOnLogin::class,
        ],
        OrderCreated::class => [
            SendOrderCreatedNotification::class,
            SendDiscordNotification::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
