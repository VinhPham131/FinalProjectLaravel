<?php

namespace App\Callbacks;

use App\Events\SlowQueryDetected;

class SlowQueryCallback
{
    public function __invoke($query, $time)
    {
        if ($time > env('PULSE_SLOW_QUERIES_THRESHOLD', 1000)) {
            event(new SlowQueryDetected($query, $time));
        }
    }
}