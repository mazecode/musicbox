<?php namespace Mazecode\MusicPlayList\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return MusicPlaylist::class;
    }
}
