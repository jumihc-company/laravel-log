<?php

return [
    'driver' => 'custom',
    'via' => \Jmhc\Log\JmhcLogger::class,
    'debug' => env('JMHC_LOG_DEBUG', false),
    'max_size' => env('JMHC_LOG_MAX_SIZE', 0),
    'max_files' => env('JMHC_LOG_MAX_FILES', 0),
    'bubble' => env('JMHC_LOG_BUBBLE', true),
    'permission' => env('JMHC_LOG_PERMISSION', null),
    'locking' => env('JMHC_LOG_LOCKING', false),
];
