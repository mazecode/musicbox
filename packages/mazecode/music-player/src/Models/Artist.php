<?php

namespace Mazecode\MusicPlayer\Models;

/**
 * Class Artist
 * @package Mazecode\MusicPlayer
 */
class Artist extends BaseModel
{
    public function albums()
    {
        return $this->belongsToMany(Album::class, 'artist_albums', 'album_id', 'artist_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'artist_genres', 'genre_id', 'artist_id');
    }

    public function influences()
    {
        return $this->belongsToMany(Artist::class, 'influences', 'influence_id', 'artist_id');
    }

    public function bands()
    {
        return $this->hasOne(Artist::class, 'id', 'band');
    }

    public function members()
    {
        return $this->hasMany(Artist::class, 'band', 'id');
    }
}
