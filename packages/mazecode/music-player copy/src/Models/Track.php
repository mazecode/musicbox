<?php

namespace Mazecode\MusicPlayer\Models;

/**
 * Class Track
 * @package Mazecode\MusicPlayer
 */
class Track extends BaseModel
{
    protected $guarded = [];

    public $casts = [];

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_tracks', 'album_id', 'track_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'track_genres', 'genre_id', 'track_id');
    }
}
