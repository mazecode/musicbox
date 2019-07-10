<?php

namespace Mazecode\MusicPlayList\Models;

/**
 * Class Track
 * @package Mazecode\MusicPlayList
 */
class PlayList extends BaseModel
{
    protected $guarded = [];

    public $casts = [];

    public function user()
    {
         return $this->belongsTo(User::class);
    }

    public function tracks()
    {
        return $this->belongsToMany(Track::class);
    }
}
