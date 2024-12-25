<?php
namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SlowQueryDetected
{
    use Dispatchable, SerializesModels;

    public $query;
    public $time;

    public function __construct($query, $time)
    {
        $this->query = $query;
        $this->time = $time;
    }
}