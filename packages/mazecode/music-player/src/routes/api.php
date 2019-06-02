<?php

$routeConfig = [
    'namespace' => 'Mazecode\MusicPlayer\Controllers\Api',
    'prefix' => $this->app['config']->get('musicplayer.route_prefix'),
    'domain' => $this->app['config']->get('musicplayer.route_domain'),
    'middleware' => ['api']
];

Route::prefix('api')->group(function () use ($routeConfig) {
    Route::group($routeConfig, function () {
        Route::apiResource('artist', 'ArtistController');
        Route::apiResource('album', 'AlbumController');
        Route::apiResource('song', 'SongController');
    });
});
