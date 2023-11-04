<?php

return [

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
