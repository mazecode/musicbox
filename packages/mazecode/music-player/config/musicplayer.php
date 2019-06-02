<?php

return [

    /*
     |--------------------------------------------------------------------------
     | MusicPlayer Settings
     |--------------------------------------------------------------------------
     |
     | MusicPlayer is enabled by default, when debug is set to true in app.php.
     | You can override the value by setting enable to true or false instead of null.
     |
     | You can provide an array of URI's that must be ignored (eg. 'api/*')
     |
     */
    'enabled' => env('ENABLED', true),

    /*
     |--------------------------------------------------------------------------
     | DebugBar route prefix
     |--------------------------------------------------------------------------
     |
     | Sometimes you want to set route prefix to be used by MusicPlayer to load
     | its resources from. Usually the need comes from misconfigured web server or
     | from trying to overcome bugs like this: http://trac.nginx.org/nginx/ticket/97
     |
     */
    'route_prefix' => 'music-player',

    /*
     |--------------------------------------------------------------------------
     | MusicPlayer route domain
     |--------------------------------------------------------------------------
     |
     | By default MusicPlayer route served from the same domain that request served.
     | To override default domain, specify it as a non-empty value.
     */
    'route_domain' => null,
];
