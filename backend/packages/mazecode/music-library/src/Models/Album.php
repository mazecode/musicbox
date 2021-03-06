<?php

namespace Mazecode\MusicLibrary\Models;

/**
 * Class Album
 * @package Mazecode\MusicLibrary
 */
class Album extends BaseModel
{
    protected $guarded = [];

    public $casts = [];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'album_genres', 'genre_id', 'album_id');
    }

    public function tracks()
    {
        return $this->belongsToMany(Track::class, 'album_tracks', 'track_id', 'album_id');
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_albums', 'id_artist', 'album_id');
    }
}
