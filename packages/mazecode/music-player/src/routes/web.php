<?php

$routeConfig = [
    'namespace' => 'Mazecode\MusicPlayer\Controllers',
    'prefix' => $this->app['config']->get('musicplayer.route_prefix'),
    'domain' => $this->app['config']->get('musicplayer.route_domain'),
];

Route::group($routeConfig, function ($app) {
    Route::get('/', function () {
        return 'This is a music player index';
    });
});
