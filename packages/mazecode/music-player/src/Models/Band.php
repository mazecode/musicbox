<?php

namespace Mazecode\MusicPlayer\Models;

/**
 * Class Artist
 * @package Mazecode\MusicPlayer
 */
class Band extends BaseModel
{
    public function albums()
    {
        return $this->belongsToMany(Album::class, 'band_albums', 'album_id', 'band_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'band_genres', 'genre_id', 'band_id');
    }

    public function influences()
    {
        return $this->belongsToMany(Artist::class, 'influences', 'influence_id', 'band_id');
    }
}
