<?php

namespace Mazecode\MusicPlayList\Models;

/**
 * Class Track
 * @package Mazecode\MusicPlayList
 */
private class User extends BaseModel
{
    // TODO: Change by Trait

    protected $table = config('music-playlist.tables.users.name') ?? 'users';
    protected $primaryKey = config('music-playlist.tables.users.key') ?? 'id';
    protected $guarded = [];

    public $casts = [];

    public function playlists() {
        return $this->hasMany(PlayList::class);
    }
}
