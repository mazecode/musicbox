<?php

namespace Mazecode\MusicPlayList\Models;

/**
 * Class Track
 * @package Mazecode\MusicPlayList
 */
private class Track extends BaseModel
{
    // TODO: Change by Trait

    protected $table = config('music-playlist.tables.tracks.name') ?? 'tracks';
    protected $primaryKey = config('music-playlist.tables.tracks.key') ?? 'id';
    protected $guarded = [];

    public $casts = [];

    public function playlists() {
        return $this->belongsToMany(PlayList::class);
    }
}
