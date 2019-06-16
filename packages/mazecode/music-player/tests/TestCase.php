<?php

namespace Mazecode\MusicPlayer\Tests;

use Mazecode\MusicPlayer\Providers\MusicPlayerServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            MusicPlayerServiceProvider::class,
        ];
    }
}
