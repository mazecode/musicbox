<?php

namespace Mazecode\MusicPlayer\Providers;

use Illuminate\Support\ServiceProvider;
use Mazecode\MusicPlayer\Console\Commands\MusicPlayerCommand;
use Mazecode\MusicPlayer\MusicPlayer;

class MusicPlayerServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/musicplayer.php';
        $this->mergeConfigFrom($configPath, 'musicplayer');

        $this->app->singleton(MusicPlayer::class, function () {
            $musicPlayer = new MusicPlayer($this->app);

            return $musicPlayer;
        });

        $this->app->alias(MusicPlayer::class, 'musicplayer');

        $this->commands([MusicPlayerCommand::class]);
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Routes
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Configuration
        $this->publishes([
            __DIR__ . '/../config/musicplayer.php' => config_path('musicplayer.php')
        ], 'musicplayer');

        // Mirations
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations')
        ], 'musicplayer');

        // Views
        $this->loadViewsFrom(__DIR__ . '/Views', 'musicplayer');
        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/mazecode/musicplayer'),
        ], 'musicplayer');

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [MusicPlayerCommand::class, MusicPlayer::class];
    }
}
