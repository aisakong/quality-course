<?php

/*
 * This file is part of the hui-ho/quality-course.
 *
 * (c) jiehui <hui-ho@outlook.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Counters periods
    |--------------------------------------------------------------------------
    |
    | Set time in days for each periods counter , you can leave it blank if you like
    |
    */
    'periods' => [
        'day',
        'week',
        'month',
        'year',
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis prefix
    |--------------------------------------------------------------------------
    */
    'redis_keys_prefix' => 'visits',

    /*
    |--------------------------------------------------------------------------
    | Remember ip for x seconds of time
    |--------------------------------------------------------------------------
    |
    | Prevent counts duplication by remembering each ip has visited the page for x seconds.
    | Visits from same ip will be counted after ip expire
    |
    */
    'remember_ip' => 15 * 60,

    /*
    |--------------------------------------------------------------------------
    | Always make fresh top/low lists
    |--------------------------------------------------------------------------
    */
    'always_fresh' => false,

    /*
    |--------------------------------------------------------------------------
    | Redis Database Connection Name
    |--------------------------------------------------------------------------
    |
    | When using "redis" you may specify a
    | connection that should be used to manage your database storage. This should
    | correspond to a connection in your database configuration options.
    |
    */
    'connection' => 'laravel-visits',
];
