<?php

namespace Mazecode\MusicLibrary\Models;

/**
 * Class Artist
 * @package Mazecode\MusicLibrary
 */
class Artist extends BaseModel
{
    protected $guarded = [];

    public $casts = [
        'is_music_band' => 'boolean'
    ];

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

    /**
     * Show music band if model has a one
     *
     * @return void
     */
    public function band()
    {
        return $this->hasOne(Artist::class, 'id', 'band_id');
    }

    /**
     * All group's members if model is a music band
     *
     * @return void
     */
    public function members()
    {
        return $this->hasMany(Artist::class, 'band_id', 'id');
    }

    /**
     * Scope is music band
     *
     * @return void
     */
    public function isMusicBand(): bool
    {
        return (bool) $this->is_music_band;
    }

    public function scopeOnlyBands($query)
    {
        return $query->where('is_music_band', true);
    }
}
