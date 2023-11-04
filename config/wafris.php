<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Wafris enabled
    |--------------------------------------------------------------------------
    |
    | Wafris is enabled per defualt, this option allows you to
    | disable the Wafris middleware for an entire environment
    |
    */

    'enabled' => env('WAFRIS_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Redis Connection Name
    |--------------------------------------------------------------------------
    |
    | The Redis Connection Name to use for Wafris
    | This needs to correspond to a Redis connection defined in
    | config/database.php
    |
    */

    'redis_connection' => env('WAFRIS_REDIS_CONNECTION', 'default'),

];
