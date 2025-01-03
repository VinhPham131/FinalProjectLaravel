<?php

use Laravel\Pulse\Http\Middleware\Authorize;
use Laravel\Pulse\Pulse;
use App\Listeners\SlowQueryListener;
use Laravel\Pulse\Recorders;

return [
    'SlowQueries' => [
        'enabled' => env('PULSE_SLOW_QUERIES_ENABLED', true),
        'threshold' => env('PULSE_SLOW_QUERIES_THRESHOLD', 1000),
        'location' => env('PULSE_SLOW_QUERIES_LOCATION', true),
        'max_query_length' => env('PULSE_SLOW_QUERIES_MAX_QUERY_LENGTH', 1024),
        'callback' => [\App\Callbacks\SlowQueryCallback::class, 'handle'],
    ],

    'server_metrics' => [
        'enabled' => env('PULSE_SERVER_METRICS_ENABLED', true),
        'metrics' => [
            'cpu_usage' => [
                'threshold' => env('PULSE_CPU_USAGE_THRESHOLD', 80),
                'alert' => env('PULSE_CPU_USAGE_ALERT', true),
            ],
            'memory_usage' => [
                'threshold' => env('PULSE_MEMORY_USAGE_THRESHOLD', 80),
                'alert' => env('PULSE_MEMORY_USAGE_ALERT', true),
            ],
            'disk_space' => [
                'threshold' => env('PULSE_DISK_SPACE_THRESHOLD', 80),
                'alert' => env('PULSE_DISK_SPACE_ALERT', true),
            ],
            'network_activity' => [
                'threshold' => env('PULSE_NETWORK_ACTIVITY_THRESHOLD', 1000),
                'alert' => env('PULSE_NETWORK_ACTIVITY_ALERT', true),
            ],
        ],
    ],

    'domain' => env('PULSE_DOMAIN'),

    'path' => env('PULSE_PATH', 'pulse'),

    'enabled' => env('PULSE_ENABLED', true),

    'storage' => [
        'driver' => env('PULSE_STORAGE_DRIVER', 'database'),

        'trim' => [
            'keep' => env('PULSE_STORAGE_KEEP', '7 days'),
        ],

        'database' => [
            'connection' => env('PULSE_DB_CONNECTION'),
            'chunk' => 1000,
        ],
    ],

    'ingest' => [
        'driver' => env('PULSE_INGEST_DRIVER', 'storage'),

        'buffer' => env('PULSE_INGEST_BUFFER', 5000),

        'trim' => [
            'lottery' => [1, 1000],
            'keep' => env('PULSE_INGEST_KEEP', '7 days'),
        ],

        'redis' => [
            'connection' => env('PULSE_REDIS_CONNECTION'),
            'chunk' => 1000,
        ],
    ],

    'cache' => env('PULSE_CACHE_DRIVER'),

    'middleware' => [
        'web',
        Authorize::class,
    ],

    'recorders' => [
        Recorders\CacheInteractions::class => [
            'enabled' => env('PULSE_CACHE_INTERACTIONS_ENABLED', true),
            'sample_rate' => env('PULSE_CACHE_INTERACTIONS_SAMPLE_RATE', 1),
            'ignore' => [
                ...Pulse::defaultVendorCacheKeys(),
            ],
            'groups' => [
                '/^job-exceptions:.*/' => 'job-exceptions:*',
            ],
        ],

        Recorders\Exceptions::class => [
            'enabled' => env('PULSE_EXCEPTIONS_ENABLED', true),
            'sample_rate' => env('PULSE_EXCEPTIONS_SAMPLE_RATE', 1),
            'location' => env('PULSE_EXCEPTIONS_LOCATION', true),
            'ignore' => [],
        ],

        Recorders\Queues::class => [
            'enabled' => env('PULSE_QUEUES_ENABLED', true),
            'sample_rate' => env('PULSE_QUEUES_SAMPLE_RATE', 1),
            'ignore' => [],
        ],

        Recorders\Servers::class => [
            'server_name' => env('PULSE_SERVER_NAME', gethostname()),
            'directories' => explode(':', env('PULSE_SERVER_DIRECTORIES', '/')),
        ],

        Recorders\SlowJobs::class => [
            'enabled' => env('PULSE_SLOW_JOBS_ENABLED', true),
            'sample_rate' => env('PULSE_SLOW_JOBS_SAMPLE_RATE', 1),
            'threshold' => env('PULSE_SLOW_JOBS_THRESHOLD', 1000),
            'ignore' => [],
        ],

        Recorders\SlowOutgoingRequests::class => [
            'enabled' => env('PULSE_SLOW_OUTGOING_REQUESTS_ENABLED', true),
            'sample_rate' => env('PULSE_SLOW_OUTGOING_REQUESTS_SAMPLE_RATE', 1),
            'threshold' => env('PULSE_SLOW_OUTGOING_REQUESTS_THRESHOLD', 1000),
            'ignore' => [],
            'groups' => [],
        ],

        Recorders\SlowQueries::class => [
            'enabled' => env('PULSE_SLOW_QUERIES_ENABLED', true),
            'sample_rate' => env('PULSE_SLOW_QUERIES_SAMPLE_RATE', 1),
            'threshold' => env('PULSE_SLOW_QUERIES_THRESHOLD', 1000),
            'location' => env('PULSE_SLOW_QUERIES_LOCATION', true),
            'max_query_length' => env('PULSE_SLOW_QUERIES_MAX_QUERY_LENGTH'),
            'ignore' => [
                '/(["`])pulse_[\w]+?\1/', // Pulse tables...
                '/(["`])telescope_[\w]+?\1/', // Telescope tables...
            ],
        ],

        Recorders\SlowRequests::class => [
            'enabled' => env('PULSE_SLOW_REQUESTS_ENABLED', true),
            'sample_rate' => env('PULSE_SLOW_REQUESTS_SAMPLE_RATE', 1),
            'threshold' => env('PULSE_SLOW_REQUESTS_THRESHOLD', 1000),
            'ignore' => [
                '#^/' . env('PULSE_PATH', 'pulse') . '$#', // Pulse dashboard...
                '#^/telescope#', // Telescope dashboard...
            ],
        ],

        Recorders\UserJobs::class => [
            'enabled' => env('PULSE_USER_JOBS_ENABLED', true),
            'sample_rate' => env('PULSE_USER_JOBS_SAMPLE_RATE', 1),
            'ignore' => [],
        ],

        Recorders\UserRequests::class => [
            'enabled' => env('PULSE_USER_REQUESTS_ENABLED', true),
            'sample_rate' => env('PULSE_USER_REQUESTS_SAMPLE_RATE', 1),
            'ignore' => [
                '#^/' . env('PULSE_PATH', 'pulse') . '$#', // Pulse dashboard...
                '#^/telescope#', // Telescope dashboard...
            ],
        ],
    ],
];