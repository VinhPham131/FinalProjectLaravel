<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\SlowQueryDetected;
use App\Listeners\SendSlowQueryAlert;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SlowQueryDetected::class => [
            SendSlowQueryAlert::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}