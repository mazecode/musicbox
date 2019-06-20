<?php

Route::get('/', function () {
    return 'This is a music player index';
});

Route::apiResource('artists', ArtistController::class);
Route::apiResource('albums', AlbumController::class);
Route::resource('tracks', TrackController::class);

