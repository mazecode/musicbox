<?php

namespace Mazecode\MusicPlayer\Models;

/**
 * Class Track
 * @package Mazecode\MusicPlayer
 */
class Genre extends BaseModel
{
    protected $guarded = [];

    public $casts = [];

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_genres', 'id_artist', 'album_id');
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_genres', 'album_id', 'genre_id');
    }

    public function tracks()
    {
        return $this->belongsToMany(Tracks::class, 'track_genres', 'track_id', 'genre_id');
    }
}
