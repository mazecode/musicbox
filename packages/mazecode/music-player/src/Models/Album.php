<?php

namespace Mazecode\MusicPlayer\Models;

/**
 * Class Album
 * @package Mazecode\MusicPlayer
 */
class Album extends BaseModel
{
    protected $table = 'albums';

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
