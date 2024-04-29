<?php

use AntoniPutra\Ngeblog\Http\Middleware\AdminAuthorization;

return [

    /*
    |--------------------------------------------------------------------------
    | Ngeblog Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Ngeblog will be accessible from. If this
    | setting is null, Ngeblog will reside under the same domain as the
    | application. Otherwise, this value will serve as the subdomain.
    |
    */

    'domain' => env('NGEBLOG_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Ngeblog Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Ngeblog will be accessible from. Feel free
    | to change this path to anything you like.
    |
    */

    'path' => env('NGEBLOG_PATH', 'ngeblog'),

    /*
    |--------------------------------------------------------------------------
    | Ngeblog Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each Ngeblog route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        AdminAuthorization::class
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Ngeblog Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the Ngeblog to handle Blog Image.
    |
    */

    'disk' => env('NGEBLOG_DISK', 'public'),
];
