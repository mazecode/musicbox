<?php namespace Mazecode\MusicPlayer\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return MusicPlayer::class;
    }
}
