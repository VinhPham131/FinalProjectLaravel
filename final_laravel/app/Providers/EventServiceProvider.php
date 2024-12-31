<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\SlowQueryDetected;
use App\Listeners\SendSlowQueryAlert;
use Illuminate\Auth\Events\Login;
use App\Listeners\MergeCartOnLogin;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SlowQueryDetected::class => [
            SendSlowQueryAlert::class,
        ],
        Login::class => [
            MergeCartOnLogin::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}