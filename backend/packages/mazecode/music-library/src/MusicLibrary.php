<?php

namespace Mazecode\MusicLibrary;

use Illuminate\Foundation\Application;

/**
 * Class MusicLibrary
 * @package Mazecode\MusicLibrary
 */
class MusicLibrary
{
    /**
     * The Laravel application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * Normalized Laravel Version
     *
     * @var string
     */
    protected $version;

    /**
     * True when booted.
     *
     * @var bool
     */
    protected $booted = false;

    /**
     * True when enabled, false disabled an null for still unknown
     *
     * @var bool
     */
    protected $enabled = null;

    /**
     * True when this is a Lumen application
     *
     * @var bool
     */
    protected $isLumen = false;

    /**
     * @param  Application  $app
     */
    public function __construct($app = null)
    {
        if (!$app) {
            $app = app();   //Fallback when $app is not given
        }
        $this->app = $app;


        $this->version = $app->version();
        $this->isLumen = str_contains($this->version, 'Lumen');
    }

    /**
     * Enable the Debugbar and boot, if not already booted.
     */
    public function enable()
    {
        $this->enabled = true;

        if (!$this->booted) {
            $this->boot();
        }
    }

    /**
     * Boot the debugbar (add collectors, renderer and listener)
     */
    public function boot()
    {
        if ($this->booted) {
            return;
        }

        $app = $this->app;
        $MusicLibrary = $this;

        $this->booted = true;
    }
}
