<?php

return [

    /*
     |--------------------------------------------------------------------------
     | MusicLibrary Settings
     |--------------------------------------------------------------------------
     |
     | MusicLibrary is enabled by default, when debug is set to true in app.php.
     | You can override the value by setting enable to true or false instead of null.
     |
     | You can provide an array of URI's that must be ignored (eg. 'api/*')
     |
     */
    'enabled' => env('MUSIC_LIBRARY_ENABLED', true),

    /*
     |--------------------------------------------------------------------------
     | DebugBar route prefix
     |--------------------------------------------------------------------------
     |
     | Sometimes you want to set route prefix to be used by MusicLibrary to load
     | its resources from. Usually the need comes from misconfigured web server or
     | from trying to overcome bugs like this: http://trac.nginx.org/nginx/ticket/97
     |
     */
    'route_prefix' => env('MUSIC_LIBRARY_PREFIX', 'music/library'),

    /*
     |--------------------------------------------------------------------------
     | MusicLibrary route domain
     |--------------------------------------------------------------------------
     |
     | By default MusicLibrary route served from the same domain that request served.
     | To override default domain, specify it as a non-empty value.
     */
    'route_domain' => null,

    /**
     *
     */
    'route_auth' => env('MUSIC_LIBRARY_ROUTE_AUTH', false),
];
